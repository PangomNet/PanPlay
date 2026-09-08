<?php

const PANPLAY_BASEAUDIO_METADATA_MAX_BYTES = 33554432;
const PANPLAY_BASEAUDIO_METADATA_MAX_ARTWORK_BYTES = 2097152;
const PANPLAY_BASEAUDIO_METADATA_CACHE_SECONDS = 86400;
const PANPLAY_BASEAUDIO_METADATA_NEGATIVE_CACHE_SECONDS = 900;
const PANPLAY_BASEAUDIO_METADATA_MAX_REDIRECTS = 3;

function panplayBaseaudioMetadataFallback(string $url, string $reason = ''): array
{
    $parts = parse_url($url);
    $path = is_array($parts) && isset($parts['path']) ? (string) $parts['path'] : '';
    $filename = rawurldecode(basename($path));
    $title = trim((string) pathinfo($filename, PATHINFO_FILENAME));
    $extension = strtoupper(trim((string) pathinfo($filename, PATHINFO_EXTENSION)));

    if ($title === '') {
        $title = is_array($parts) && !empty($parts['host']) ? (string) $parts['host'] : 'Audio';
    }

    return [
        'analyzed' => false,
        'reason' => $reason,
        'title' => panplayBaseaudioMetadataCleanText($title),
        'artist' => '',
        'album' => '',
        'genre' => '',
        'year' => '',
        'format' => $extension,
        'codec' => '',
        'mime' => '',
        'duration_seconds' => null,
        'duration_label' => '',
        'bitrate_kbps' => null,
        'sample_rate_hz' => null,
        'channels' => null,
        'filesize_bytes' => null,
        'artwork_data_uri' => '',
        'source_host' => is_array($parts) && isset($parts['host']) ? strtolower((string) $parts['host']) : '',
    ];
}

function panplayBaseaudioMetadataNormalizeSourceUrl(string $url): string
{
    $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    return str_replace(' ', '%20', $url);
}

function panplayBaseaudioMetadataCleanText($value): string
{
    if (is_array($value)) {
        $value = reset($value);
    }

    if (!is_scalar($value)) {
        return '';
    }

    $text = trim((string) $value);
    if ($text === '') {
        return '';
    }

    if (function_exists('mb_check_encoding') && !mb_check_encoding($text, 'UTF-8')) {
        $text = (string) mb_convert_encoding($text, 'UTF-8', 'Windows-1252, ISO-8859-1');
    } elseif (!preg_match('//u', $text) && function_exists('iconv')) {
        $converted = @iconv('Windows-1252', 'UTF-8//IGNORE', $text);
        if ($converted !== false) {
            $text = $converted;
        }
    }

    $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $text);
    $text = preg_replace('/\s+/u', ' ', (string) $text);

    if (function_exists('mb_substr')) {
        return trim(mb_substr((string) $text, 0, 300, 'UTF-8'));
    }

    return trim(substr((string) $text, 0, 300));
}

function panplayBaseaudioMetadataFirst(array $values, string $key): string
{
    return isset($values[$key]) ? panplayBaseaudioMetadataCleanText($values[$key]) : '';
}

function panplayBaseaudioMetadataFormatDuration(float $seconds): string
{
    $seconds = max(0, (int) round($seconds));
    $hours = intdiv($seconds, 3600);
    $minutes = intdiv($seconds % 3600, 60);
    $remainingSeconds = $seconds % 60;

    return $hours > 0
        ? sprintf('%d:%02d:%02d', $hours, $minutes, $remainingSeconds)
        : sprintf('%d:%02d', $minutes, $remainingSeconds);
}

function panplayBaseaudioMetadataFormatBytes(int $bytes): string
{
    if ($bytes <= 0) {
        return '';
    }

    $units = ['B', 'KiB', 'MiB', 'GiB'];
    $value = (float) $bytes;
    $unit = 0;
    while ($value >= 1024 && $unit < count($units) - 1) {
        $value /= 1024;
        $unit++;
    }

    return ($unit === 0 ? (string) (int) $value : number_format($value, 1, '.', '')) . ' ' . $units[$unit];
}

