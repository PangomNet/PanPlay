<?php
declare(strict_types=1);

const PANPLAY_LAUT_IMAGE_MAX_BYTES = 4194304;

$source = isset($_GET['url']) ? trim((string) $_GET['url']) : '';
$parts = parse_url($source);

if (
    !is_array($parts)
    || strtolower((string) ($parts['scheme'] ?? '')) !== 'https'
    || strtolower((string) ($parts['host'] ?? '')) !== 'assets.laut.fm'
    || isset($parts['user'])
    || isset($parts['pass'])
    || (isset($parts['port']) && (int) $parts['port'] !== 443)
) {
    http_response_code(400);
    exit;
}

if (!function_exists('curl_init')) {
    http_response_code(503);
    exit;
}

$body = '';
$tooLarge = false;
$handle = curl_init($source);
curl_setopt_array($handle, [
    CURLOPT_RETURNTRANSFER => false,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_CONNECTTIMEOUT => 4,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_USERAGENT => 'PanPlay-laut.fm-Image/0.0.0.1',
    CURLOPT_HTTPHEADER => ['Accept: image/avif,image/webp,image/png,image/jpeg,image/gif;q=0.8'],
    CURLOPT_WRITEFUNCTION => static function ($curl, string $chunk) use (&$body, &$tooLarge): int {
        if (strlen($body) + strlen($chunk) > PANPLAY_LAUT_IMAGE_MAX_BYTES) {
            $tooLarge = true;
            return 0;
        }
        $body .= $chunk;
        return strlen($chunk);
    },
]);

$result = curl_exec($handle);
$status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
$declaredType = strtolower(trim(explode(';', (string) curl_getinfo($handle, CURLINFO_CONTENT_TYPE), 2)[0]));
curl_close($handle);

if ($result === false || $tooLarge || $status !== 200 || $body === '') {
    http_response_code(502);
    exit;
}

$detectedType = '';
if (class_exists('finfo')) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $detectedType = strtolower((string) $finfo->buffer($body));
}
$contentType = $detectedType !== '' ? $detectedType : $declaredType;
$allowedTypes = ['image/avif', 'image/webp', 'image/png', 'image/jpeg', 'image/gif'];
if (!in_array($contentType, $allowedTypes, true)) {
    http_response_code(415);
    exit;
}

header('Content-Type: ' . $contentType);
header('Content-Length: ' . strlen($body));
header('Cache-Control: public, max-age=3600, stale-while-revalidate=86400');
header('X-Content-Type-Options: nosniff');
echo $body;
