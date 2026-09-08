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
    'lng_title' => 'Dansk',
    'extension_title' => 'Baseaudio-udvidelse til PanPlay',
    'extension_credits' => 'Baseaudio-udvidelse til PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' Om lydkilden',
    'playwith_navbar_title' => 'Skift afspiller',

    // Audio source information
    'stationinfo_modal_title' => 'Oplysninger om lydkilden',
    'stationinfo_modal_topdesc' => 'Der er endnu ingen yderligere metadata tilgængelige for denne lydkilde.',

    // Filmetadata
    'metadata_file_details' => 'Oplysninger om lydfilen',
    'metadata_title_label' => 'Titel',
    'metadata_artist_label' => 'Kunstner',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genre',
    'metadata_year_label' => 'År',
    'metadata_duration_label' => 'Varighed',
    'metadata_format_label' => 'Format og codec',
    'metadata_bitrate_label' => 'Bithastighed',
    'metadata_sample_rate_label' => 'Samplingsfrekvens',
    'metadata_channels_label' => 'Kanaler',
    'metadata_filesize_label' => 'Filstørrelse',
    'metadata_source_label' => 'Lydkilde',
    'metadata_tags_unavailable' => 'PanPlay kunne ikke læse yderligere tags fra denne kilde. Afspilning er fortsat mulig med oplysningerne fra URL’en.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Skift afspiller',
    'playwith_modal_topdesc' => 'Du kan åbne denne lydkilde i en anden app eller på en ekstern afspilningsenhed.',
    'playwith_modal_gcast_topdesc1' => 'Cast “',
    'playwith_modal_gcast_topdesc2' => '” til en Google Cast-enhed med Cast-knappen i afspilleren.',
    'directstreamtobrowserdropdown' => 'Åbn lydkilde',

    // Content Protection Mechanism
    'cpm_info_title' => 'Mekanisme til indholdsbeskyttelse (CPM)',
    'cpm_info_description' => 'PanPlay CPM kontrollerer den ønskede baseaudio-URL mod lokale og valgfri centrale filterregler.',
    'cpm_info_scope' => 'Kun baseaudio kontrolleres. Blokeret indhold stoppes, før playerens brugerflade indlæses, og forklares på en fejlskærm.',
    'cpm_info_local_status' => 'Lokal CPM',
    'cpm_info_local_list' => 'Lokal filterliste',
    'cpm_info_cdn_status' => 'CPM via CDN',
    'cpm_info_cache_status' => 'Cache for central liste',
    'cpm_info_enabled' => 'Aktiveret',
    'cpm_info_disabled' => 'Deaktiveret',
    'cpm_info_available' => 'Tilgængelig',
    'cpm_info_unavailable' => 'Ikke tilgængelig',
    'cpm_info_last_sync' => 'Seneste synkronisering',
    'cpm_info_read_only' => 'Disse oplysninger er skrivebeskyttede. Serveroperatører administrerer CPM-indstillinger og filterlister.',
    'cpm_info_more_information' => 'Flere oplysninger om PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Afspilningsfejl',
    'neterr_desc_net_thinking' => 'Kontrollerer lydkilden…',
    'neterr_desc_net_okay1' => '<b>Forbindelsen er genoprettet</b><hr>Lydkilden kan nås igen. Genindlæs afspilleren, hvis afspilningen ikke fortsætter automatisk.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'Lydkilden kan nås igen.',
    'neterr_desc_net_not_okay1' => '<b>Lydkilden er ikke tilgængelig</b><hr>Den ønskede lydkilde kunne ikke nås. Kontrollér internetforbindelsen, og genindlæs afspilleren efter et netværksskift.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Fejl under kontrol af lydkilden: ',

    //PWF app shell (0.3.0.0 Fieldrush) -- added by Claude Code, see AI-HANDOFF.md
    'metadata_codec_label' => 'Codec',
    'settings_source_legend' => 'Lydkilde',
    'direct_audio_url_label' => 'Direkte lyd-URL',
    'settings_cpm_managed_note' => 'Denne indstilling administreres af serveroperatoren.',
    'settings_cpm_cdn_suffix' => ', central liste aktiv',
    'cover_alt_prefix' => 'Cover til',
);

?>
