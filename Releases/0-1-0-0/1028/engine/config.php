<?php

$firstrundone = true;

/// About this Installtion of PanPlay
// Name of your Company/website etc.
$copyowner = 'Pangom (PanPlay CDN)';
// URL for Website of your Company/website etc. 
$copyowner_url = 'https://pangom.net/';
$copyowner_mail = 'inbox@pangom.net';
$copyowner_webmaster_url = 'https://pangom.net/';
$copyowner_webmaster_mail = 'inbox@pangom.net';
// For Legal-Reasons: Define a URL to your Impress oder Priacy-Policy (for the Server, on which PanPlay is running) If you do not have such a site, please get one, especially if your server is accessible on the Internet. There are legal reasons for this. You can have such documents generated on various websites. If you now have an imprint and a data protection declaration, but no page for it, you can also insert it into the legal file accordingly in /legal/index.php and then set the options "privacy_url_external" and "impress_url_external" to false.
$privacy_url_external = true;
$privacy_url = 'https://play.pangom.net/privacy';
$impress_url_external = true;
$impress_url = 'https://play.pangom.net/impress';
// Choose, if you want to show smal dredits fpr Authopr of the PanPlay externsion, which is used in the "About PanPlay" Window (true/false)
$enable_extension_credits = true;

//bluescreen-Page-Paths
$blus_header_path = 'engine/error/pages/bluescreen-head.html';
$blus_footer_path = 'engine/error/pages/bluescreen-bottom.html';


/////ATTENTION: CPM not yet actively implemented. These are only preparatory configurations for later integration.
// Content-Protection-Mechanism (CPM)
// This will configure the Content-Protection-Mechanism (CPM).
// $cpm_running = true : Default value true - Here you can deactivate the CPM, for which you must set the option to false. Attention: If you do this, the extension “Basic-HTML5-PLAYER by Pangom” will not start, as the CPM is a prerequisite for using the extension. This has legal reasons.
// $cpm_cloudmode = true : Default value true - If you do not want to be bothered with DMCA or other copyright requests, set or leave this value to true. Then the central PanPlay CPM on our server will be used. Your PanPlay copy then accesses our blacklist before playing media and refuses playback if necessary. Copyright requests are then also sent to Pangom and processed there.
$cpm_running = true;
$cpm_cloudmode = true; 

?>
