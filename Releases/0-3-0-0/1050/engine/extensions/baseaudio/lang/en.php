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
    'lng_title' => 'English',
    'extension_title' => 'Baseaudio extension for PanPlay',
    'extension_credits' => 'Baseaudio extension for PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' About audio source',
    'playwith_navbar_title' => 'Switch player',

    // Audio source information
    'stationinfo_modal_title' => 'Audio source information',
    'stationinfo_modal_topdesc' => 'No additional metadata is available for this audio source yet.',

    // File metadata
    'metadata_file_details' => 'Audio file details',
    'metadata_title_label' => 'Title',
    'metadata_artist_label' => 'Artist',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genre',
    'metadata_year_label' => 'Year',
    'metadata_duration_label' => 'Duration',
    'metadata_format_label' => 'Format and codec',
    'metadata_bitrate_label' => 'Bitrate',
    'metadata_sample_rate_label' => 'Sample rate',
    'metadata_channels_label' => 'Channels',
    'metadata_filesize_label' => 'File size',
    'metadata_source_label' => 'Audio source',
    'metadata_tags_unavailable' => 'PanPlay could not read additional tags from this source. Playback remains available with the information from the URL.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Switch player',
    'playwith_modal_topdesc' => 'You can open this audio source in another application or on an external playback device.',
    'playwith_modal_gcast_topdesc1' => 'Cast “',
    'playwith_modal_gcast_topdesc2' => '” to a Google Cast device using the Cast button in the player.',
    'directstreamtobrowserdropdown' => 'Open audio source',

    // Content Protection Mechanism
    'cpm_info_title' => 'Content Protection Mechanism (CPM)',
    'cpm_info_description' => 'PanPlay CPM checks the requested baseaudio URL against local and optional central filter rules.',
    'cpm_info_scope' => 'Only baseaudio is checked. Blocked content is stopped before the player interface loads and is explained on a Bluescreen.',
    'cpm_info_local_status' => 'Local CPM',
    'cpm_info_local_list' => 'Local filter list',
    'cpm_info_cdn_status' => 'CPM by CDN',
    'cpm_info_cache_status' => 'Central list cache',
    'cpm_info_enabled' => 'Enabled',
    'cpm_info_disabled' => 'Disabled',
    'cpm_info_available' => 'Available',
    'cpm_info_unavailable' => 'Not available',
    'cpm_info_last_sync' => 'Last synchronization',
    'cpm_info_read_only' => 'This information is read-only. Server operators maintain CPM settings and filter lists.',
    'cpm_info_more_information' => 'More information about PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Playback error',
    'neterr_desc_net_thinking' => 'Checking the audio source…',
    'neterr_desc_net_okay1' => '<b>Connection restored</b><hr>The audio source is reachable again. If playback does not continue automatically, reload the player.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'Audio source is reachable again.',
    'neterr_desc_net_not_okay1' => '<b>Audio source unavailable</b><hr>The requested audio source could not be reached. Check your internet connection and reload the player after a network change.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Error while checking the audio source: ',

    //PWF app shell (0.3.0.0 Fieldrush)
    'metadata_codec_label' => 'Codec',
    'settings_source_legend' => 'Audio source',
    'direct_audio_url_label' => 'Direct audio URL',
    'settings_cpm_managed_note' => 'This setting is managed by the server operator.',
    'settings_cpm_cdn_suffix' => ', central list active',
    'cover_alt_prefix' => 'Cover for',
);

?>
