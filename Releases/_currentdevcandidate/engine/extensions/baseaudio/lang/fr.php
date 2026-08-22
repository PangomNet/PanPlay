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
    'lng_title' => 'Français',
    'extension_title' => 'Extension Baseaudio pour PanPlay',
    'extension_credits' => 'Extension Baseaudio pour PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' À propos de la source audio',
    'playwith_navbar_title' => 'Changer de lecteur',

    // Audio source information
    'stationinfo_modal_title' => 'Informations sur la source audio',
    'stationinfo_modal_topdesc' => 'Aucune métadonnée supplémentaire n’est actuellement disponible pour cette source audio.',

    // Métadonnées du fichier
    'metadata_file_details' => 'Détails du fichier audio',
    'metadata_title_label' => 'Titre',
    'metadata_artist_label' => 'Artiste',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genre',
    'metadata_year_label' => 'Année',
    'metadata_duration_label' => 'Durée',
    'metadata_format_label' => 'Format et codec',
    'metadata_bitrate_label' => 'Débit',
    'metadata_sample_rate_label' => 'Fréquence d’échantillonnage',
    'metadata_channels_label' => 'Canaux',
    'metadata_filesize_label' => 'Taille du fichier',
    'metadata_source_label' => 'Source audio',
    'metadata_tags_unavailable' => 'PanPlay n’a pas pu lire de balises supplémentaires dans cette source. La lecture reste disponible avec les informations provenant de l’URL.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Changer de lecteur',
    'playwith_modal_topdesc' => 'Vous pouvez ouvrir cette source audio dans une autre application ou sur un appareil de lecture externe.',
    'playwith_modal_gcast_topdesc1' => 'Diffusez «',
    'playwith_modal_gcast_topdesc2' => '» vers un appareil Google Cast avec le bouton Cast du lecteur.',
    'directstreamtobrowserdropdown' => 'Ouvrir la source audio',

    // Content Protection Mechanism
    'cpm_info_title' => 'Mécanisme de protection du contenu (CPM)',
    'cpm_info_description' => 'PanPlay CPM vérifie l’URL baseaudio demandée à l’aide de règles de filtrage locales et, en option, centrales.',
    'cpm_info_scope' => 'Seul baseaudio est vérifié. Le contenu bloqué est arrêté avant le chargement de l’interface du lecteur et expliqué sur un écran d’erreur.',
    'cpm_info_local_status' => 'CPM local',
    'cpm_info_local_list' => 'Liste de filtres locale',
    'cpm_info_cdn_status' => 'CPM par CDN',
    'cpm_info_cache_status' => 'Cache de la liste centrale',
    'cpm_info_enabled' => 'Activé',
    'cpm_info_disabled' => 'Désactivé',
    'cpm_info_available' => 'Disponible',
    'cpm_info_unavailable' => 'Indisponible',
    'cpm_info_last_sync' => 'Dernière synchronisation',
    'cpm_info_read_only' => 'Ces informations sont en lecture seule. Les opérateurs du serveur gèrent les paramètres CPM et les listes de filtres.',
    'cpm_info_more_information' => 'Plus d’informations sur PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Erreur de lecture',
    'neterr_desc_net_thinking' => 'Vérification de la source audio…',
    'neterr_desc_net_okay1' => '<b>Connexion rétablie</b><hr>La source audio est de nouveau accessible. Si la lecture ne reprend pas automatiquement, rechargez le lecteur.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'La source audio est de nouveau accessible.',
    'neterr_desc_net_not_okay1' => '<b>Source audio indisponible</b><hr>La source audio demandée n’a pas pu être atteinte. Vérifiez votre connexion Internet et rechargez le lecteur après un changement de réseau.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Erreur lors de la vérification de la source audio : ',
);

?>
