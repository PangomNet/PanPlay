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
    'lng_title' => 'Italiano',
    'welcome' => 'Benvenuto',
    'page_title' => 'Titolo della Pagina',
    'select_language' => 'Seleziona Lingua:',
    'remember_language' => 'Ricorda questa Lingua',
    'apply' => 'Applica',
    'current_language' => '<span class="badge bg-danger">IT</span> Italiano (Intl.)',

    //basic-words
    'from' => 'da',
    'from_who' => 'da chi',
    'about' => 'Informazioni',
    'close' => 'Chiudi',
    'reload_player' => 'Ricarica lettore',
    'uhr' => ' ',

    //centralerrorlog
    'centralerrorlog_error_occured' => 'Messaggio di errore di esempio durante il caricamento della pagina.',
    'centralerrorlog_neterror_occured' => 'Errore di rete durante il caricamento ',
    'centralerrorlog_modal_title' => 'Console degli Errori',
    'centralerrorlog_modal_desc' => 'Se hai accesso a questa finestra, sono avvenuti errori critici (probabilmente errori di connessione). Questi errori potrebbero interrompere leggermente o significativamente il funzionamento di "PanPlay" e causare un crash. Si prega di essere attenti. Se hai familiarità con gli strumenti per sviluppatori del tuo dispositivo, ti consigliamo di cercare ulteriori errori lì. Gli errori potrebbero essere risolvibili.',
    'centralerrorlog_occuring_modal_title' => 'Console degli Errori',
    'centralerrorlog_occuring_modal_desc1' => 'Si sono verificati degli errori! Potrebbe esserci una perdita di connessione! Si prega di controllare la',
    'centralerrorlog_occuring_modal_desc2' => 'Console degli Errori',

    //settingspanel PanPlay
    'settingspanel_modal_title' => 'Impostazioni',
    'settingspanel_lang_title' => 'Lingua',
    'settingspanel_lang_desc' => 'Seleziona una lingua diversa per l\'interfaccia. ',
    'settingspanel_lang_ext_desc' => 'Le estensioni funzionano con i propri file di lingua e potrebbero non funzionare in tutte le lingue.',
    'settingspanel_theme_title' => 'Tema',
    'settingspanel_theme_desc' => 'Scegli un tema visivo per questo URL del player. Cambia solo il parametro URL generato e non modifica la configurazione del server.',
    'settingspanel_extension_title' => 'Impostazioni estensione',
    'settingspanel_baseaudio_desc' => 'Modifica l URL audio diretto usato da baseaudio. Applicando la modifica il player si ricarica con un nuovo parametro webstream.',
    'settingspanel_laut_desc' => 'Modifica le opzioni di visualizzazione laut.fm per questo URL del player. Applicando una modifica il player si ricarica con il parametro URL corrispondente.',
    'settingspanel_on' => 'Attivo',
    'settingspanel_off' => 'Disattivo',
    'settingspanel_laut_feature_windows' => 'Finestre funzioni laut.fm',
    'settingspanel_laut_use_selected' => 'Usa opzioni selezionate',
    'settingspanel_laut_hide_all' => 'Nascondi tutto',
    'settingspanel_laut_default_windows' => 'Predefinito: mostra tutte le finestre',
    'settingspanel_laut_playback_behavior' => 'Comportamento di riproduzione',
    'settingspanel_laut_schedule' => 'Palinsesto',
    'settingspanel_laut_currentsongmodal' => 'Finestra brano corrente',
    'settingspanel_laut_lbn' => 'Live per nome',
    'settingspanel_laut_trackhistory' => 'Cronologia brani',
    'settingspanel_laut_playwith' => 'Cambia player',
    'settingspanel_laut_global_override_note' => 'Tutte le finestre funzione laut.fm sono attualmente disattivate dall interruttore globale nolfmw. Le impostazioni delle singole finestre vengono ignorate finche questo interruttore non viene cambiato di nuovo.',
    'settingspanel_laut_stationinfo' => 'Informazioni stazione',

    //about PanPlay
    'about_modal_title' => 'PanPlay',
    'about_brand_phrase' => '<b><u>Il</u></b> lettore audio HTML5!',
    'about_license_owner_is' => 'Concesso in licenza a',
    'about_license_datewording' => 'nella sua versione da',
    'about_prerelease_warning_title' => 'Prerilascio Instabile',
    'about_prerelease_warning_p1' => 'Questa versione di',
    'about_prerelease_warning_p2' => 'è un prerilascio destinato esclusivamente a tracciare i progressi dello sviluppo. L\'uso produttivo non è raccomandato.',
    'about_documentation_p1' => 'Ulteriori informazioni possono essere trovate sulla',
    'about_documentation_p2' => 'documentazione',
    'about_documentation_p3' => '.',
    'about_legal_p1' => 'Le',
    'about_legal_p2' => 'protezione dei dati',
    'about_legal_p3' => 'e le informazioni legali nell\'',
    'about_legal_p4' => 'impressum',
    'about_legal_p5' => ' si applicano. Inoltre, si applicano i',
    'about_legal_p6' => 'termini di utilizzo',
    'about_legal_p7' => 'che puoi trovare',
    'about_legal_p8' => 'qui',
    'about_legal_p9' => '.',
    'bluescreen_heading' => '%s ha causato un errore del server',
    'bluescreen_exception_label' => 'Eccezione del server',
    'bluescreen_explanation_label' => 'Spiegazione',
    'bluescreen_operator_hint' => 'Torna alla pagina precedente. Se il problema persiste, informa l operatore del server (%s).',
    'cpm_block_headline' => 'Contenuto bloccato da PanPlay CPM',
    'cpm_block_desc' => 'L URL baseaudio richiesta e bloccata dalla policy di questa istanza PanPlay.',
    'cpm_block_source' => 'Lista regole corrispondente',
    'cpm_block_rule' => 'Regola corrispondente',
    'cpm_more_info' => 'Ulteriori informazioni su questa policy dei contenuti',
    'compat_meta_title' => 'Errore: contenuto non supportato - PanPlay',
    'compat_headline' => 'Contenuto non supportato!',
    'compat_sub_headline' => 'Il contenuto richiesto non e supportato dal dispositivo o dal software.',
    'compat_desc_1' => 'Questo sito fornisce contenuti a un pubblico ampio e supporta anche browser piu vecchi.',
    'compat_desc_2' => 'Tuttavia, il software attuale e classificato come altamente incompatibile e non sicuro. Per questo il contenuto non e stato consegnato.',
    'compat_ts_title' => 'Informazioni per la risoluzione dei problemi',
    'compat_ts_desc' => 'Il sistema ha identificato i seguenti dettagli tecnici:',
    'compat_detected_browser' => 'Browser rilevato',
    'compat_user_agent' => 'Stringa User-Agent completa',
    'compat_back' => 'Indietro',
    'compat_recommended_action' => 'Azione consigliata',
    'compat_recommended_desc' => 'Utilizzare un browser moderno per accedere a questa istanza di PanPlay.',
    'compat_more_help' => 'Ulteriore aiuto e informazioni di contesto',
    'compat_detected_browser_link' => 'Apri il sito web del browser rilevato',
);
?>
