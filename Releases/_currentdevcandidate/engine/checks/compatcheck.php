<?php

// Browser-Infos auslesen
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Liste der nicht kompatiblen Browser und Versionen (vor 2020)
$incompatibleBrowsers = array(
    'MSIE' => 12,  // Internet Explorer 12 und älter
    'Firefox' => 75,  // Firefox Version 75 und älter
    'Chrome' => 80,  // Chrome Version 80 und älter
    'Safari' => 13,  // Safari Version 13 und älter
    'Opera' => 65,  // Opera Version 65 und älter
    'Edg' => 100,  // Edg Version 100 und älter
    'Edge' => 100,  // Edge Version 100 und älter
);

// Prüfen, ob der Browser kompatibel ist
$compatible = true;

foreach ($incompatibleBrowsers as $browser => $version) {
    $pattern = '/'.$browser.'\/([\d.]+)/';

    if (preg_match($pattern, $userAgent, $matches)) {
        $browserVersion = (int)$matches[1];

        if ($browserVersion <= $version) {
            $compatible = false;
            echo "Outdated Brtowser: $browser $browserVersion"; // Debug-Ausgabe
            break;
        }
    }
}

// Falls nicht kompatibel, Browsercompat-Quellcode nachladen
if (!$compatible) {
    // Hier den Quellcode von browsercompat.html einfügen oder den Pfad entsprechend anpassen
    $browserCompatHTML = file_get_contents('https://pangom.net/_res/compat/browsercompat.html');
    echo $browserCompatHTML;
    exit;
}

// Falls kompatibel, hier den normalen Inhalt der Webseite einfügen
/* echo "Der Browser ist kompatibel: $userAgent"; // Debug-Ausgabe */

?>
