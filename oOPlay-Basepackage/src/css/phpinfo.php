<?php
echo $_SERVER['ONECOM_USER'];
echo $_SERVER['ONECOM_GROUP'];
?>

<?php

$font_directory = $_SERVER['DOCUMENT_ROOT'] . '/oop/src/webfonts';


if (is_writable($font_directory)) {
    echo 'Das Verzeichnis ist beschreibbar.';
} else {
    echo 'Das Verzeichnis ist nicht beschreibbar. Bitte ändere die Berechtigungen.';
}

// Zeigt alle Informationen (Standardwert ist INFO_ALL)
phpinfo();

// Zeigt nur die Modul-Informationen.
// phpinfo(8) führt zum gleichen Ergebnis.
phpinfo(INFO_MODULES);

?>