<?php
/**
 * PanPlay core runtime bootstrap without interface output.
 *
 * PWF and future interfaces may include this file before rendering their own
 * document. The legacy engine/init.php remains untouched for old releases.
 */

require_once __DIR__ . '/../data/storage.php';

if (!empty($cfg_debug_mode)) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
}

require_once __DIR__ . '/lang_loader.php';

if (!function_exists('bluescreen')) {
    function bluescreen($blus_error_code = 500, $blus_reason = null, $blus_reason_desc = null)
    {
        global $copyowner, $copyowner_url, $blus_header_path, $blus_footer_path, $lang, $language;

        $text = static function ($key, $fallback) use ($lang) {
            return isset($lang[$key]) ? $lang[$key] : $fallback;
        };

        if (!is_numeric($blus_error_code)) {
            $blus_reason_desc = $blus_reason;
            $blus_reason = $blus_error_code;
            $blus_error_code = 500;
        }

        $blus_error_code = (int) $blus_error_code;
        if ($blus_error_code < 100 || $blus_error_code > 599) {
            $blus_error_code = 500;
        }
        $blus_reason = $blus_reason === null || $blus_reason === '' ? 'Unhandled exception' : $blus_reason;
        $blus_reason_desc = $blus_reason_desc ?? '';

        $root = dirname(__DIR__);
        $headerPath = $root . '/' . ltrim((string) $blus_header_path, '/\\');
        $footerPath = $root . '/' . ltrim((string) $blus_footer_path, '/\\');
        $header = is_file($headerPath) ? (string) file_get_contents($headerPath) : '<!doctype html><html><body><main><h1>';
        $footer = is_file($footerPath) ? (string) file_get_contents($footerPath) : '</main></body></html>';
        $statusTexts = [403 => 'Forbidden', 404 => 'Not Found', 500 => 'Internal Server Error'];
        $statusText = $statusTexts[$blus_error_code] ?? 'Server Error';

        http_response_code($blus_error_code);
        $header = str_replace('lang="de"', 'lang="' . htmlspecialchars((string) $language, ENT_QUOTES, 'UTF-8') . '"', $header);
        $header = str_replace('ðŸ›‘ Unhandled Exception - PanPlay', 'Unhandled Exception - PanPlay', $header);
        $footer = str_replace('PANPLAY_ERROR_CODE', htmlspecialchars($blus_error_code . ' ' . $statusText, ENT_QUOTES, 'UTF-8'), $footer);

        echo $header;
        echo '<span jsselect="heading" jsvalues=".innerHTML:msg" jstcache="14">' .
            htmlspecialchars(sprintf($text('bluescreen_heading', '\'%s\' caused a server error'), 'PanPlay'), ENT_QUOTES, 'UTF-8') . '</span>';
        echo '<a id="error-information-button" class="hidden" onclick="toggleErrorInformationPopup();" jstcache="0"></a></h1>';
        echo '<p jsselect="summary" jsvalues=".innerHTML:msg" jstcache="3"><b><u>' .
            htmlspecialchars($text('bluescreen_exception_label', 'SERVER-Exception') . ': ' . (string) $blus_reason, ENT_QUOTES, 'UTF-8') .
            '</u></b><br>' . htmlspecialchars($text('bluescreen_explanation_label', 'Explanation'), ENT_QUOTES, 'UTF-8') . ': ' .
            (string) $blus_reason_desc . '<br><br>';
        $operatorLink = '<a href="' . htmlspecialchars((string) $copyowner_url, ENT_QUOTES, 'UTF-8') . '" target="_blank">' .
            htmlspecialchars((string) $copyowner, ENT_QUOTES, 'UTF-8') . '</a>';
        echo sprintf($text('bluescreen_operator_hint', 'Go back to the previous page. If the problem persists, inform the server operator (%s).'), $operatorLink) . '</p>';
        echo $footer;
        exit;
    }
}

if (!empty($cfg_compat_check) || (isset($_GET['lgc']) && $_GET['lgc'] === 'netscape')) {
    require __DIR__ . '/checks/compatcheck.php';
}

$attributionHashBase =
    $pp_pro_engine_name .
    $pp_pro_copyright .
    $pp_pro_license .
    $pp_pro_license_url .
    $pp_pro_company .
    $pp_pro_company_url;

if (hash('sha256', $attributionHashBase) !== $pp_pro_attribution_hash) {
    bluescreen(
        500,
        'Invalid PanPlay core attribution',
        'This PanPlay instance is misconfigured. Required core attribution data has been changed or removed.'
    );
}
