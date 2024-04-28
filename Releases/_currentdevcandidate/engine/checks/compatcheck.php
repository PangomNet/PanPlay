<?php

// Browser-Infos auslesen
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Liste der nicht kompatiblen Browser und Versionen (vor 2020)
$incompatibleBrowsers = array(
    'MSIE' => 11,  // Internet Explorer 11 und älter
    'Firefox' => 70,  // Firefox Version 70 und älter
    'Chrome' => 79,  // Chrome Version 79 und älter
    'Safari' => 12,  // Safari Version 12 und älter
    'Opera' => 60,  // Opera Version 60 und älter
);

// Prüfen, ob der Browser kompatibel ist
$compatible = true;

foreach ($incompatibleBrowsers as $browser => $version) {
    $pattern = '/'.$browser.'\/([\d.]+)/';

    if (preg_match($pattern, $userAgent, $matches)) {
        $browserVersion = (int)$matches[1];

        if ($browserVersion <= $version) {
            $compatible = false;
            echo "Nicht kompatibler Browser: $browser $browserVersion"; // Debug-Ausgabe
            break;
        }
    }
}

// Falls nicht kompatibel, Browsercompat-Quellcode nachladen
if (!$compatible) {
    // Hier den Quellcode von browsercompat.html einfügen oder den Pfad entsprechend anpassen
    $browserCompatHTML = file_get_contents('https://ownonline.eu/_res/compat/browsercompat.html');
    echo $browserCompatHTML;
    exit;
}

// Falls kompatibel, hier den normalen Inhalt der Webseite einfügen
/* echo "Der Browser ist kompatibel: $userAgent"; // Debug-Ausgabe */

?>
