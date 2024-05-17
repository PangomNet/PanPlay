<?php
$extension_active = true;
$playermode = 'laut';
$extensions_credits .= "<span class='badge bg-info'><a href='https://laut.fm?from=oOP-Extension' target='_blank'>laut.fm-Extension by ownOnline</a></span>";


// Basis-URL für den Stream
$streamBaseUrl = 'https://stream.laut.fm/';

// Streaming-URL erstellen

    $streamUrl = $streamBaseUrl . $lfmstream;







        echo "<meta property='og:title' content='🎶" . $lfmstream . " - oOPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre das laut.fm-Radio " . $lfmstream ." in oOPlayer! Mit Titelinformationen, Sendeplan, u.v.m.' />";
        require('engine/extensions/laut/lautapi.php');


// Überprüfen, ob der URL-Parameter "nolfmfeatures" vorhanden ist und ob sein Wert "j" ist
if (isset($_GET['nolfmw']) && $_GET['nolfmw'] === 'j') {
        // Wenn "nolfmfeatures" auf "j" gesetzt ist, setzen Sie alle Variablen auf false
        $sendeplan = false;
        $stationinfo = false;
        $playwith = false;
        $trackhistory = false;
    } else {
        // Ansonsten setzen Sie die Variablen entsprechend der anderen URL-Parameter
        if (isset($_GET['sendeplan']) && $_GET['sendeplan'] === 'j') {
            // Wenn "sendeplan" auf "j" gesetzt ist
            $sendeplan = true;
        } elseif (isset($_GET['sendeplan']) && $_GET['sendeplan'] === 'n') {
            // Wenn "sendeplan" auf "n" gesetzt ist
            $sendeplan = false;
        } else {
            // Wenn "sendeplan" nicht gesetzt ist oder einen anderen Wert hat
            $sendeplan = true; // Standardwert
        }
    
        // Überprüfen, ob der URL-Parameter "stationinfo" vorhanden ist und ob sein Wert "j" ist
        if (isset($_GET['stationinfo']) && $_GET['stationinfo'] === 'j') {
            // Wenn "stationinfo" auf "j" gesetzt ist
            $stationinfo = true;
        } elseif (isset($_GET['stationinfo']) && $_GET['stationinfo'] === 'n') {
            // Wenn "stationinfo" auf "n" gesetzt ist
            $stationinfo = false;
        } else {
            // Wenn "stationinfo" nicht gesetzt ist oder einen anderen Wert hat
            $stationinfo = true; // Standardwert
        }
    
        // Überprüfen, ob der URL-Parameter "playwith" vorhanden ist und ob sein Wert "j" ist
        if (isset($_GET['playwith']) && $_GET['playwith'] === 'j') {
            // Wenn "playwith" auf "j" gesetzt ist
            $playwith = true;
        } elseif (isset($_GET['playwith']) && $_GET['playwith'] === 'n') {
            // Wenn "playwith" auf "n" gesetzt ist
            $playwith = false;
        } else {
            // Wenn "playwith" nicht gesetzt ist oder einen anderen Wert hat
            $playwith = true; // Standardwert
        }
    
        // Überprüfen, ob der URL-Parameter "trackhistory" vorhanden ist und ob sein Wert "j" ist
        if (isset($_GET['trackhistory']) && $_GET['trackhistory'] === 'j') {
            // Wenn "trackhistory" auf "j" gesetzt ist
            $trackhistory = true;
        } elseif (isset($_GET['trackhistory']) && $_GET['trackhistory'] === 'n') {
            // Wenn "trackhistory" auf "n" gesetzt ist
            $trackhistory = false;
        } else {
            // Wenn "trackhistory" nicht gesetzt ist oder einen anderen Wert hat
            $trackhistory = true; // Standardwert
        }
    }

?>