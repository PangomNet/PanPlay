<?php
// Lade cast.js-Datei in eine Variable
$castlib_content = file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/castjs/5.2.0/cast.min.js');

// Output der cast.js-Datei mit entsprechenden Headerinformationen
header('Content-Type: text/javascript');
echo $castlib_content;
?>