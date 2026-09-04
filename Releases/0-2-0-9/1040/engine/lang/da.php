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
    'lng_title' => 'Dansk',
    'welcome' => 'Velkommen til vores hjemmeside!',
    'page_title' => 'PanPlay',
    'select_language' => 'Vælg et sprog:',
    'remember_language' => 'Husk dette sprog',
    'apply' => 'Ansøge',
    'current_language' => '<span class="badge bg-danger">DA</span> Dansk',

    //basic-words
    'from' => 'fra',
    'from_who' => 'fra hvem',
    'about' => 'Over',
    'close' => 'Luk',
    'reload_player' => 'Genindlæs afspiller',
    'uhr' => ' ',
    
    //centralerrorlog
    'centralerrorlog_error_occured' => 'Eksempel på fejlmeddelelse ved indlæsning af siden.',
    'centralerrorlog_neterror_occured' => 'Netværksfejl ved indlæsning ',
    'centralerrorlog_modal_title' => 'Fejlkonsol',
    'centralerrorlog_modal_desc' => 'Hvis du har adgang til dette vindue, er der opstået kritiske fejl (sandsynligvis forbindelsesfejl). Disse fejl kan enten kun i ringe grad eller væsentligt forstyrre den videre drift af "PanPlay" og føre til et nedbrud. Vær venligst opmærksom. Hvis du er bekendt med din enheds udviklerværktøjer, anbefaler vi, at du også tjekker for yderligere fejl der. Fejlene kan muligvis rettes.',
    'centralerrorlog_occuring_modal_title' => 'Fejlkonsol',
    'centralerrorlog_occuring_modal_desc1' => 'Der opstod en fejl! Der kan være et tab af forbindelse! Tjek dem venligst',
    'centralerrorlog_occuring_modal_desc2' => 'Fejlkonsol',

    //settingspanel PanPlay
    'settingspanel_modal_title' => 'Indstillinger',
    'settingspanel_lang_title' => 'Sprog',
    'settingspanel_lang_desc' => 'Vælg et andet sprog til brugergrænsefladen. Brugergrænsefladen vælger det viste sprog baseret på URL-parameteren "hl". Hvis denne parameter ikke findes i URL\'en, vil den automatisk forsøge at bruge det sprog, der bruges af din browser. Hvis vi ikke leverer grænsefladen på dette sprog, vil siden blive vist på engelsk.',
    'settingspanel_lang_ext_desc' => 'Udvidelser fungerer nogle gange uden eller med deres egne sprogfiler og fungerer muligvis ikke på alle sprog.',
    'settingspanel_theme_title' => 'Tema',
    'settingspanel_theme_desc' => 'Vaelg et visuelt tema for denne player-URL. Det aendrer kun URL-parameteren og ikke serverkonfigurationen.',
    'settingspanel_extension_title' => 'Udvidelsesindstillinger',
    'settingspanel_baseaudio_desc' => 'Aendr den direkte lyd-URL, som baseaudio bruger. Ved anvendelse genindlaeses playeren med en ny webstream-parameter.',
    'settingspanel_laut_desc' => 'Aendr laut.fm-visningsindstillinger for denne player-URL. Ved anvendelse genindlaeses playeren med den tilsvarende URL-parameter.',
    'settingspanel_on' => 'Til',
    'settingspanel_off' => 'Fra',
    'settingspanel_laut_feature_windows' => 'laut.fm-funktionsvinduer',
    'settingspanel_laut_use_selected' => 'Brug valgte indstillinger',
    'settingspanel_laut_hide_all' => 'Skjul alle',
    'settingspanel_laut_default_windows' => 'Standard: vis alle vinduer',
    'settingspanel_laut_playback_behavior' => 'Afspilningsadfaerd',
    'settingspanel_laut_schedule' => 'Sendeskema',
    'settingspanel_laut_currentsongmodal' => 'Aktuel titel-vindue',
    'settingspanel_laut_lbn' => 'Live efter navn',
    'settingspanel_laut_trackhistory' => 'Titelhistorik',
    'settingspanel_laut_playwith' => 'Skift afspiller',
    'settingspanel_laut_global_override_note' => 'Alle laut.fm-funktionsvinduer er i øjeblikket deaktiveret af den globale nolfmw-kontakt. De enkelte vinduesindstillinger ignoreres, indtil denne kontakt ændres tilbage.',
    'settingspanel_laut_stationinfo' => 'Stationsinfo',

    //about PanPlay
    'about_modal_title' => 'PanPlay',
    'about_brand_phrase' => '<b><u>HTML5</u></b> lydafspilleren!',
    'about_license_owner_is' => 'Licenseret',
    'about_license_datewording' => 'i versionen dateret',
    'about_prerelease_warning_title' => 'Ustabil forhåndsversion',
    'about_prerelease_warning_p1' => 'Denne version af',
    'about_prerelease_warning_p2' => 'er en pre-release version udelukkende beregnet til at spore udviklingsfremskridt. Produktiv brug anbefales ikke.',
    'about_documentation_p1' => 'Yderligere information kan findes på',
    'about_documentation_p2' => 'Dokumentation',
    'about_documentation_p3' => '.',
    'about_legal_p1' => 'Disse gælder',
    'about_legal_p2' => 'Data beskyttelse',
    'about_legal_p3' => 'og den ',
    'about_legal_p4' => 'aftryk',
    'about_legal_p5' => '. Disse gælder fortsat',
    'about_legal_p6' => 'Vilkår for brug',
    'about_legal_p7' => 'dig ',
    'about_legal_p8' => 'her',
    'about_legal_p9' => ' kan finde.',
    'bluescreen_heading' => '%s forarsagede en serverfejl',
    'bluescreen_exception_label' => 'Serverundtagelse',
    'bluescreen_explanation_label' => 'Forklaring',
    'bluescreen_operator_hint' => 'Ga tilbage til den forrige side. Hvis problemet fortsætter, skal du informere serveroperatoren (%s).',
    'cpm_block_headline' => 'Indhold blokeret af PanPlay CPM',
    'cpm_block_desc' => 'Den anmodede baseaudio-URL er blokeret af denne PanPlay-instanspolitik.',
    'cpm_block_source' => 'Matchende regelliste',
    'cpm_block_rule' => 'Matchende regel',
    'cpm_more_info' => 'Flere oplysninger om denne indholdspolitik',
    'compat_meta_title' => 'Fejl: Indhold understottes ikke - PanPlay',
    'compat_headline' => 'Indhold understottes ikke!',
    'compat_sub_headline' => 'Det onskede indhold understottes ikke af din enhed eller software.',
    'compat_desc_1' => 'Dette websted stiller indhold til radighed for et bredt publikum og understotter ogsa aeldre browsere.',
    'compat_desc_2' => 'Din aktuelle software er dog klassificeret som meget inkompatibel og usikker. Derfor blev indholdet ikke leveret.',
    'compat_ts_title' => 'Fejlfindingsoplysninger',
    'compat_ts_desc' => 'Systemet identificerede folgende tekniske detaljer:',
    'compat_detected_browser' => 'Registreret browser',
    'compat_user_agent' => 'Fuld User-Agent-streng',
    'compat_back' => 'Tilbage',
    'compat_recommended_action' => 'Anbefalet handling',
    'compat_recommended_desc' => 'Brug venligst moderne browsersoftware for at fa adgang til denne PanPlay-instans.',
    'compat_more_help' => 'Mere hjaelp og baggrundsinformation',
    'compat_detected_browser_link' => 'Abn webstedet for den registrerede browser',

    

    
);

?>
