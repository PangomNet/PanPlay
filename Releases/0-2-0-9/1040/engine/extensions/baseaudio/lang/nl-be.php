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
    'lng_title' => 'Nederlands  (België)',
    'extension_title' => 'Baseaudio-uitbreiding voor PanPlay',
    'extension_credits' => 'Baseaudio-uitbreiding voor PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' Over de audiobron',
    'playwith_navbar_title' => 'Speler wisselen',

    // Audio source information
    'stationinfo_modal_title' => 'Informatie over de audiobron',
    'stationinfo_modal_topdesc' => 'Voor deze audiobron zijn momenteel geen aanvullende metadata beschikbaar.',

    // Bestandsmetadata
    'metadata_file_details' => 'Details van het audiobestand',
    'metadata_title_label' => 'Titel',
    'metadata_artist_label' => 'Artiest',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genre',
    'metadata_year_label' => 'Jaar',
    'metadata_duration_label' => 'Duur',
    'metadata_format_label' => 'Formaat en codec',
    'metadata_bitrate_label' => 'Bitsnelheid',
    'metadata_sample_rate_label' => 'Bemonsteringsfrequentie',
    'metadata_channels_label' => 'Kanalen',
    'metadata_filesize_label' => 'Bestandsgrootte',
    'metadata_source_label' => 'Audiobron',
    'metadata_tags_unavailable' => 'PanPlay kon geen aanvullende tags uit deze bron lezen. Afspelen blijft beschikbaar met de informatie uit de URL.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Speler wisselen',
    'playwith_modal_topdesc' => 'Je kunt deze audiobron openen in een andere toepassing of op een extern afspeelapparaat.',
    'playwith_modal_gcast_topdesc1' => 'Cast “',
    'playwith_modal_gcast_topdesc2' => '” naar een Google Cast-apparaat met de Cast-knop in de speler.',
    'directstreamtobrowserdropdown' => 'Audiobron openen',

    // Content Protection Mechanism
    'cpm_info_title' => 'Mechanisme voor inhoudsbescherming (CPM)',
    'cpm_info_description' => 'PanPlay CPM controleert de gevraagde baseaudio-URL aan de hand van lokale en optionele centrale filterregels.',
    'cpm_info_scope' => 'Alleen baseaudio wordt gecontroleerd. Geblokkeerde inhoud wordt gestopt voordat de playerinterface wordt geladen en uitgelegd op een foutscherm.',
    'cpm_info_local_status' => 'Lokale CPM',
    'cpm_info_local_list' => 'Lokale filterlijst',
    'cpm_info_cdn_status' => 'CPM via CDN',
    'cpm_info_cache_status' => 'Cache van de centrale lijst',
    'cpm_info_enabled' => 'Ingeschakeld',
    'cpm_info_disabled' => 'Uitgeschakeld',
    'cpm_info_available' => 'Beschikbaar',
    'cpm_info_unavailable' => 'Niet beschikbaar',
    'cpm_info_last_sync' => 'Laatste synchronisatie',
    'cpm_info_read_only' => 'Deze informatie is alleen-lezen. Serverbeheerders beheren de CPM-instellingen en filterlijsten.',
    'cpm_info_more_information' => 'Meer informatie over PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Afspeelfout',
    'neterr_desc_net_thinking' => 'Audiobron controleren…',
    'neterr_desc_net_okay1' => '<b>Verbinding hersteld</b><hr>De audiobron is weer bereikbaar. Herlaad de speler als het afspelen niet automatisch doorgaat.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'De audiobron is weer bereikbaar.',
    'neterr_desc_net_not_okay1' => '<b>Audiobron niet beschikbaar</b><hr>De gevraagde audiobron kon niet worden bereikt. Controleer de internetverbinding en herlaad de speler na een netwerkwijziging.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Fout bij het controleren van de audiobron: ',
);

?>
