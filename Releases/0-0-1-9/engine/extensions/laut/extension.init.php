<?php




$extension_active = true;
$playermode = 'laut';
$extlangpath = 'engine/extensions/' . $playermode . '/lang/' . $language . '.php';
require($extlangpath );

// Debug: Show Path to language file
//echo "<h1>" . $extlangpath . "</h1>";

$extensions_credits .= "<span class='badge bg-info'><a  class='text-dark' href='https://laut.fm?from=oOP-Extension' target='_blank'>laut.fm-Extension by ownOnline</a></span>";


// Basis-URL für den Stream
$streamBaseUrl = 'https://stream.laut.fm/';

// Streaming-URL erstellen

    $streamUrl = $streamBaseUrl . $lfmstream;







        echo "<meta property='og:title' content='🎶" . $lfmstream . " - oOPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre das laut.fm-Radio " . $lfmstream ." in oOPlay! Mit Titelinformationen, Sendeplan, u.v.m.' />";
      


// Überprüfen, ob der URL-Parameter "nolfmw" vorhanden ist und ob sein Wert "j" ist
if (isset($_GET['nolfmw']) && $_GET['nolfmw'] === 'j') {
    // Wenn "nolfmfeatures" auf "j" gesetzt ist, setzen Sie alle Variablen auf false
    $sendeplan = false;
    $stationinfo = false;
    $playwith = false;
    $trackhistory = false;
} else {
    // Ansonsten setzen Sie die Variablen entsprechend der anderen URL-Parameter

    // Überprüfen, ob der URL-Parameter "sendeplan" vorhanden ist und ob sein Wert "j" ist
    if (isset($_GET['sendeplan']) && $_GET['sendeplan'] === 'j') {
        $sendeplan = true;
    } elseif (isset($_GET['sendeplan']) && $_GET['sendeplan'] === 'n') {
        $sendeplan = false;
    } else {
        $sendeplan = true; // Standardwert
    }

    // Überprüfen, ob der URL-Parameter "stationinfo" vorhanden ist und ob sein Wert "j" ist
    if (isset($_GET['stationinfo']) && $_GET['stationinfo'] === 'j') {
        $stationinfo = true;
    } elseif (isset($_GET['stationinfo']) && $_GET['stationinfo'] === 'n') {
        $stationinfo = false;
    } else {
        $stationinfo = true; // Standardwert
    }

    // Überprüfen, ob der URL-Parameter "playwith" vorhanden ist und ob sein Wert "j" ist
    if (isset($_GET['playwith']) && $_GET['playwith'] === 'j') {
        $playwith = true;
    } elseif (isset($_GET['playwith']) && $_GET['playwith'] === 'n') {
        $playwith = false;
    } else {
        $playwith = true; // Standardwert
    }

    // Überprüfen, ob der URL-Parameter "trackhistory" vorhanden ist und ob sein Wert "j" ist
    if (isset($_GET['trackhistory']) && $_GET['trackhistory'] === 'j') {
        $trackhistory = true;
    } elseif (isset($_GET['trackhistory']) && $_GET['trackhistory'] === 'n') {
        $trackhistory = false;
    } else {
        $trackhistory = true; // Standardwert
    }
}

require('engine/extensions/laut/lautapi.php');
?>