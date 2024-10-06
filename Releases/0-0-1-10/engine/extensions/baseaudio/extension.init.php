<?php
$extension_active = true;
$playermode = 'baseaudio';
$extlangpath = 'engine/extensions/' . $playermode . '/lang/' . $language . '.php';
require($extlangpath );
$extensions_credits .= "<span style='' class='badge bg-dark'><a href='https://ownonline.eu?from=oOP-Extension' target='_blank'>Basic-HTML5-PLAYER by ownOnline</a></span>";



// Streaming-URL erstellen

    $streamUrl = $webstream;







        echo "<meta property='og:title' content='🎶" . $webstream . " - oOPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre " . $webstream ." in oOPlay!' />";
        //require('engine/extensions/laut/lautapi.php');








?>