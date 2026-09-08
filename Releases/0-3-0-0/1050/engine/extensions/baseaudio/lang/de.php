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
    'lng_title' => 'Deutsch',
    'extension_title' => 'Baseaudio-Erweiterung für PanPlay',
    'extension_credits' => 'Baseaudio-Erweiterung für PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' Über Audioquelle',
    'playwith_navbar_title' => 'Player wechseln',

    // Audio source information
    'stationinfo_modal_title' => 'Informationen zur Audioquelle',
    'stationinfo_modal_topdesc' => 'Für diese Audioquelle sind derzeit keine weiteren Metadaten verfügbar.',

    // Dateimetadaten
    'metadata_file_details' => 'Details zur Audiodatei',
    'metadata_title_label' => 'Titel',
    'metadata_artist_label' => 'Interpret',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genre',
    'metadata_year_label' => 'Jahr',
    'metadata_duration_label' => 'Dauer',
    'metadata_format_label' => 'Format und Codec',
    'metadata_bitrate_label' => 'Bitrate',
    'metadata_sample_rate_label' => 'Abtastrate',
    'metadata_channels_label' => 'Kanäle',
    'metadata_filesize_label' => 'Dateigröße',
    'metadata_source_label' => 'Audioquelle',
    'metadata_tags_unavailable' => 'PanPlay konnte aus dieser Quelle keine zusätzlichen Tags lesen. Die Wiedergabe bleibt mit den Angaben aus der URL verfügbar.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Player wechseln',
    'playwith_modal_topdesc' => 'Du kannst diese Audioquelle in einer anderen Anwendung oder auf einem externen Wiedergabegerät öffnen.',
    'playwith_modal_gcast_topdesc1' => 'Übertrage „',
    'playwith_modal_gcast_topdesc2' => '“ mit der Cast-Schaltfläche im Player auf ein Google-Cast-Gerät.',
    'directstreamtobrowserdropdown' => 'Audioquelle öffnen',

    // Content Protection Mechanism
    'cpm_info_title' => 'Inhaltsschutzmechanismus (CPM)',
    'cpm_info_description' => 'PanPlay CPM prüft die angeforderte baseaudio-URL anhand lokaler und optionaler zentraler Filterregeln.',
    'cpm_info_scope' => 'Nur baseaudio wird geprüft. Blockierte Inhalte werden vor dem Laden der Player-Oberfläche gestoppt und auf einem Bluescreen erklärt.',
    'cpm_info_local_status' => 'Lokales CPM',
    'cpm_info_local_list' => 'Lokale Filterliste',
    'cpm_info_cdn_status' => 'CPM by CDN',
    'cpm_info_cache_status' => 'Zwischenspeicher der zentralen Liste',
    'cpm_info_enabled' => 'Aktiv',
    'cpm_info_disabled' => 'Deaktiviert',
    'cpm_info_available' => 'Verfügbar',
    'cpm_info_unavailable' => 'Nicht verfügbar',
    'cpm_info_last_sync' => 'Letzte Synchronisierung',
    'cpm_info_read_only' => 'Diese Informationen sind schreibgeschützt. CPM-Einstellungen und Filterlisten werden vom Serverbetreiber verwaltet.',
    'cpm_info_more_information' => 'Weitere Informationen zu PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Wiedergabefehler',
    'neterr_desc_net_thinking' => 'Audioquelle wird geprüft…',
    'neterr_desc_net_okay1' => '<b>Verbindung wiederhergestellt</b><hr>Die Audioquelle ist wieder erreichbar. Falls die Wiedergabe nicht automatisch fortgesetzt wird, lade den Player neu.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'Die Audioquelle ist wieder erreichbar.',
    'neterr_desc_net_not_okay1' => '<b>Audioquelle nicht erreichbar</b><hr>Die angeforderte Audioquelle konnte nicht erreicht werden. Prüfe deine Internetverbindung und lade den Player nach einem Netzwerkwechsel neu.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Fehler beim Prüfen der Audioquelle: ',

    //PWF app shell (0.3.0.0 Fieldrush)
    'metadata_codec_label' => 'Codec',
    'settings_source_legend' => 'Audioquelle',
    'direct_audio_url_label' => 'Direkte Audio-URL',
    'settings_cpm_managed_note' => 'Diese Einstellung wird vom Serverbetreiber verwaltet.',
    'settings_cpm_cdn_suffix' => ', zentrale Liste aktiv',
    'cover_alt_prefix' => 'Cover von',
);

?>
