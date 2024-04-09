<?php
// Lade FontAwesome-Datei in eine Variable
$fontawesome_content = file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

// Speichere die FontAwesome-Datei als separate CSS-Datei
file_put_contents('iconlib.css', $fontawesome_content);

// Gib eine Erfolgsmeldung aus
echo 'Font Awesome CSS wurde erfolgreich gespeichert.<br>';

// Liste der URLs der Webfont-Dateien von FontAwesome
$font_urls = [
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.eot',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.eot?#iefix',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.woff2',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.woff',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.ttf',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.svg#fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.eot',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.eot?#iefix',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.woff2',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.woff',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.ttf',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.svg#fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.eot',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.eot?#iefix',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.woff2',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.woff',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.ttf',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.svg#fontawesome'
];

// Verzeichnis für Webfont-Dateien auf dem Server
$font_directory = $_SERVER['DOCUMENT_ROOT'] . '/oop/src/webfonts';

// Überprüfen, ob das Verzeichnis existiert, andernfalls erstellen
if (!is_dir($font_directory)) {
    mkdir($font_directory, 0755, true); // Rekursives Erstellen des Verzeichnisses
}

// Durchlaufe alle Webfont-URLs
foreach ($font_urls as $font_url) {
    // Bestimme den Dateinamen aus der URL
    $font_filename = basename(parse_url($font_url, PHP_URL_PATH));

    // Lade den Inhalt der lokalen Datei, wenn sie bereits vorhanden ist
    if (file_exists($font_directory . '/' . $font_filename)) {
        $local_font_content = file_get_contents($font_directory . '/' . $font_filename);
    } else {
        $local_font_content = '';
    }

    // Lade Webfont-Datei von FontAwesome
    $font_content = file_get_contents($font_url);

    // Überprüfe, ob die lokale Datei bereits vorhanden ist und ob deren Inhalt gleich dem aktuellen Inhalt ist
    if ($local_font_content !== $font_content) {
        // Wenn die lokale Datei nicht existiert oder der Inhalt unterschiedlich ist, speichere die Webfont-Datei auf dem Server
        if (file_put_contents($font_directory . '/' . $font_filename, $font_content)) {
            echo "Datei erfolgreich gespeichert: " . $font_filename . "<br>";
        } else {
            echo "Fehler beim Speichern der Datei: " . $font_filename . "<br>";
        }
    }
}
?>