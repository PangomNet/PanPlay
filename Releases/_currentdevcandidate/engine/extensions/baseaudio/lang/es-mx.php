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
    'lng_title' => 'Español (MX)',
    'extension_title' => 'Extensión Baseaudio para PanPlay',
    'extension_credits' => 'Extensión Baseaudio para PanPlay',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' Acerca de la fuente de audio',
    'playwith_navbar_title' => 'Cambiar de reproductor',

    // Audio source information
    'stationinfo_modal_title' => 'Información de la fuente de audio',
    'stationinfo_modal_topdesc' => 'Actualmente no hay metadatos adicionales disponibles para esta fuente de audio.',

    // Metadatos del archivo
    'metadata_file_details' => 'Detalles del archivo de audio',
    'metadata_title_label' => 'Título',
    'metadata_artist_label' => 'Artista',
    'metadata_album_label' => 'Álbum',
    'metadata_genre_label' => 'Género',
    'metadata_year_label' => 'Año',
    'metadata_duration_label' => 'Duración',
    'metadata_format_label' => 'Formato y códec',
    'metadata_bitrate_label' => 'Tasa de bits',
    'metadata_sample_rate_label' => 'Frecuencia de muestreo',
    'metadata_channels_label' => 'Canales',
    'metadata_filesize_label' => 'Tamaño del archivo',
    'metadata_source_label' => 'Fuente de audio',
    'metadata_tags_unavailable' => 'PanPlay no pudo leer etiquetas adicionales de esta fuente. La reproducción sigue disponible con la información obtenida de la URL.',

    // External playback and Google Cast
    'playwith_modal_title' => 'Cambiar de reproductor',
    'playwith_modal_topdesc' => 'Puedes abrir esta fuente de audio en otra aplicación o en un dispositivo de reproducción externo.',
    'playwith_modal_gcast_topdesc1' => 'Transmitir «',
    'playwith_modal_gcast_topdesc2' => '» a un dispositivo Google Cast mediante el botón Cast del reproductor.',
    'directstreamtobrowserdropdown' => 'Abrir fuente de audio',

    // Content Protection Mechanism
    'cpm_info_title' => 'Mecanismo de protección de contenido (CPM)',
    'cpm_info_description' => 'PanPlay CPM comprueba la URL de baseaudio solicitada mediante reglas de filtrado locales y, opcionalmente, centrales.',
    'cpm_info_scope' => 'Solo se comprueba baseaudio. El contenido bloqueado se detiene antes de cargar la interfaz del reproductor y se explica en una pantalla de error.',
    'cpm_info_local_status' => 'CPM local',
    'cpm_info_local_list' => 'Lista de filtros local',
    'cpm_info_cdn_status' => 'CPM por CDN',
    'cpm_info_cache_status' => 'Caché de la lista central',
    'cpm_info_enabled' => 'Activado',
    'cpm_info_disabled' => 'Desactivado',
    'cpm_info_available' => 'Disponible',
    'cpm_info_unavailable' => 'No disponible',
    'cpm_info_last_sync' => 'Última sincronización',
    'cpm_info_read_only' => 'Esta información es de solo lectura. Los operadores del servidor administran la configuración de CPM y las listas de filtros.',
    'cpm_info_more_information' => 'Más información sobre PanPlay CPM',

    // Network and playback errors
    'neterr_modal_title' => 'Error de reproducción',
    'neterr_desc_net_thinking' => 'Comprobando la fuente de audio…',
    'neterr_desc_net_okay1' => '<b>Conexión restablecida</b><hr>La fuente de audio vuelve a estar disponible. Si la reproducción no continúa automáticamente, recarga el reproductor.',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => 'La fuente de audio vuelve a estar disponible.',
    'neterr_desc_net_not_okay1' => '<b>Fuente de audio no disponible</b><hr>No se pudo acceder a la fuente de audio solicitada. Comprueba tu conexión a Internet y recarga el reproductor después de un cambio de red.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Error al comprobar la fuente de audio: ',
);

?>
