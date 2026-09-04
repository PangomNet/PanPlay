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
$lang = array(
//basic
    'lng_title' => 'Español (AR)',
    'welcome' => '¡Bienvenido a nuestro sitio web!',
    'page_title' => 'PanPlay',
    'select_language' => 'Seleccionar idioma:',
    'remember_language' => 'Recordar este idioma',
    'apply' => 'Aplicar',
    'current_language' => '<span class="badge bg-danger">ES</span> Español',

    //basic-words
    'from' => 'de',
    'from_who' => 'por',
    'about' => 'Acerca de',
    'close' => 'Cerrar',
    'reload_player' => 'Recargar reproductor',
    'uhr' => 'h',
    
    //centralerrorlog
    'centralerrorlog_error_occured' => 'Mensaje de error de ejemplo al cargar la página.',
    'centralerrorlog_neterror_occured' => 'Error de red al cargar ',
    'centralerrorlog_modal_title' => 'Consola de errores',
    'centralerrorlog_modal_desc' => 'Si tienes acceso a esta ventana, significa que han ocurrido errores críticos (probablemente errores de conexión). Estos errores podrían afectar el funcionamiento de "PanPlay" de forma leve o significativa, e incluso provocar un bloqueo. Por favor, presta atención. Si estás familiarizado con las herramientas de desarrollo de tu dispositivo, te recomendamos buscar errores adicionales allí. Es posible que los errores sean solucionables.',
    'centralerrorlog_occuring_modal_title' => 'Consola de errores',
    'centralerrorlog_occuring_modal_desc1' => '¡Han ocurrido errores! Puede haber una pérdida de conexión. Por favor, verifica la',
    'centralerrorlog_occuring_modal_desc2' => 'Consola de errores',

    //settingspanel PanPlay
    'settingspanel_modal_title' => 'Configuraciones',
    'settingspanel_lang_title' => 'Idioma',
    'settingspanel_lang_desc' => 'Selecciona un idioma diferente para la interfaz de usuario.',
    'settingspanel_lang_ext_desc' => 'Las extensiones pueden funcionar sin o con sus propios archivos de idioma y es posible que no funcionen en todos los idiomas.',
    'settingspanel_theme_title' => 'Tema',
    'settingspanel_theme_desc' => 'Elige un tema visual para esta URL del reproductor. Esto solo cambia el parametro URL generado y no modifica la configuracion del servidor.',
    'settingspanel_extension_title' => 'Configuracion de la extension',
    'settingspanel_baseaudio_desc' => 'Cambia la URL de audio directa usada por baseaudio. Al aplicar, el reproductor se recarga con un nuevo parametro webstream.',
    'settingspanel_laut_desc' => 'Cambia las opciones de visualizacion de laut.fm para esta URL del reproductor. Al aplicar un ajuste, el reproductor se recarga con el parametro URL correspondiente.',
    'settingspanel_on' => 'Activado',
    'settingspanel_off' => 'Desactivado',
    'settingspanel_laut_feature_windows' => 'Ventanas de funciones laut.fm',
    'settingspanel_laut_use_selected' => 'Usar opciones seleccionadas',
    'settingspanel_laut_hide_all' => 'Ocultar todo',
    'settingspanel_laut_default_windows' => 'Predeterminado: mostrar todas las ventanas',
    'settingspanel_laut_playback_behavior' => 'Comportamiento de reproduccion',
    'settingspanel_laut_schedule' => 'Programacion',
    'settingspanel_laut_currentsongmodal' => 'Ventana de cancion actual',
    'settingspanel_laut_lbn' => 'En vivo por nombre',
    'settingspanel_laut_trackhistory' => 'Historial de pistas',
    'settingspanel_laut_playwith' => 'Cambiar reproductor',
    'settingspanel_laut_global_override_note' => 'Todas las ventanas de funciones de laut.fm estan desactivadas actualmente por el interruptor global nolfmw. Los ajustes individuales de ventana se ignoran hasta que este interruptor vuelva a cambiarse.',
    'settingspanel_laut_stationinfo' => 'Informacion de la emisora',

    //about PanPlay
    'about_modal_title' => 'PanPlay',
    'about_brand_phrase' => '<b><u>El</u></b> reproductor de audio HTML5!',
    'about_license_owner_is' => 'Licenciado a',
    'about_license_datewording' => 'en la versión del',
    'about_prerelease_warning_title' => 'Versión preliminar inestable',
    'about_prerelease_warning_p1' => 'Esta versión de',
    'about_prerelease_warning_p2' => 'es una versión preliminar destinada exclusivamente a seguir el progreso del desarrollo. No se recomienda su uso en producción.',
    'about_documentation_p1' => 'Para obtener más información, consulta la',
    'about_documentation_p2' => 'documentación',
    'about_documentation_p3' => '.',
    'about_legal_p1' => 'Se aplican los',
    'about_legal_p2' => 'privacidad',
    'about_legal_p3' => 'y el ',
    'about_legal_p4' => 'Aviso legal',
    'about_legal_p5' => '. También se aplican los',
    'about_legal_p6' => 'Términos de uso',
    'about_legal_p7' => 'que puedes ',
    'about_legal_p8' => 'encontrar aquí',
    'about_legal_p9' => '.',
    'bluescreen_heading' => '%s provoco un error del servidor',
    'bluescreen_exception_label' => 'Excepcion del servidor',
    'bluescreen_explanation_label' => 'Explicacion',
    'bluescreen_operator_hint' => 'Vuelva a la pagina anterior. Si el problema persiste, informe al operador del servidor (%s).',
    'cpm_block_headline' => 'Contenido bloqueado por PanPlay CPM',
    'cpm_block_desc' => 'La URL baseaudio solicitada esta bloqueada por la politica de esta instancia de PanPlay.',
    'cpm_block_source' => 'Lista de reglas coincidente',
    'cpm_block_rule' => 'Regla coincidente',
    'cpm_more_info' => 'Mas informacion sobre esta politica de contenido',
    'compat_meta_title' => 'Error: contenido no compatible - PanPlay',
    'compat_headline' => 'Contenido no compatible!',
    'compat_sub_headline' => 'El contenido solicitado no es compatible con su dispositivo o software.',
    'compat_desc_1' => 'Este sitio web ofrece contenido a un publico amplio y tambien admite navegadores antiguos.',
    'compat_desc_2' => 'Sin embargo, su software actual esta clasificado como altamente incompatible e inseguro. Por eso no se entrego el contenido.',
    'compat_ts_title' => 'Informacion de solucion de problemas',
    'compat_ts_desc' => 'El sistema identifico los siguientes detalles tecnicos:',
    'compat_detected_browser' => 'Navegador detectado',
    'compat_user_agent' => 'Cadena completa de User-Agent',
    'compat_back' => 'Volver',
    'compat_recommended_action' => 'Accion recomendada',
    'compat_recommended_desc' => 'Utilice software de navegador moderno para acceder a esta instancia de PanPlay.',
    'compat_more_help' => 'Mas ayuda e informacion de contexto',
    'compat_detected_browser_link' => 'Abrir el sitio web del navegador detectado',
);
?>
