<?php

echo "<!DOCTYPE html>";
echo "<html lang='de'>";
echo "<html prefix='og: https://ogp.me/ns#'>";
echo "<title>oOPlay - Player</title>";

// set global vars
// bluescreen vars:
require('engine/config.php');


// Funktion zum Auslösen des Bluescreens
function bluescreen($blus_error_code, $blus_reason, $blus_reason_desc)
{
    global  $copyowner, $copyowner_url;


    // Pfade zu den Header- und Footer-Dateien
    $blus_header_path = 'engine/error/pages/bluescreen-head.html';
    $blus_footer_path = 'engine/error/pages/bluescreen-bottom.html';

    // Header und Footer aus den Dateien laden
    $blus_header = file_get_contents($blus_header_path);
    $blus_footer = file_get_contents($blus_footer_path);

    // Hier implementierst du den Code für den Bluescreen
    // Zum Beispiel:
    echo $blus_header;
    echo '<span jsselect="heading" jsvalues=".innerHTML:msg" jstcache="14">\'oOPlay\' hat einen Serverfehler verursacht</span>';
    echo '<a id="error-information-button" class="hidden" onclick="toggleErrorInformationPopup();" jstcache="0"></a>';
    echo '</h1>';
    echo '<p jsselect="summary" jsvalues=".innerHTML:msg" jstcache="3"><b><u>SERVER-Exception: ' . htmlspecialchars($blus_reason) . '</u></b><br><br>Erklärung: ' . htmlspecialchars($blus_reason_desc) . '<br><br>';
    echo '<br><br>Navigieren Sie zur vorherigen Seite zurück. Wenn das Problem weiterhin besteht, informieren Sie den Serverbetreiber (<a href="' . htmlspecialchars($copyowner_url) . '" target="_blank">' . htmlspecialchars($copyowner) . '</a>). </p>';
    echo $blus_footer;
    exit;
}


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
    'engine/checks/compatcheck.php',
    'engine/checks/subdomaincheck.php',
    'engine/checks/offlinehandler.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        // Wenn eine Datei fehlt, rufe die Bluescreen-Funktion auf und übergebe den Serverbetreiber und die URL
        bluescreen(404, "File not found: $file", "'\'oOPlay\' hat mit der Methode \'required\' auf ein nicht existentes Dokument auf diesem Server verwiesen. Der Server konnte diese Anfrage nicht verarbeiten und hat den Vorgang abgebrochen.");
    }
}

//triggerhapy: Test the Bluescreen
// bluescreen(500, "JUST FOR FUN. THATS YOUR COMPANY NAME: $copyowner", "You know, sometimes as a developer you just want to see what happens when your program crashes without knowing that something is broken.");

// Überprüfen, ob die URL-Parameter für mindestens eine Wiedergabe-Erweiterung vorhanden sind
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
$webstream = isset($_GET['webstream']) ? $_GET['webstream'] : '';

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

// EXTENSIONS-LOADER
$extensions_credits = "<div><div class='card' >";
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