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
$cpmSite = array(
    'meta_title' => 'Mecanismo de protección de contenido de PanPlay',
    'meta_description' => 'Información pública sobre PanPlay CPM, sus listas de filtros locales y centrales, la privacidad y las responsabilidades de los operadores.',
    'language_label' => 'Idioma',
    'language_apply' => 'Aplicar',
    'status_label' => 'Documentación pública',
    'title' => 'Mecanismo de protección de contenido de PanPlay',
    'lead' => 'Cómo PanPlay comprueba las URL de audio directas, usa reglas locales y centrales opcionales y protege la reproducción sin informar de las URL escuchadas.',
    'current_title' => 'Lista central disponible',
    'current_body' => 'La lista pública de filtros CPM puede ser utilizada por las instancias PanPlay participantes. Cada operador puede decidir si participa.',
    'what_title' => 'Qué es CPM',
    'what_body' => 'CPM es una capa de filtrado para la extensión Baseaudio de PanPlay. Puede bloquear antes de la reproducción URL de audio directas conocidas o prohibidas localmente. No es DRM ni una valoración jurídica de un sitio, usuario o archivo.',
    'geography_title' => 'Sin reglas geográficas',
    'why_title' => 'Por qué existe CPM',
    'why_body' => 'CPM ofrece a los operadores de instancias PanPlay una forma técnica de responder a avisos de titulares de derechos, solicitudes de retirada similares a las del DMCA y requisitos comparables de derechos de autor en la Unión Europea y otras jurisdicciones. No es un filtro de subida ni una campaña activa contra la piratería; filtra la reproducción y el procesamiento mediante PanPlay.',
    'effect_title' => 'Qué hace un bloqueo',
    'effect_body' => 'Una coincidencia no elimina ni incauta el archivo de origen y tampoco impide acceder a él por otros medios. PanPlay únicamente se niega a obtenerlo y reproducirlo mediante Baseaudio. La comprobación no envía advertencias ni informes al usuario, al titular de derechos, al proveedor de alojamiento, a las autoridades ni a terceros.',
    'geography_body' => 'La lista central no toma decisiones específicas por país. Si la jurisdicción o política de un operador requiere otras reglas, debe desactivar CPM by CDN y mantener una lista local adecuada.',
    'flow_title' => 'Cómo funciona una comprobación',
    'flow_1' => 'PanPlay recibe una URL de audio directa en el modo Baseaudio.',
    'flow_2' => 'La instancia normaliza la URL para que la comparación sea predecible.',
    'flow_3' => 'Las reglas locales se comprueban en el servidor PanPlay.',
    'flow_4' => 'Si está habilitada, también se comprueba la lista central almacenada localmente.',
    'flow_5' => 'Las excepciones prevalecen sobre los bloqueos. Una coincidencia restante detiene la reproducción y muestra un error 403 neutral.',
    'lists_title' => 'Reglas y fuentes',
    'local_title' => 'Reglas locales',
    'local_body' => 'Cada instancia autoalojada puede mantener sus propias reglas. Se aplican independientemente de la lista central y permanecen bajo el control del operador.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Las instancias participantes descargan y almacenan periódicamente la lista pública de PanPlay. Las comprobaciones siguen siendo locales y no usan un servicio de verificación de URL en directo.',
    'exceptions_title' => 'Excepciones',
    'exceptions_body' => 'Las reglas que comienzan por @@ permiten expresamente una dirección coincidente y tienen prioridad sobre los bloqueos. Sirven para corregir coincidencias demasiado amplias.',
    'rules_title' => 'Formato de la lista',
    'rules_intro' => 'CPM utiliza un subconjunto documentado similar a Adblock: comentarios, dominios, URL exactas, comodines sencillos, excepciones y directivas de importación de PanPlay.',
    'rule_comment' => 'Comentario',
    'privacy_title' => 'Privacidad',
    'privacy_body' => 'Con CPM by CDN, PanPlay descarga una lista y evalúa la URL solicitada en la instancia local. La URL escuchada no se envía a Pangom durante las comprobaciones normales.',
    'operator_title' => 'Responsabilidad del autoalojamiento',
    'operator_body' => 'El operador decide si CPM y CPM by CDN están activos y es responsable de las reglas locales, los documentos legales, los datos de contacto y el cumplimiento de la legislación local.',
    'complaints_title' => 'Correcciones y reclamaciones',
    'complaints_body' => 'Para un bloqueo local, contacte con el operador de la instancia correspondiente. Los avisos para la lista compartida pueden enviarse a PanPlay y se revisan manualmente antes de cambiar una regla central.',
    'contact_link' => 'Contactar con PanPlay',
    'limits_title' => 'Límites técnicos',
    'limits_body' => 'CPM solo se aplica a Baseaudio, no a la reproducción de laut.fm. No garantiza una prevención completa de la piratería, una aplicación geográfica ni el conocimiento de todas las fuentes prohibidas.',
    'resources_title' => 'Recursos públicos',
    'filterlist_link' => 'Abrir la lista central',
    'source_link' => 'Fuente antipiratería importada',
    'repository_link' => 'Código fuente de PanPlay',
    'footer_note' => 'CPM documenta las decisiones de filtrado; no sustituye la revisión jurídica por parte del operador de una instancia.',
);
