<?php
/**
 * PanPlay - Ultimate Debug Inspector & Technical Wiki
 * Version 3.0: Granular Variable Documentation & White-Label Guide
 */

// Enable error reporting for the debug session
error_reporting(E_ALL);
ini_set('display_errors', 1);

$configFile = __DIR__ . '/data/storage.php';

if (!file_exists($configFile)) {
    die("<b style='color:red;'>Error:</b> The file storage.php was not found at $configFile.");
}

// Include the configuration
require_once $configFile;

// Function to clean and format values for the table
function formatValue($val) {
    if (is_bool($val)) {
        return $val ? '<span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold tracking-tighter">TRUE</span>' 
                    : '<span class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-bold tracking-tighter">FALSE</span>';
    }
    if (empty($val) && $val !== '0' && $val !== 0) {
        return '<i class="text-gray-400 text-xs">(empty)</i>';
    }
    return '<span class="break-all">' . htmlspecialchars((string)$val) . '</span>';
}

// Get all defined variables
$vars = get_defined_vars();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PanPlay Wiki & Inspector</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        @font-face {
            font-family: 'Rondalo';
            src: url('https://cdn.pangom.net/font/rondalo.woff') format('woff');
        }
        .pangomfont { font-family: 'Rondalo', sans-serif; font-weight: bold; }
        .wiki-section { border-bottom: 1px solid #e5e7eb; padding-bottom: 2rem; margin-bottom: 2rem; }
        .wiki-section:last-child { border-bottom: none; }
        .var-doc { margin-bottom: 1.5rem; }
        .var-name { font-family: monospace; font-weight: bold; color: #2563eb; background: #eff6ff; padding: 2px 6px; border-radius: 4px; font-size: 0.9rem; }
        .ui-tag { font-size: 0.7rem; font-weight: bold; color: #9333ea; background: #f5f3ff; padding: 2px 6px; border-radius: 9999px; margin-left: 8px; vertical-align: middle; border: 1px solid #ddd6fe; }
        .wiki-card h3 { color: #111827; font-weight: 800; font-size: 1.25rem; margin-bottom: 1rem; display: flex; align-items: center; }
        .wiki-card p { color: #4b5563; line-height: 1.6; margin-bottom: 0.5rem; font-size: 0.95rem; }
        .white-label-note { border-left: 4px solid #f59e0b; background: #fffbeb; padding: 1rem; border-radius: 0 12px 12px 0; margin: 1rem 0; }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-10">

    <div class="max-w-7xl mx-auto space-y-10">
        
        <div class="bg-blue-900 p-10 text-white rounded-3xl shadow-2xl flex flex-col lg:flex-row justify-between items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl font-black pangomfont tracking-tighter">PanPlay Status</h1>
                <p class="text-blue-300 mt-2 font-medium">Core Configuration & White-Label Documentation Example</p>
            </div>
            <div class="mt-8 lg:mt-0 flex flex-col items-center lg:items-end">
                <span class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-1">Current Version</span>
                <span class="text-2xl font-mono font-bold bg-blue-800 px-4 py-1 rounded-xl"><?php echo $pro_version; ?></span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-8 bg-white shadow-2xl rounded-3xl p-8 md:p-12 border border-gray-100 wiki-card">
                
                <div class="wiki-section">
                    <h3>1. Branding & Identity (The "Klaus" Scenario)</h3>
                    <p>When you host your own instance (e.g., <strong>Klaus Awesome Player</strong>), these variables define your product's name and build status.</p>
                    
                    <div class="var-doc">
                        <span class="var-name">$pro_name</span><span class="ui-tag">ABOUT BOX HEADER</span>
                        <p>The visual branding of your instance. Supports HTML/Icons. Klaus would change this to "Klaus Awesome Player".</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pro_version_name</span><span class="ui-tag">ABOUT BOX SUBTITLE</span>
                        <p>The codename of your build (e.g., <i>Dandelion</i>). Appears in italics below the title in the About Box.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pro_version</span> / <span class="var-name">$pro_buildversion</span>
                        <p>The technical versioning. While these often follow the PanPlay core, a white-label hoster can define their own milestones here.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$is_prerelase</span><span class="ui-tag">ALERT BOX</span>
                        <p>A binary switch. If <code>true</code>, the red <strong>"Unstable Prerelease"</strong> alert appears in the About Box UI, warning users not to use this build in production.</p>
                    </div>
                </div>

                <div class="wiki-section">
                    <h3>2. Vendor & Legal Responsibility</h3>
                    <div class="white-label-note font-medium text-amber-900">
                        <strong>IMPORTANT:</strong> The "PanPlay CDN" data in <code>storage.php</code> is just an example. As a hoster, you are legally responsible for your own instance.
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pro_eula_vendor</span><span class="ui-tag">LICENSE LINE</span>
                        <p>The legal owner of the instance. Klaus would enter "Klaus Media Group". This renders the text <i>"Licensed to [Klaus Media Group]"</i> in the UI.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pro_imprint_link</span> / <span class="var-name">$pro_privacy_link</span>
                        <p>Mandatory URLs for the Imprint and Privacy Policy. Klaus <strong>must</strong> link to his own legal pages here to comply with GDPR/DSGVO.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pro_imprint_useremotesource</span>
                        <p>If <code>true</code>, the player links to the external URL provided. If <code>false</code>, it attempts to load a local text file.</p>
                    </div>
                </div>

                <div class="wiki-section">
                    <h3>3. Global Behavior Flags</h3>
                    <div class="var-doc">
                        <span class="var-name">$cfg_compat_check</span>
                        <p>Enables the <code>browser.pangom.net</code> check. Redirects clients using browsers older than 2021 (e.g., Chrome < 86) to the compatibility error page.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$cfg_panplay_cpm</span>
                        <p>Content Protection Mechanism. Prevents playback of copyright-infringed URLs. If <code>_by_cdn</code> is active, URLs are checked against Pangom's central cloud list.</p>
                    </div>
                </div>

                <div class="wiki-section">
                    <h3>4. Mandatory MIT Attribution</h3>
                    <p>These variables ensure legal compliance with the MIT License. Even in a White-Label scenario, these <strong>must remain intact</strong> to credit the engine creator.</p>
                    
                    <div class="var-doc">
                        <span class="var-name">$pp_pro_engine_name</span> / <span class="var-name">$pp_pro_attribution_hash</span>
                        <p>The About Box attribution is assembled from the protected core values. The hash validates that these values were not changed accidentally.</p>
                    </div>

                    <div class="var-doc">
                        <span class="var-name">$pp_pro_company</span> / <span class="var-name">$pp_pro_company_url</span>
                        <p>Identifies <strong>Pangom.net</strong> as the software developer, independent of who is currently hosting the instance.</p>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-4 space-y-8">
                
                <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100">
                    <div class="p-6 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Live Inspector</h2>
                        <span class="animate-pulse w-2 h-2 bg-green-500 rounded-full"></span>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <?php 
                        foreach ($vars as $name => $value): 
                            if (preg_match('/^(pro_|cfg_|about_|is_|pp_|useonly)/', $name)):
                        ?>
                        <div class="p-4 hover:bg-blue-50 transition-colors">
                            <div class="text-xs font-mono text-blue-600 font-bold mb-1">$<?php echo $name; ?></div>
                            <div class="text-sm text-gray-800 font-medium">
                                <?php 
                                    if ($name === 'pro_name') echo $value; 
                                    else echo formatValue($value); 
                                ?>
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-600 to-blue-700 p-8 text-white rounded-3xl shadow-xl">
                    <h4 class="font-bold mb-4 border-b border-white border-opacity-20 pb-2">UI Render Logic</h4>
                    <ul class="text-sm space-y-3 opacity-90">
                        <li>🎨 <b>Title:</b> $pro_name</li>
                        <li>📅 <b>Date:</b> $pro_releasedate</li>
                        <li>🛠️ <b>Build:</b> $pro_buildversion</li>
                        <li>🏢 <b>Hoster:</b> $pro_eula_vendor</li>
                        <li>🔗 <b>Legal:</b> $pro_imprint_link</li>
                    </ul>
                </div>

            </div>

        </div>

        <div class="text-center text-gray-400 text-xs pb-10">
            PanPlay Diagnostic Suite • <a href="https://pangom.net" class="hover:text-blue-600 underline">Pangom.net</a> • Documentation & Code © 2026
        </div>
    </div>

</body>
</html>
