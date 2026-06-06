<?php

/**
 * Pangom Digital Services - Browser Compatibility Check 2026
 * Legacy bypass: ?lgc=on
 * Forced legacy test mode: ?lgc=netscape
 */

$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$legacyMode = isset($_GET['lgc']) ? $_GET['lgc'] : '';
$legacyBypass = ($legacyMode === 'on');
$forceLegacyFailure = ($legacyMode === 'netscape');

// Definition der Inkompatibilitäts-Schwellenwerte (Stand 2026)
// Browser mit Versionen kleiner oder gleich dieser Werte werden abgelehnt.
$incompatibleBrowsers = [
    'MSIE'     => 11,  // Internet Explorer (alle Versionen)
    'Trident'  => 7,   // IE 11 Core
    'Edge'     => 44,  // Legacy Edge (HTML-basiert)
    'Edg'      => 90,  // Chromium Edge
    'Vivaldi'  => 4,   // Ältere Vivaldi Versionen
    'OPR'      => 70,  // Opera (Chromium-basiert)
    'Opera'    => 65,  // Altes Opera
    'Firefox'  => 85,  // Firefox (älter als 2021/2022)
    'Chrome'   => 85,  // Chrome
    'Safari'   => 13,  // Safari (macOS/iOS)
];

$compatible = !$forceLegacyFailure;
$detectedBrowser = "Unknown";
$detectedVersion = 0;

// Der Check wird nur ausgeführt, wenn der Legacy-Bypass (lgc=on) NICHT aktiv ist.
if (!$legacyBypass && !$forceLegacyFailure) {
    // Präzisere Prüfung der Browser-Hierarchie
    // Wir prüfen erst die spezifischen (Vivaldi, Edge), dann die Basis-Engines (Chrome, Safari).
    foreach ($incompatibleBrowsers as $browser => $minVersion) {
        if (stripos($userAgent, $browser) !== false) {
            // Extrahiere die Versionsnummer
            $pattern = '/(?i)' . $browser . '[\/ ]?([0-9]+)/';
            if (preg_match($pattern, $userAgent, $matches)) {
                $detectedVersion = (int)$matches[1];
                $detectedBrowser = $browser;

                if ((int)$matches[1] <= $minVersion) {
                    $compatible = false;
                    break;
                }
            }
        }
    }

    // Spezielle Prüfung für Brave (da Brave oft keinen eigenen UA-String sendet)
    if ($compatible && stripos($userAgent, 'Chrome') !== false && stripos($userAgent, 'Brave') !== false) {
        // Falls Brave identifiziert wird, aber Chrome-Version zu alt ist
        if (preg_match('/Chrome\/([0-9]+)/', $userAgent, $matches)) {
            if ((int)$matches[1] <= 85) {
                $compatible = false;
            }
        }
    }
}

if ($forceLegacyFailure) {
    $detectedBrowser = 'Netscape';
    $detectedVersion = 4;
}

function getDetectedBrowserHelpUrl($detectedBrowser, $userAgent) {
    if ($detectedBrowser === 'Firefox') {
        return ['Firefox', 'https://www.mozilla.org/firefox/'];
    }

    if ($detectedBrowser === 'Edg' || $detectedBrowser === 'Edge') {
        return ['Microsoft Edge', 'https://www.microsoft.com/edge/'];
    }

    if ($detectedBrowser === 'Vivaldi') {
        return ['Vivaldi', 'https://vivaldi.com/'];
    }

    if ($detectedBrowser === 'OPR' || $detectedBrowser === 'Opera') {
        return ['Opera', 'https://www.opera.com/'];
    }

    // Chrome user agents are also used as a base by Edge, Opera, and Vivaldi.
    if (
        $detectedBrowser === 'Chrome' &&
        stripos($userAgent, 'Edg/') === false &&
        stripos($userAgent, 'OPR/') === false &&
        stripos($userAgent, 'Opera') === false &&
        stripos($userAgent, 'Vivaldi/') === false
    ) {
        return ['Google Chrome', 'https://www.google.com/chrome/'];
    }

    if ($detectedBrowser === 'Safari' && stripos($userAgent, 'Chrome/') === false) {
        return ['Safari', 'https://support.apple.com/safari'];
    }

    return null;
}

