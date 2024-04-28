<?php

// Funktion zum Auslösen des Bluescreens
function bluescreen($error_code, $reason, $copyowner, $copyowner_url)
{
    // Pfade zu den Header- und Footer-Dateien
    $header_path = 'engine/error/pages/bluescreen-head.html';
    $footer_path = 'engine/error/pages/bluescreen-bottom.html';

    // Header und Footer aus den Dateien laden
    $header = file_get_contents($header_path);
    $footer = file_get_contents($footer_path);

    // Hier implementierst du den Code für den Bluescreen
    // Zum Beispiel:
    echo $header;
    echo '<span jsselect="heading" jsvalues=".innerHTML:msg" jstcache="14">\'oOPlay\' hat einen Serverfehler verursacht</span>';
    echo '<a id="error-information-button" class="hidden" onclick="toggleErrorInformationPopup();" jstcache="0"></a>';
    echo '</h1>';
    echo '<p jsselect="summary" jsvalues=".innerHTML:msg" jstcache="3"><b><u>SERVER-Exception: ' . htmlspecialchars($reason) . '</u></b><br><br>Erklärung: \'oOPlay\' hat mit der Methode \'required\' auf ein nicht existentes Dokument auf diesem Server verwiesen. Der Server konnte diese Anfrage nicht verarbeiten und hat den Vorgang abgebrochen.<br><br>';
    echo '<br><br>Navigieren Sie zur vorherigen Seite zurück. Wenn das Problem weiterhin besteht, informieren Sie den Serverbetreiber (<a href="' . htmlspecialchars($copyowner_url) . '" target="_blank">' . htmlspecialchars($copyowner) . '</a>). </p>';
    echo $footer;
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
        bluescreen(404, "File not found: $file", $variables['copyowner'], $variables['copyowner_url']);
    }
}

// Überprüfen, ob die URL-Parameter lfmstream und webstream vorhanden sind
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
$webstream = isset($_GET['webstream']) ? $_GET['webstream'] : '';

// Wenn beide Parameter leer oder nicht vorhanden sind, oder beide Parameter Inhalt haben, wird der Seiteninhalt durch "src/nomedia.html" ersetzt
if ((empty($lfmstream) && empty($webstream)) || (!empty($lfmstream) && !empty($webstream))) {
    include('engine/error/pages/nomedia.html');
    exit;
}

// Setzen des playermode basierend auf den URL-Parametern
$playermode = '';
if (!empty($lfmstream)) {
    $playermode = 'lautstream';
} elseif (!empty($webstream)) {
    $playermode = 'webstream';
}

// Basis-URL für den Stream
$streamBaseUrl = 'https://stream.laut.fm/';

// Streaming-URL erstellen
$streamUrl = '';
if ($playermode === 'lautstream') {
    $streamUrl = $streamBaseUrl . $lfmstream;
} elseif ($playermode === 'webstream') {
    $streamUrl = $webstream;
}

///////////////// EXTENSIONS

// START > LAUT
if ($playermode === 'lautstream') {
    require('engine/extensions/laut/extension.init.php');
}
// ENDE > LAUT


// START > WEBAPI
if ($playermode === 'webstream') {
        require('engine/webapi.php');
    }

// ENDE > WEBAPI
?>