function panplayBaseaudioMetadataIpIsPublic(string $ip): bool
{
    $ip = trim($ip, '[]');
    if (stripos($ip, '::ffff:') === 0) {
        $mapped = substr($ip, 7);
        if (filter_var($mapped, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $ip = $mapped;
        }
    }

    return filter_var(
        $ip,
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
    ) !== false;
}

function panplayBaseaudioMetadataResolvePublicIp(string $host): ?string
{
    $host = trim($host, '[]');
    if (filter_var($host, FILTER_VALIDATE_IP)) {
        return panplayBaseaudioMetadataIpIsPublic($host) ? $host : null;
    }

    if (!preg_match('/^[a-z0-9.-]+$/i', $host)) {
        return null;
    }

    $records = @dns_get_record($host, DNS_A | DNS_AAAA);
    if (!is_array($records)) {
        return null;
    }

    foreach ($records as $record) {
        $ip = isset($record['ip']) ? (string) $record['ip'] : (isset($record['ipv6']) ? (string) $record['ipv6'] : '');
        if ($ip !== '' && panplayBaseaudioMetadataIpIsPublic($ip)) {
            return $ip;
        }
    }

    return null;
}

function panplayBaseaudioMetadataValidateUrl(string $url): ?array
{
    $parts = parse_url(trim($url));
    if (!is_array($parts) || empty($parts['scheme']) || empty($parts['host'])) {
        return null;
    }

    $scheme = strtolower((string) $parts['scheme']);
    if (!in_array($scheme, ['http', 'https'], true) || isset($parts['user']) || isset($parts['pass'])) {
        return null;
    }

    $port = isset($parts['port']) ? (int) $parts['port'] : ($scheme === 'https' ? 443 : 80);
    if (!in_array($port, [80, 443], true)) {
        return null;
    }

    $host = strtolower(trim((string) $parts['host'], '[]'));
    $ip = panplayBaseaudioMetadataResolvePublicIp($host);
    if ($ip === null) {
        return null;
    }

    return [
        'url' => trim($url),
        'scheme' => $scheme,
        'host' => $host,
        'port' => $port,
        'ip' => $ip,
    ];
}

function panplayBaseaudioMetadataCurlBase($handle, array $target): void
{
    $resolvedIp = strpos($target['ip'], ':') !== false ? '[' . $target['ip'] . ']' : $target['ip'];
    curl_setopt_array($handle, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_USERAGENT => 'PanPlay-Baseaudio-Metadata/0.1 (+https://play.pangom.net/)',
        CURLOPT_HTTPHEADER => ['Accept: audio/*, application/octet-stream;q=0.5, */*;q=0.1'],
        CURLOPT_RESOLVE => [$target['host'] . ':' . $target['port'] . ':' . $resolvedIp],
    ]);
}

function panplayBaseaudioMetadataInspectRemote(string $url): ?array
{
    for ($redirect = 0; $redirect <= PANPLAY_BASEAUDIO_METADATA_MAX_REDIRECTS; $redirect++) {
        $target = panplayBaseaudioMetadataValidateUrl($url);
        if ($target === null || !function_exists('curl_init')) {
            return null;
        }

        $headers = [];
        $handle = curl_init($target['url']);
        panplayBaseaudioMetadataCurlBase($handle, $target);
        curl_setopt_array($handle, [
            CURLOPT_NOBODY => true,
            CURLOPT_HEADERFUNCTION => static function ($curl, string $line) use (&$headers): int {
                $separator = strpos($line, ':');
                if ($separator !== false) {
                    $name = strtolower(trim(substr($line, 0, $separator)));
                    $headers[$name] = trim(substr($line, $separator + 1));
                }
                return strlen($line);
            },
        ]);

        $result = curl_exec($handle);
        $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $contentType = (string) curl_getinfo($handle, CURLINFO_CONTENT_TYPE);
        $contentLength = defined('CURLINFO_CONTENT_LENGTH_DOWNLOAD_T')
            ? (int) curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD_T)
            : (int) curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $redirectUrl = (string) curl_getinfo($handle, CURLINFO_REDIRECT_URL);
        curl_close($handle);

        if ($result === false) {
            return null;
        }

        if ($status >= 300 && $status < 400 && $redirectUrl !== '') {
            if ($redirect === PANPLAY_BASEAUDIO_METADATA_MAX_REDIRECTS) {
                return null;
            }
            $url = $redirectUrl;
            continue;
        }

        if ($status < 200 || $status >= 300) {
            return null;
        }

        if ($contentLength <= 0 || $contentLength > PANPLAY_BASEAUDIO_METADATA_MAX_BYTES) {
            return null;
        }

        return [
            'target' => $target,
            'content_length' => $contentLength,
            'content_type' => trim(explode(';', $contentType, 2)[0]),
            'last_modified' => $headers['last-modified'] ?? '',
            'etag' => $headers['etag'] ?? '',
        ];
    }

    return null;
}

