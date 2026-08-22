<?php
/*
 * PanPlay language file
 *
 * ENCODING: UTF-8 only.
 * Read and save this file as UTF-8. Keep Unicode characters literal.
 * Do not replace them with escaped code points, HTML entities, or Latin-1.
 * After every edit, verify that the integrity line below is still readable.
 *
 * INTEGRITY CHECK: æøå | ñáéíóú | 你好世界 | नमस्ते | مرحبا | äöüß
 */
$ext_lang = array(
    // Basic
    'lng_title' => 'हिन्दी',
    'extension_title' => 'PanPlay के लिए Baseaudio एक्सटेंशन',
    'extension_credits' => 'PanPlay के लिए Baseaudio एक्सटेंशन',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' ऑडियो स्रोत के बारे में',
    'playwith_navbar_title' => 'प्लेयर बदलें',

    // Audio source information
    'stationinfo_modal_title' => 'ऑडियो स्रोत की जानकारी',
    'stationinfo_modal_topdesc' => 'इस ऑडियो स्रोत के लिए अभी कोई अतिरिक्त मेटाडेटा उपलब्ध नहीं है।',

    // फ़ाइल मेटाडेटा
    'metadata_file_details' => 'ऑडियो फ़ाइल का विवरण',
    'metadata_title_label' => 'शीर्षक',
    'metadata_artist_label' => 'कलाकार',
    'metadata_album_label' => 'एल्बम',
    'metadata_genre_label' => 'शैली',
    'metadata_year_label' => 'वर्ष',
    'metadata_duration_label' => 'अवधि',
    'metadata_format_label' => 'प्रारूप और कोडेक',
    'metadata_bitrate_label' => 'बिटरेट',
    'metadata_sample_rate_label' => 'सैंपल दर',
    'metadata_channels_label' => 'चैनल',
    'metadata_filesize_label' => 'फ़ाइल का आकार',
    'metadata_source_label' => 'ऑडियो स्रोत',
    'metadata_tags_unavailable' => 'PanPlay इस स्रोत से अतिरिक्त टैग नहीं पढ़ सका। URL से मिली जानकारी के साथ प्लेबैक उपलब्ध रहेगा।',

    // External playback and Google Cast
    'playwith_modal_title' => 'प्लेयर बदलें',
    'playwith_modal_topdesc' => 'आप इस ऑडियो स्रोत को किसी अन्य ऐप या बाहरी प्लेबैक डिवाइस पर खोल सकते हैं।',
    'playwith_modal_gcast_topdesc1' => '“',
    'playwith_modal_gcast_topdesc2' => '” को प्लेयर के Cast बटन से Google Cast डिवाइस पर चलाएँ।',
    'directstreamtobrowserdropdown' => 'ऑडियो स्रोत खोलें',

    // Content Protection Mechanism
    'cpm_info_title' => 'सामग्री सुरक्षा तंत्र (CPM)',
    'cpm_info_description' => 'PanPlay CPM अनुरोधित baseaudio URL को स्थानीय और वैकल्पिक केंद्रीय फ़िल्टर नियमों के आधार पर जाँचता है।',
    'cpm_info_scope' => 'केवल baseaudio की जाँच की जाती है। अवरुद्ध सामग्री को प्लेयर इंटरफ़ेस लोड होने से पहले रोक दिया जाता है और त्रुटि स्क्रीन पर समझाया जाता है।',
    'cpm_info_local_status' => 'स्थानीय CPM',
    'cpm_info_local_list' => 'स्थानीय फ़िल्टर सूची',
    'cpm_info_cdn_status' => 'CDN द्वारा CPM',
    'cpm_info_cache_status' => 'केंद्रीय सूची कैश',
    'cpm_info_enabled' => 'सक्रिय',
    'cpm_info_disabled' => 'निष्क्रिय',
    'cpm_info_available' => 'उपलब्ध',
    'cpm_info_unavailable' => 'उपलब्ध नहीं',
    'cpm_info_last_sync' => 'अंतिम सिंक्रनाइज़ेशन',
    'cpm_info_read_only' => 'यह जानकारी केवल पढ़ने के लिए है। सर्वर संचालक CPM सेटिंग्स और फ़िल्टर सूचियों का प्रबंधन करते हैं।',
    'cpm_info_more_information' => 'PanPlay CPM के बारे में अधिक जानकारी',

    // Network and playback errors
    'neterr_modal_title' => 'प्लेबैक त्रुटि',
    'neterr_desc_net_thinking' => 'ऑडियो स्रोत की जाँच हो रही है…',
    'neterr_desc_net_okay1' => '<b>कनेक्शन बहाल हो गया</b><hr>ऑडियो स्रोत फिर से उपलब्ध है। यदि प्लेबैक अपने आप जारी नहीं होता है, तो प्लेयर को फिर से लोड करें।',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'ऑडियो स्रोत फिर से उपलब्ध है।',
    'neterr_desc_net_not_okay1' => '<b>ऑडियो स्रोत उपलब्ध नहीं है</b><hr>अनुरोधित ऑडियो स्रोत तक नहीं पहुँचा जा सका। अपना इंटरनेट कनेक्शन जाँचें और नेटवर्क बदलने के बाद प्लेयर को फिर से लोड करें।',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'ऑडियो स्रोत की जाँच करते समय त्रुटि: ',
);

?>
