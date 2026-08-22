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

    require_once __DIR__ . '/cpm.php';
    panplayCpmEnforceBaseaudio($streamUrl);

    require_once __DIR__ . '/metadata.php';
    $baseaudioMetadata = panplayBaseaudioReadMetadata($streamUrl);







        $baseaudioOgTitle = (string) ($baseaudioMetadata['title'] ?? $webstream);
        $baseaudioOgUrl = (isset($_SERVER['HTTP_HOST']) ? '//' . $_SERVER['HTTP_HOST'] : '') . ($_SERVER['REQUEST_URI'] ?? '');
        echo '<meta property="og:title" content="' . htmlspecialchars($baseaudioOgTitle . ' - PanPlay', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">';
        echo '<meta property="og:type" content="music.song">';
        echo '<meta property="og:url" content="' . htmlspecialchars($baseaudioOgUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">';
        echo '<meta property="og:description" content="' . htmlspecialchars($baseaudioOgTitle . ' in PanPlay', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">';
        //require('engine/extensions/laut/lautapi.php');








?>