function panplayBaseaudioMetadataDownload(array $remote, string $temporaryFile): bool
{
    $fileHandle = @fopen($temporaryFile, 'wb');
    if ($fileHandle === false) {
        return false;
    }

    $written = 0;
    $handle = curl_init($remote['target']['url']);
    panplayBaseaudioMetadataCurlBase($handle, $remote['target']);
    curl_setopt_array($handle, [
        CURLOPT_RETURNTRANSFER => false,
        CURLOPT_WRITEFUNCTION => static function ($curl, string $chunk) use ($fileHandle, &$written): int {
            $length = strlen($chunk);
            if ($written + $length > PANPLAY_BASEAUDIO_METADATA_MAX_BYTES) {
                return 0;
            }
            $result = fwrite($fileHandle, $chunk);
            if ($result === false) {
                return 0;
            }
            $written += $result;
            return $result;
        },
    ]);

    $result = curl_exec($handle);
    $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);
    fclose($fileHandle);

    return $result !== false
        && $status >= 200
        && $status < 300
        && $written > 0
        && $written <= PANPLAY_BASEAUDIO_METADATA_MAX_BYTES
        && $written === (int) $remote['content_length'];
}

function panplayBaseaudioMetadataArtwork(array $info): string
{
    $pictures = [];
    if (!empty($info['comments']['picture']) && is_array($info['comments']['picture'])) {
        $pictures = $info['comments']['picture'];
    } elseif (!empty($info['id3v2']['APIC']) && is_array($info['id3v2']['APIC'])) {
        $pictures = $info['id3v2']['APIC'];
    }

    foreach ($pictures as $picture) {
        if (!is_array($picture) || empty($picture['data']) || !is_string($picture['data'])) {
            continue;
        }

        $data = $picture['data'];
        if (strlen($data) > PANPLAY_BASEAUDIO_METADATA_MAX_ARTWORK_BYTES) {
            continue;
        }

        $detected = @getimagesizefromstring($data);
        $mime = is_array($detected) && isset($detected['mime']) ? strtolower((string) $detected['mime']) : '';
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], true)) {
            continue;
        }

        return 'data:' . $mime . ';base64,' . base64_encode($data);
    }

    return '';
}

function panplayBaseaudioMetadataAnalyzeFile(string $filename, string $url, array $remote): array
{
    $metadata = panplayBaseaudioMetadataFallback($url, 'metadata_unavailable');
    $library = __DIR__ . '/../../3rdp_libs/getid3/getid3.php';
    if (!is_file($library)) {
        return $metadata;
    }

    require_once $library;
    try {
        $analyzer = new getID3();
        $analyzer->encoding = 'UTF-8';
        $info = $analyzer->analyze($filename);
        if (!is_array($info) || !empty($info['error'])) {
            return $metadata;
        }

        if (class_exists('getid3_lib')) {
            getid3_lib::CopyTagsToComments($info);
        }

        $comments = !empty($info['comments']) && is_array($info['comments']) ? $info['comments'] : [];
        $title = panplayBaseaudioMetadataFirst($comments, 'title');
        $artist = panplayBaseaudioMetadataFirst($comments, 'artist');
        $album = panplayBaseaudioMetadataFirst($comments, 'album');
        $genre = panplayBaseaudioMetadataFirst($comments, 'genre');
        $year = panplayBaseaudioMetadataFirst($comments, 'year');
        $duration = isset($info['playtime_seconds']) && is_numeric($info['playtime_seconds'])
            ? (float) $info['playtime_seconds']
            : null;
        $bitrate = isset($info['audio']['bitrate']) && is_numeric($info['audio']['bitrate'])
            ? (float) $info['audio']['bitrate']
            : (isset($info['bitrate']) && is_numeric($info['bitrate']) ? (float) $info['bitrate'] : null);

        $metadata['analyzed'] = true;
        $metadata['reason'] = '';
        $metadata['title'] = $title !== '' ? $title : $metadata['title'];
        $metadata['artist'] = $artist;
        $metadata['album'] = $album;
        $metadata['genre'] = $genre;
        $metadata['year'] = $year;
        $metadata['format'] = strtoupper(panplayBaseaudioMetadataCleanText($info['fileformat'] ?? $metadata['format']));
        $metadata['codec'] = panplayBaseaudioMetadataCleanText($info['audio']['codec'] ?? ($info['audio']['dataformat'] ?? ''));
        $metadata['mime'] = panplayBaseaudioMetadataCleanText($info['mime_type'] ?? $remote['content_type']);
        $metadata['duration_seconds'] = $duration;
        $metadata['duration_label'] = $duration !== null ? panplayBaseaudioMetadataFormatDuration($duration) : '';
        $metadata['bitrate_kbps'] = $bitrate !== null ? (int) round($bitrate / 1000) : null;
        $metadata['sample_rate_hz'] = isset($info['audio']['sample_rate']) && is_numeric($info['audio']['sample_rate']) ? (int) $info['audio']['sample_rate'] : null;
        $metadata['channels'] = isset($info['audio']['channels']) && is_numeric($info['audio']['channels']) ? (int) $info['audio']['channels'] : null;
        $metadata['filesize_bytes'] = (int) $remote['content_length'];
        $metadata['artwork_data_uri'] = panplayBaseaudioMetadataArtwork($info);
    } catch (Throwable $exception) {
        return panplayBaseaudioMetadataFallback($url, 'analysis_failed');
    }

    return $metadata;
}

