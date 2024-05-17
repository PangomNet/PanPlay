<?php

// Registriere deine Erweiterung so, dass sie den Vorgaben entspricht in dieser Datei.

// Baseaudio
if (!empty($webstream)) {
    require('engine/extensions/baseaudio/extension.init.php');
}

// LAUT-Erweiterung
if (!empty($lfmstream)) {
    require('engine/extensions/laut/extension.init.php');
}

?>