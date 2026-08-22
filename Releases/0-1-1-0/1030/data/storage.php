<?php
/**
 * PanPlay - Central Instance Configuration
 * This is where metadata, legal references, and global flags are managed.
 */

// Not all elements of the player currently access this configuration. Settings not yet in use are marked with 🥚

// TODO for Hosters in their own configuration: Set the values in the Hosters group accordingly; all fields marked with ⚠ are required fields. PanPlay will not start if the fields are not configured or empty.

// --- Core Runtime / First Run ---
$firstrundone = true;


// --- Player Identity ---
// Everlasting Build 1030 is the final release of the Bootstrap-based PanPlay generation.
// It remains a supported long-term beta while the next interface generation is developed.
$pro_name           = '<i class="fas fa-music"></i> Pan<span class="pangomfont text-danger">Play</span>'; //⚠
$pro_name_noformat  = '<i class="fas fa-music"></i> PanPlay'; //⚠
$pro_name_cleartext = 'PanPlay'; //⚠
$pro_version        = '0.1.1.0'; //⚠
$pro_buildversion   = '1030'; //⚠
$pro_version_name   = 'Everlasting'; //⚠
$pro_releasedate    = '23.08.2026'; //⚠
$is_prerelase       = false; // Set to true only for unstable test builds that should show the prerelease warning.

// --- Vendor & Hoster Info ---
$pro_copyright      = '2026'; //⚠

$pro_eula_vendor    = 'Pangom (PanPlay CDN)'; //⚠ Insert the name of your website or organization here, under which your PanPlay self-hosted copy is distributed.

$pro_eula_vendor_link    = 'https://play.pangom.net'; //⚠ Insert the url of your website or organization here, under which your PanPlay self-hosted copy is distributed.

$pro_eula_link      = 'https://play.pangom.net/eula?ver=' . $pro_version;

$pro_license = 'MIT-License';

$pro_license_url = 'https://www.tldrlegal.com/license/mit-license';

$pro_imprint_useremotesopurce = true; // Specifies whether the Imprint is linked to a source outside the player. True = The Imprint is located in a source other than the PanPlay instance (for example, in a WordPress blog) to which a link is provided. False = The Imprint is contained in a text file within the player data and is displayed in a separate player-controlled interface.

$pro_imprint_link   = 'https://pangom.net/impressum'; //⚠ If an external source is used for the legal notice, the URL for that source must be entered here. Please note that for this option to take effect, `useremotesource` must also be set to `true`.

$pro_imprint_text= 'imprint.txt'; // ⚠ contains the path to the text file where your imprint must be inserted as plain text; the player then links to a page containing legal information where the imprint stored there is displayed. However, to do this, `useremotesource` must be set to `false`.

$pro_privacy_useremotesopurce = true; // Specifies whether the privacy policy is linked to a source outside the player. True = The privacy policy is located in a source other than the PanPlay instance (for example, in a WordPress blog) to which a link is provided. False = The privacy policy is contained in a text file within the player data and is displayed in a dedicated player-controlled interface.

$pro_privacy_link   = 'https://pangom.net/datenschutz'; //⚠ If an external source is used for the privacy policy, the URL for that source must be entered here. Please note that for this option to take effect, `useremotesource` must also be set to `true`.

$pro_privacy_text= 'privacy.txt'; // ⚠ contains the path to the text file where the raw text of your privacy policy must be inserted; the player then links to a page containing legal information where the privacy policy stored there is displayed. However, to do this, `useremotesource` must be set to `false`.

// --- Legacy Runtime Aliases ---
// Keep old runtime variable names alive while the player is migrated to storage.php.
$copyowner = $pro_eula_vendor;
$copyowner_url = $pro_eula_vendor_link;
$copyowner_mail = 'inbox@pangom.net';
$copyowner_webmaster_url = $pro_eula_vendor_link;
$copyowner_webmaster_mail = 'inbox@pangom.net';

$privacy_url_external = $pro_privacy_useremotesopurce;
$privacy_url = $pro_privacy_useremotesopurce ? $pro_privacy_link : 'engine/legal/index.php?doc=privacy';
$impress_url_external = $pro_imprint_useremotesopurce;
$impress_url = $pro_imprint_useremotesopurce ? $pro_imprint_link : 'engine/legal/index.php?doc=imprint';

// bluescreen-Page-Paths
$blus_header_path = 'engine/error/pages/bluescreen-head.html';
$blus_footer_path = 'engine/error/pages/bluescreen-bottom.html';


// --- Global Behavior Flags ---
$cfg_default_lang   = 'en-US';           // Server default language. PanPlay features automatic language detection and, if available, uses the language of the visitor’s browser or device. However, if that language is not available, the server’s default language is displayed. You can set this value here. Please note that the format of the language you select must comply with ISO 639-1 (https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes) and that the language must be supported by PanPlay or your copy of PanPlay.
$cfg_auto_lang_override   = false ; // If set to true, the player will not use automatic browser language detection; instead, the player will operate in a fixed mode that displays only the default language. There is no logical reason for this setting other than if you want your player to support only the selected language, or if you are using the setting for debugging purposes to create and test language files for Panplay.

$cfg_compat_check   = true;           // Is browser compatibility check enabled? The browser.pangom.net compatibility check is being used.

$cfg_panplay_cpm    = true;          // Use PanPlay CPM? This activates the Content Protection Mechanism (CPM) for baseaudio URLs. CPM checks local and optional CDN filter lists before playback.

$cfg_panplay_cpm_by_cdn    = true;          // Use the central PanPlay CPM filter list from https://play.pangom.net/cpm/? The list is downloaded, cached locally, and checked locally. Playback URLs are not sent to Pangom/PanPlay during normal CPM checks.

$cfg_debug_mode     = false;          // Enable PHP debug output in the player runtime. If true, PanPlay sets error_reporting(E_ALL), display_errors=1, and display_startup_errors=1 early during initialization. If false, direct PHP error output is hidden from the player interface.

$about_show_documentation_link = true; // provide a link to PanPlay's documentation page in the player About dialog.
$about_extension_link = true; // provide a link to the documentation or website of the active extension in the player About dialog.
$enable_extension_credits = true; // show the active extension credit line in the player About dialog.

$useonlyhtttps = true; //🥚 If set to true, PanPlay will attempt at the PHP level to establish all connections to the user and other servers via HTTPS or similar secure connections. This setting is not the correct way to enforce HTTPS; this should be done at the server level. This is merely a minor workaround.



////////////////////////////////////// §§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§
// 
//  --- DO NOT CHANGE! FROM HERE ON: It is prohibited to modify the following strings, as they implement the “Attribution” requirement and linking provisions of the MIT License under which PanPlay is distributed. Deleting or modifying them constitutes a violation of the terms of the MIT License.

// --- Legal Documents ---
$pp_pro_engine_name    = 'PanPlay';
$pp_pro_copyright      = '2026';
$pp_pro_license        = 'MIT-License';
$pp_pro_license_url    = 'https://www.tldrlegal.com/license/mit-license';
$pp_pro_company        = 'Pangom.net';
$pp_pro_company_url    = 'https://pangom.net/';
$pp_pro_attribution_hash = '129b432ba2e167dc305e6edd84a1baa68e0415f01627e1f4d219474a831cc792';

?>
