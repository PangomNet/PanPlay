<?php

// set global vars
require_once __DIR__ . '/../data/storage.php';

if (!empty($cfg_debug_mode)) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
}

// bluescreen vars:
require('engine/lang_loader.php');

if (!empty($cfg_compat_check) || (isset($_GET['lgc']) && $_GET['lgc'] === 'netscape')) {
    require('engine/checks/compatcheck.php');
}

// Überprüfen, ob die URL-Parameter für mindestens eine Wiedergabe-Erweiterung vorhanden sind
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
$webstream = isset($_GET['webstream']) ? $_GET['webstream'] : '';

$doctitle = "Player - PanPlay";

echo "<!DOCTYPE html>";
echo "<html lang=" . $language . ">";
echo "<html prefix='og: https://ogp.me/ns#'>";
echo "<title>Player - PanPlay</title>";

// set global vars
// bluescreen vars:
// Runtime configuration is loaded from data/storage.php at the top of this file.


// Funktion zum Auslösen des Bluescreens
function bluescreen($blus_error_code = 500, $blus_reason = null, $blus_reason_desc = null)
{
    global $copyowner, $copyowner_url, $blus_header_path, $blus_footer_path, $lang, $language;

    $blus_text = function ($key, $fallback) use ($lang) {
        return isset($lang[$key]) ? $lang[$key] : $fallback;
    };

    if (!is_numeric($blus_error_code)) {
        $legacy_reason = $blus_error_code;
        $legacy_desc = $blus_reason;
        $blus_error_code = 500;
        $blus_reason = $legacy_reason;
        $blus_reason_desc = $legacy_desc;
    }

    $blus_error_code = (int)$blus_error_code;
    if ($blus_error_code < 100 || $blus_error_code > 599) {
        $blus_error_code = 500;
    }

    if ($blus_reason === null || $blus_reason === '') {
        $blus_reason = 'Unhandled exception';
    }

    if ($blus_reason_desc === null) {
        $blus_reason_desc = '';
    }

    http_response_code((int)$blus_error_code);

    // Header und Footer aus den Dateien laden
    $blus_header = file_get_contents($blus_header_path);
    $blus_footer = file_get_contents($blus_footer_path);
    $status_texts = [
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];
    $blus_status_text = isset($status_texts[$blus_error_code]) ? $status_texts[$blus_error_code] : 'Server Error';
    $blus_header = str_replace('lang="de"', 'lang="' . htmlspecialchars($language) . '"', $blus_header);
    $blus_header = str_replace('ðŸ›‘ Unhandled Exception - PanPlay', 'Unhandled Exception - PanPlay', $blus_header);
    $blus_footer = str_replace('PANPLAY_ERROR_CODE', htmlspecialchars($blus_error_code . ' ' . $blus_status_text), $blus_footer);

    // Hier implementierst du den Code für den Bluescreen
    // Zum Beispiel:
    echo $blus_header;
    echo '<span jsselect="heading" jsvalues=".innerHTML:msg" jstcache="14">' . htmlspecialchars(sprintf($blus_text('bluescreen_heading', '\'%s\' caused a server error'), 'PanPlay')) . '</span>';
    echo '<a id="error-information-button" class="hidden" onclick="toggleErrorInformationPopup();" jstcache="0"></a>';
    echo '</h1>';
    echo '<p jsselect="summary" jsvalues=".innerHTML:msg" jstcache="3"><b><u>' . htmlspecialchars($blus_text('bluescreen_exception_label', 'SERVER-Exception')) . ': ' . htmlspecialchars($blus_reason) . '</u></b><br>';
    echo htmlspecialchars($blus_text('bluescreen_explanation_label', 'Explanation')) . ': ' . $blus_reason_desc . '<br><br>';
    $operatorLink = '<a href="' . htmlspecialchars($copyowner_url) . '" target="_blank">' . htmlspecialchars($copyowner) . '</a>';
    echo sprintf($blus_text('bluescreen_operator_hint', 'Go back to the previous page. If the problem persists, inform the server operator (%s).'), $operatorLink) . '</p>';
    echo $blus_footer;
    exit;
}

function verifyPanPlayCoreAttribution()
{
    global $pp_pro_engine_name, $pp_pro_copyright, $pp_pro_license, $pp_pro_license_url,
           $pp_pro_company, $pp_pro_company_url, $pp_pro_attribution_hash;

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
            'This PanPlay instance is misconfigured. Required core attribution data has been changed or removed. The copyright notice and license notice are mandatory parts of the PanPlay engine distribution.'
        );
    }
}

verifyPanPlayCoreAttribution();


// Lade den Inhalt der ver.php-Datei und suche nach Variablenzuweisungen
$ver_content = file_get_contents('engine/ver.php');
$matches = [];

// Suche nach Variablenzuweisungen im Format "$variablename = 'value';"
preg_match_all('/\$(\w+)\s*=\s*[\'"]([^\'"]+)[\'"];/i', $ver_content, $matches);

// Extrahiere die Variablennamen und -werte
$variables = array_combine($matches[1], $matches[2]);

// Prüfe, ob die zugehörigen Dateien existieren
$files = [
    'engine/error/centralerrorlog_c.php',
    'engine/error/centralerrorlog_ui.php',
    'engine/checks/compatcheck.php',
    'engine/checks/subdomaincheck.php',
    'engine/checks/offlinehandler.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        // Wenn eine Datei fehlt, rufe die Bluescreen-Funktion auf und übergebe den Serverbetreiber und die URL
        bluescreen(404, "File not found: $file", "'\'PanPlay\' referred to a non-existent document on this server using the method \'required\'. This ... hehe ... requires that the server may only execute the web application if this document exists ... but it is not. The server was therefore unable to process this request and aborted the process. Doomsday.");
    }
}

//triggerhapy?: Test the Bluescreen
 // bluescreen(500, "JUST FOR FUN. THATS YOUR COMPANY NAME: $copyowner", "You know, sometimes as a developer you just want to see what happens when your program crashes without knowing that something is broken.");



// Speichere die Parameter in einem Array
$streams = [$lfmstream, $webstream];

// Überprüfe, ob alle Parameter leer oder nicht vorhanden sind
$allEmpty = true;
foreach ($streams as $stream) {
    if (!empty($stream)) {
        $allEmpty = false;
        break;
    }
}



// Wenn alle Parameter leer sind oder fehlen, wird der Seiteninhalt durch "nomedia.html" ersetzt
if ($allEmpty) {
    include('engine/error/pages/nomedia.html');
    exit;
}
//VOLUME
$vol= 0.0;
$vol = isset($_GET['vol']) ? $_GET['vol'] : '';


// EXTENSIONS-LOADER
$extensions_credits = "";
require('engine/extensions/ext-loader.php');

// Veraltete Erkennungsmethode
// Setzen des playermode basierend auf den URL-Parametern
//$playermode = '';
//if (!empty($lfmstream)) {
//    $playermode = 'laut';
//} elseif (!empty($webstream)) {
//    $playermode = 'webstream';
//}



///////////////// EXTENSIONS


?>