function panplayBaseaudioMetadataCacheDirectory(): string
{
    return __DIR__ . '/../../../data/baseaudio-cache';
}

function panplayBaseaudioMetadataReadCache(string $cacheFile): ?array
{
    if (!is_file($cacheFile)) {
        return null;
    }

    $decoded = json_decode((string) @file_get_contents($cacheFile), true);
    if (!is_array($decoded) || !array_key_exists('analyzed', $decoded)) {
        return null;
    }

    $maxAge = !empty($decoded['analyzed'])
        ? PANPLAY_BASEAUDIO_METADATA_CACHE_SECONDS
        : PANPLAY_BASEAUDIO_METADATA_NEGATIVE_CACHE_SECONDS;

    return (time() - (int) filemtime($cacheFile)) <= $maxAge ? $decoded : null;
}

function panplayBaseaudioReadMetadata(string $url): array
{
    $url = panplayBaseaudioMetadataNormalizeSourceUrl($url);
    $fallback = panplayBaseaudioMetadataFallback($url, 'not_analyzed');
    if (!function_exists('curl_init')) {
        $fallback['reason'] = 'curl_unavailable';
        return $fallback;
    }

    $cacheDirectory = panplayBaseaudioMetadataCacheDirectory();
    if (!is_dir($cacheDirectory) && !@mkdir($cacheDirectory, 0775, true) && !is_dir($cacheDirectory)) {
        $fallback['reason'] = 'cache_unavailable';
        return $fallback;
    }

    $cacheKey = hash('sha256', trim($url));
    $cacheFile = $cacheDirectory . '/' . $cacheKey . '.json';
    $cached = panplayBaseaudioMetadataReadCache($cacheFile);
    if ($cached !== null) {
        return array_replace($fallback, $cached);
    }

    $lockHandle = @fopen($cacheDirectory . '/' . $cacheKey . '.lock', 'c');
    if ($lockHandle === false || !flock($lockHandle, LOCK_EX | LOCK_NB)) {
        if (is_resource($lockHandle)) {
            fclose($lockHandle);
        }
        $fallback['reason'] = 'analysis_in_progress';
        return $fallback;
    }

    $metadata = $fallback;
    $remote = panplayBaseaudioMetadataInspectRemote($url);
    if ($remote === null) {
        $metadata['reason'] = 'remote_not_eligible';
    } else {
        $temporaryFile = @tempnam(sys_get_temp_dir(), 'panplay-audio-');
        if ($temporaryFile !== false) {
            try {
                if (panplayBaseaudioMetadataDownload($remote, $temporaryFile)) {
                    $metadata = panplayBaseaudioMetadataAnalyzeFile($temporaryFile, $url, $remote);
                } else {
                    $metadata['reason'] = 'download_failed';
                }
            } finally {
                @unlink($temporaryFile);
            }
        } else {
            $metadata['reason'] = 'temporary_file_unavailable';
        }
    }

    $encoded = json_encode($metadata, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($encoded !== false) {
        @file_put_contents($cacheFile, $encoded, LOCK_EX);
    }

    flock($lockHandle, LOCK_UN);
    fclose($lockHandle);
    @unlink($cacheDirectory . '/' . $cacheKey . '.lock');

    return $metadata;
}
