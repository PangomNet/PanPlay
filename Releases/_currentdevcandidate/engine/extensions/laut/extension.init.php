<?php

$extension_active = true;
$playermode = 'laut';
$extlangpath = 'engine/extensions/' . $playermode . '/lang/' . $language . '.php';
require($extlangpath );

// Debug: Show Path to language file
//echo "<h1>" . $extlangpath . "</h1>";

$extension_logo_html = "<img class='' style='width:min(100%, 128px); height:auto;' alt='laut.fm-Extension by Pangom' src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIKCSB3aWR0aD0iNDMyLjg2MnB4IiBoZWlnaHQ9IjEzNi44MXB4IiB2aWV3Qm94PSIwIDAgNDMyLjg2MiAxMzYuODEiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDQzMi44NjIgMTM2LjgxIgoJIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iI0ZGRkZGRiIgZD0iTTYyLjQ5NiwwYzM0LjQxNiwwLDYyLjQ5NiwyOC4wMDgsNjIuNDk2LDYyLjM1MgoJYzAsMzQuNDE2LTI4LjA4LDYyLjQyNS02Mi40OTYsNjIuNDI1UzAsOTYuNzY4LDAsNjIuMzUyQzAsMjguMDA4LDI4LjA4LDAsNjIuNDk2LDBMNjIuNDk2LDB6IE02Mi40OTYsMjAuNTIKCWMxNi40MTYsMCwzNS42NCwxMS41MjEsMzUuNjQsNDAuMDMyYzAsNy41NiwwLDEyLjY3Mi0yLjY2NCwxOS44NzJoOC4zNTJsOC4zNTItNC44OTZjMC43OTItNy4yNzEsMC43OTItMTQuOTAzLDAtMjIuODk2CglsLTguNDI0LTQuMzkzYzAtMy4wMjMtOC43MTItMzMuNTUxLTQxLjI1Ni0zMy41NTFjLTMyLjQ3MiwwLTQxLjI1NiwzMC41MjctNDEuMjU2LDMzLjU1MWwtOC40MjQsNC4zOTMKCWMtMC43OTIsNy45OTItMC43MiwxNS42MjQsMCwyMi44OTZsOC4zNTIsNC44OTZoOC40MjRjLTIuNzM2LTcuMi0yLjczNi0xMi4zMTItMi43MzYtMTkuODcyQzI2Ljg1NiwzMi4wNCw0Ni4wOCwyMC41Miw2Mi40OTYsMjAuNTIKCUw2Mi40OTYsMjAuNTJ6IE02Mi40OTYsMjYuNDI0Yy0xNi45OTIsMC0zMC45NiwxMy44OTYtMzAuOTYsMzAuODg4djYuNDhjMCw0LjUzNSwxLjE1Miw5LjkzNiwzLjA5NiwxNS4zMzYKCWMyLjczNiw3LjQ4Nyw3Ljg0OCwxNS44NCwxNC40LDI0LjY5NWMxLjIyNCwxLjU4NCwyLjgwOCwyLjU5Myw0Ljc1MiwzLjAyNGgxNy4yMDhjMi4yMzItMC4zNTksNC4wMzItMS42NTYsNC43NTItMy4wMjQKCWM2LjA0OC04LjEzNSwxMS4zMDQtMTYuNDE2LDE0Ljc2LTI0LjkxMmMxLjk0NC01LjMyNywzLjAyNC0xMC42NTUsMy4wMjQtMTUuMTE5di02LjQ4QzkzLjUyOCw0MC4zMTksNzkuNTYsMjYuNDI0LDYyLjQ5NiwyNi40MjQKCUw2Mi40OTYsMjYuNDI0TDYyLjQ5NiwyNi40MjR6IE02Mi40OTYsMzMuMzM2Yy0xMy44OTYsMC0yNS4yLDExLjE2LTI1LjIsMjQuNzY4djUuMTEyYzAsNC4xNzYsMS4xNTIsOS4xNDUsMy4wOTYsMTQuMDQKCWMyLjUyLDcuMTI4LDYuNTUyLDE0LjQ3MiwxMi43NDQsMjIuMTc2YzAuNjQ4LDEuMTUyLDEuOCwxLjU4NCwzLjMxMiwxLjU4NGgxMi4wMjRjMS41MTItMC4wNzEsMi41OTItMC41MDQsMy4xNjgtMS41MTIKCWM1Ljk3Ni03Ljg0OCwxMC4xNTItMTUuNDgsMTMuMzItMjMuMDRjMS44LTQuNjA3LDIuODA4LTkuMjg4LDIuODA4LTEzLjI0OHYtNS4xMTJDODcuNzY4LDQ0LjQ5Niw3Ni4zOTIsMzMuMzM2LDYyLjQ5NiwzMy4zMzYKCUw2Mi40OTYsMzMuMzM2eiIvPgo8Zz4KCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xNjMuNDY5LDIyLjQ1OHY4MC42MzRIMTQyLjc1VjIyLjQ1OEgxNjMuNDY5eiIvPgoJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTE4OC42Nyw2Mi42MDFoLTE4Ljg3NnYtNC40MzNjMC01LjExMiwwLjU4OS05LjA1NiwxLjc2OC0xMS44MjhzMy41NDQtNS4yMjIsNy4wOTgtNy4zNDcKCQljMy41NTMtMi4xMjQsOC4xNjgtMy4xODgsMTMuODQ2LTMuMTg4YzYuODA2LDAsMTEuOTM2LDEuMjA0LDE1LjM5LDMuNjFjMy40NTMsMi40MDgsNS41MjgsNS4zNjMsNi4yMjYsOC44NjUKCQljMC42OTcsMy41MDQsMS4wNDYsMTAuNzE3LDEuMDQ2LDIxLjY0MXYzMy4xN2gtMTkuNTczdi01Ljg5Yy0xLjIyOSwyLjM2Mi0yLjgxNCw0LjEzMy00Ljc1Niw1LjMxMwoJCWMtMS45NDMsMS4xODEtNC4yNTksMS43NzEtNi45NDgsMS43NzFjLTMuNTIsMC02Ljc0OS0wLjk4OC05LjY4Ny0yLjk2M2MtMi45MzktMS45NzYtNC40MDgtNi4zMDEtNC40MDgtMTIuOTc1di01LjQyOQoJCWMwLTQuOTQ3LDAuNzc5LTguMzE3LDIuMzQxLTEwLjExYzEuNTYxLTEuNzkzLDUuNDI5LTMuODg1LDExLjYwNC02LjI3NWM2LjYwNi0yLjU5LDEwLjE0My00LjMzMywxMC42MDgtNS4yMjkKCQljMC40NjUtMC44OTYsMC42OTctMi43MjIsMC42OTctNS40NzljMC0zLjQ1My0wLjI1OC01LjcwMi0wLjc3Mi02Ljc0OWMtMC41MTUtMS4wNDUtMS4zNjktMS41NjgtMi41NjQtMS41NjgKCQljLTEuMzYyLDAtMi4yMDksMC40NC0yLjU0LDEuMzJjLTAuMzMyLDAuODgtMC40OTgsMy4xNjItMC40OTgsNi44NDhWNjIuNjAxeiBNMTk1LjA0NSw3MS42NjUKCQljLTMuMjIxLDIuMzU4LTUuMDg5LDQuMzMzLTUuNjAzLDUuOTI3Yy0wLjUxNiwxLjU5NC0wLjc3MiwzLjg4NS0wLjc3Miw2Ljg3M2MwLDMuNDIsMC4yMjQsNS42MjgsMC42NzMsNi42MjQKCQljMC40NDcsMC45OTYsMS4zMzYsMS40OTQsMi42NjQsMS40OTRjMS4yNjIsMCwyLjA4My0wLjM5LDIuNDY1LTEuMTcxYzAuMzgyLTAuNzc5LDAuNTczLTIuODMsMC41NzMtNi4xNVY3MS42NjV6Ii8+Cgk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMjY4LjE1OCwzNy4wMDF2NjYuMDkxaC0yMC40N2wwLjM0OS01LjQ5MWMtMS4zOTUsMi4yMjktMy4xMTIsMy45LTUuMTU1LDUuMDE1CgkJYy0yLjA0MSwxLjExNC00LjM5MSwxLjY3Mi03LjA0NywxLjY3MmMtMy4wMjEsMC01LjUyOC0wLjUzMS03LjUyMS0xLjU5NHMtMy40NjItMi40NzMtNC40MDctNC4yMzMKCQljLTAuOTQ3LTEuNzYtMS41MzctMy41OTQtMS43NjktNS41MDNjLTAuMjMyLTEuOTA5LTAuMzQ5LTUuNzAzLTAuMzQ5LTExLjM4MVYzNy4wMDFoMjAuMTIxdjQ0Ljk3NAoJCWMwLDUuMTQ3LDAuMTU3LDguMjAxLDAuNDczLDkuMTY0YzAuMzE1LDAuOTY0LDEuMTcxLDEuNDQ0LDIuNTY1LDEuNDQ0YzEuNDk0LDAsMi4zODItMC40OTgsMi42NjUtMS40OTQKCQljMC4yODEtMC45OTYsMC40MjMtNC4yLDAuNDIzLTkuNjEyVjM3LjAwMUgyNjguMTU4eiIvPgoJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTI5Ni41OTcsMjguMTg2djEwLjQwOWg1LjQyOXYxMC40NTloLTUuNDI5djM1LjM2MWMwLDQuMzUxLDAuMjI1LDYuNzczLDAuNjcyLDcuMjcxCgkJYzAuNDQ5LDAuNDk4LDIuMzE2LDAuNzQ3LDUuNjA0LDAuNzQ3djEwLjY1OGgtOC4xMThjLTQuNTgyLDAtNy44NTMtMC4xOS05LjgxMi0wLjU3MmMtMS45Ni0wLjM4Mi0zLjY4Ni0xLjI2Mi01LjE4LTIuNjQxCgkJYy0xLjQ5NC0xLjM3Ny0yLjQyNC0yLjk1NC0yLjc4OS00LjczYy0wLjM2Ni0xLjc3Ni0wLjU0OC01Ljk1Mi0wLjU0OC0xMi41MjZWNDkuMDU0aC00LjMzM1YzOC41OTVoNC4zMzNWMjguMTg2SDI5Ni41OTd6Ii8+Cgk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMzIyLjg5NCw4Ni42NTZ2MTYuNDM2aC0xNS4xOVY4Ni42NTZIMzIyLjg5NHoiLz4KCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0zNTMuOTcyLDIyLjQ1OHYxMC4yMWMtNC4xNTEsMC02LjU5OSwwLjE5MS03LjM0NywwLjU3MmMtMC43NDYsMC4zODMtMS4xMiwxLjQ3LTEuMTIsMy4yNjN2Mi4wOTJoOC40NjcKCQl2MTAuNDU5aC00Ljc4MXY1NC4wMzhoLTIwLjEyMVY0OS4wNTRoLTQuMTM0VjM4LjU5NWg0LjEzNGMwLTQuMzUsMC4xNDktNy4yNTQsMC40NDgtOC43MTZjMC4yOTktMS40NjEsMS4wMzctMi43NjQsMi4yMTctMy45MQoJCWMxLjE3OC0xLjE0NSwyLjgzLTIuMDE3LDQuOTU1LTIuNjE0YzIuMTI0LTAuNTk4LDUuNDI5LTAuODk2LDkuOTExLTAuODk2SDM1My45NzJ6Ii8+Cgk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMzc3LjY3OSwzNy4wMDFsLTAuMzQ5LDYuMjg4YzEuNTYxLTIuNDk0LDMuNDE5LTQuMzY1LDUuNTc4LTUuNjEyYzIuMTU4LTEuMjQ3LDQuNjE0LTEuODcxLDcuMzcxLTEuODcxCgkJYzUuMzc5LDAsOS42MTIsMi40OTUsMTIuNyw3LjQ4M2MxLjY5My0yLjQ5NCwzLjYwMy00LjM2NSw1LjcyOC01LjYxMmMyLjEyNC0xLjI0Nyw0LjQ4Mi0xLjg3MSw3LjA3Mi0xLjg3MQoJCWMzLjQxOSwwLDYuMjUsMC44Myw4LjQ5MiwyLjQ5YzIuMjQsMS42NjEsMy42NzcsMy42OTQsNC4zMDgsNi4xMDFjMC42MywyLjQwOCwwLjk0Niw2LjMxOCwwLjk0NiwxMS43Mjl2NDYuOTY2aC0xOS41MjNWNjAuMDExCgkJYzAtNS42NDUtMC4xOTEtOS4xNC0wLjU3Mi0xMC40ODNjLTAuMzgzLTEuMzQ2LTEuMjcxLTIuMDE4LTIuNjY1LTIuMDE4Yy0xLjQyOCwwLTIuMzUsMC42NjUtMi43NjUsMS45OTIKCQljLTAuNDE1LDEuMzI4LTAuNjIyLDQuODMxLTAuNjIyLDEwLjUwOXY0My4wODFoLTE5LjUyM1Y2MS4xMDZjMC02LjQ3NS0wLjE1OC0xMC4zNTktMC40NzQtMTEuNjU0cy0xLjE4OC0xLjk0Mi0yLjYxNC0xLjk0MgoJCWMtMC44OTYsMC0xLjY2MSwwLjM0MS0yLjI5MSwxLjAyMWMtMC42MzEsMC42ODEtMC45NzksMS41MTEtMS4wNDYsMi40OWMtMC4wNjcsMC45NzktMC4xLDMuMDYyLTAuMSw2LjI1djQ1LjgyaC0xOS41MjNWMzcuMDAxCgkJSDM3Ny42Nzl6Ii8+CjwvZz4KPC9zdmc+Cgo='></img>";

$extensions_credits .= $extension_logo_html . "  <span class=''><a  class='' href='https://laut.fm?from=PanPlay-Extension' target='_blank'>laut.fm-Extension by Pangom</a></span>";


// Basis-URL für den Stream
$streamBaseUrl = 'https://stream.laut.fm/';

// Streaming-URL erstellen

    $streamUrl = $streamBaseUrl . $lfmstream;







        echo "<meta property='og:title' content='🎶" . $lfmstream . " - PanPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre das laut.fm-Radio " . $lfmstream ." in PanPlay! Mit Titelinformationen, Sendeplan, u.v.m.' />";
      


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