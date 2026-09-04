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
    'lng_title' => 'Italiano',
    'extension_title' => 'Estensione Baseaudio per PanPlay',
    'extension_credits' => 'Estensione Baseaudio per PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' Informazioni sulla sorgente audio',
    'playwith_navbar_title' => 'Cambia giocatore',

    // Audio source information
    'stationinfo_modal_title' => 'Informazioni sulla sorgente audio',
    'stationinfo_modal_topdesc' => 'Al momento non sono disponibili altri metadati per questa sorgente audio.',

    // Metadati del file
    'metadata_file_details' => 'Dettagli del file audio',
    'metadata_title_label' => 'Titolo',
    'metadata_artist_label' => 'Artista',
    'metadata_album_label' => 'Album',
    'metadata_genre_label' => 'Genere',
    'metadata_year_label' => 'Anno',
    'metadata_duration_label' => 'Durata',
    'metadata_format_label' => 'Formato e codec',
    'metadata_bitrate_label' => 'Bitrate',
    'metadata_sample_rate_label' => 'Frequenza di campionamento',
    'metadata_channels_label' => 'Canali',
    'metadata_filesize_label' => 'Dimensione del file',
    'metadata_source_label' => 'Sorgente audio',
    'metadata_tags_unavailable' => 'PanPlay non ha potuto leggere altri tag da questa sorgente. La riproduzione resta disponibile con le informazioni ricavate dall’URL.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Cambia lettore',
    'playwith_modal_topdesc' => 'Puoi aprire questa sorgente audio in un’altra applicazione o su un dispositivo di riproduzione esterno.',
    'playwith_modal_gcast_topdesc1' => 'Trasmetti «',
    'playwith_modal_gcast_topdesc2' => '» a un dispositivo Google Cast usando il pulsante Cast del lettore.',
    'directstreamtobrowserdropdown' => 'Apri sorgente audio',

    // Content Protection Mechanism
    'cpm_info_title' => 'Meccanismo di protezione dei contenuti (CPM)',
    'cpm_info_description' => 'PanPlay CPM controlla l’URL baseaudio richiesta usando regole di filtro locali e, facoltativamente, centrali.',
    'cpm_info_scope' => 'Viene controllato solo baseaudio. I contenuti bloccati vengono fermati prima del caricamento dell’interfaccia del player e spiegati in una schermata di errore.',
    'cpm_info_local_status' => 'CPM locale',
    'cpm_info_local_list' => 'Elenco filtri locale',
    'cpm_info_cdn_status' => 'CPM tramite CDN',
    'cpm_info_cache_status' => 'Cache dell’elenco centrale',
    'cpm_info_enabled' => 'Attivo',
    'cpm_info_disabled' => 'Disattivato',
    'cpm_info_available' => 'Disponibile',
    'cpm_info_unavailable' => 'Non disponibile',
    'cpm_info_last_sync' => 'Ultima sincronizzazione',
    'cpm_info_read_only' => 'Queste informazioni sono di sola lettura. Gli operatori del server gestiscono le impostazioni CPM e gli elenchi di filtri.',
    'cpm_info_more_information' => 'Ulteriori informazioni su PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Errore di riproduzione',
    'neterr_desc_net_thinking' => 'Verifica della sorgente audio…',
    'neterr_desc_net_okay1' => '<b>Connessione ripristinata</b><hr>La sorgente audio è nuovamente raggiungibile. Se la riproduzione non continua automaticamente, ricarica il lettore.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'La sorgente audio è nuovamente raggiungibile.',
    'neterr_desc_net_not_okay1' => '<b>Sorgente audio non disponibile</b><hr>Non è stato possibile raggiungere la sorgente audio richiesta. Controlla la connessione Internet e ricarica il lettore dopo un cambio di rete.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Errore durante la verifica della sorgente audio: ',
);

?>
