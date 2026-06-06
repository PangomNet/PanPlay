<?php
$extension_active = true;
$playermode = 'baseaudio';
$extlangpath = 'engine/extensions/' . $playermode . '/lang/' . $language . '.php';
require($extlangpath );
$baseaudioExtensionCredit = 'Basic-HTML5-PLAYER by Pangom';
if (isset($about_extension_link) && $about_extension_link) {
    $extensions_credits .= "<span class='text-white small'><i class='fas fa-plug me-2'></i>Extension</span>";
    $extensions_credits .= "<span class='about-extension-credit-value badge bg-dark'><a href='https://play.pangom.net/?from=PanPlay-Extension' target='_blank'>" . $baseaudioExtensionCredit . "</a></span>";
} else {
    $extensions_credits .= "<span class='text-white small'><i class='fas fa-plug me-2'></i>Extension</span>";
    $extensions_credits .= "<span class='about-extension-credit-value badge bg-dark'>" . $baseaudioExtensionCredit . "</span>";
}



// Streaming-URL erstellen

    $streamUrl = $webstream;







        echo "<meta property='og:title' content='🎶" . $webstream . " - PanPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre " . $webstream ." in PanPlay!' />";
        //require('engine/extensions/laut/lautapi.php');








?>