if (!$compatible) {
    $compatText = function ($key, $fallback) use ($lang) {
        return isset($lang[$key]) ? $lang[$key] : $fallback;
    };

    $detectedLabel = trim($detectedBrowser . ' ' . $detectedVersion);
    if ($detectedLabel === 'Unknown 0') {
        $detectedLabel = 'Unknown';
    }

    $detectedBrowserHelp = getDetectedBrowserHelpUrl($detectedBrowser, $userAgent);
    $detectedBrowserHelpHtml = '';
    if ($detectedBrowserHelp !== null) {
        $detectedBrowserHelpHtml =
            '<br><a target="_blank" href="' . htmlspecialchars($detectedBrowserHelp[1], ENT_QUOTES, 'UTF-8') . '">' .
            htmlspecialchars($compatText('compat_detected_browser_link', 'Open the website for your detected browser') . ' (' . $detectedBrowserHelp[0] . ')', ENT_QUOTES, 'UTF-8') .
            '</a>';
    }

    $reasonDescription =
        htmlspecialchars($compatText('compat_sub_headline', 'The requested content is not supported by your device or software.'), ENT_QUOTES, 'UTF-8') .
        '<br><br>' .
        htmlspecialchars($compatText('compat_desc_1', 'This website provides its content to a broad audience, supporting even older browsers.'), ENT_QUOTES, 'UTF-8') .
        '<br><br>' .
        htmlspecialchars($compatText('compat_desc_2', 'However, your current software is classified as highly incompatible and insecure. Therefore, the content was not delivered.'), ENT_QUOTES, 'UTF-8') .
        '<br><br><b>ERR_BLOCKED_BY_SERVER</b>' .
        '<br><br><b>' . htmlspecialchars($compatText('compat_ts_title', 'Troubleshooting Information'), ENT_QUOTES, 'UTF-8') . '</b>' .
        '<br>' . htmlspecialchars($compatText('compat_detected_browser', 'Detected Browser'), ENT_QUOTES, 'UTF-8') . ': <code>' . htmlspecialchars($detectedLabel, ENT_QUOTES, 'UTF-8') . '</code>' .
        '<br>' . htmlspecialchars($compatText('compat_user_agent', 'Full User Agent String'), ENT_QUOTES, 'UTF-8') . ': <code>' . htmlspecialchars($userAgent, ENT_QUOTES, 'UTF-8') . '</code>' .
        '<br><br><b>' . htmlspecialchars($compatText('compat_recommended_action', 'Recommended action'), ENT_QUOTES, 'UTF-8') . '</b>' .
        '<br>' . htmlspecialchars($compatText('compat_recommended_desc', 'Please use modern browser software to access this PanPlay instance.'), ENT_QUOTES, 'UTF-8') .
        '<br><a target="_blank" href="https://browser.pangom.net/">' . htmlspecialchars($compatText('compat_more_help', 'More help and background information'), ENT_QUOTES, 'UTF-8') . '</a>' .
        '<br><a target="_blank" href="https://www.mozilla.org/firefox/">Firefox</a>' .
        '<br><a target="_blank" href="https://www.microsoft.com/edge/">Microsoft Edge</a>' .
        '<br><a target="_blank" href="https://vivaldi.com/">Vivaldi</a>' .
        $detectedBrowserHelpHtml;

    bluescreen(
        403,
        $compatText('compat_headline', 'Content not supported!'),
        $reasonDescription
    );
}

// Ab hier beginnt der reguläre Inhalt für moderne Browser
?>
