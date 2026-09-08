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
    'lng_title' => 'Deutsch (Österreich)',
    'welcome' => 'Willkommen auf unserer Website!',
    'page_title' => 'PanPlay',
    'select_language' => 'Sprache auswählen:',
    'remember_language' => 'Diese Sprache merken',
    'apply' => 'Anwenden',
    'current_language' => '<span class="badge bg-danger">DE</span> Deutsch (Österreich)',

    //basic-words
    'from' => 'von',
    'from_who' => 'vom',
    'about' => 'Über',
    'close' => 'Schließen',
    'reload_player' => 'Player neu laden',
    'uhr' => 'Uhr',
    
    //centralerrorlog
    'centralerrorlog_error_occured' => 'Beispiel Fehlermeldung beim Laden der Seite.',
    'centralerrorlog_neterror_occured' => 'Netzwerkfehler beim Laden von ',
    'centralerrorlog_modal_title' => 'Fehlerkonsole',
    'centralerrorlog_modal_desc' => 'Wenn Sie auf dieses Fenster Zugriff haben, sind kritische Fehler (höchstwahrscheinlich Verbindungsfehler) aufgetreten. Diese Fehler könnten den weiteren Betrieb von "PanPlay" entweder nur gering oder sehr maßgeblich stören und zum Absturz führen. Bitte seien Sie aufmerksam. Wenn Sie sich mit den Entwicklertools Ihres Gerätes auskennen, empfehlen wir Ihnen, auch dort nach zusätzlichen Fehlern zu suchen. Die Fehler können eventuell behebbar sein.',
    'centralerrorlog_occuring_modal_title' => 'Fehlerkonsole',
    'centralerrorlog_occuring_modal_desc1' => 'Es sind Fehler aufgetreten! Es kommt eventuell zu einem Verbindungsverlust! Bitte prüfen Sie die',
    'centralerrorlog_occuring_modal_desc2' => 'Fehlerkonsole',

    //settingspanel PanPlay
    'settingspanel_modal_title' => 'Einstellungen',
    'settingspanel_lang_title' => 'Sprache',
    'settingspanel_lang_desc' => 'Wählen Sie eine andere Sprache für die Benutzeroberfläche.',
    'settingspanel_lang_ext_desc' => 'Erweiterungen arbeiten zum Teil ohne oder mit ihren eigenen Sprachdateien und funktionieren möglicherweise nicht in jeder Sprache.',
    'settingspanel_theme_title' => 'Theme',
    'settingspanel_theme_desc' => 'Wählen Sie ein visuelles Theme für diese Player-URL. Dadurch wird nur der URL-Parameter geändert, nicht die Serverkonfiguration.',
    'settingspanel_extension_title' => 'Erweiterungseinstellungen',
    'settingspanel_baseaudio_desc' => 'Ändern Sie die direkte Audio-URL für baseaudio. Beim Anwenden lädt der Player mit einem neuen webstream-Parameter neu.',
    'settingspanel_laut_desc' => 'Ändern Sie laut.fm-Anzeigeoptionen für diese Player-URL. Beim Anwenden lädt der Player mit dem passenden URL-Parameter neu.',
    'settingspanel_on' => 'An',
    'settingspanel_off' => 'Aus',
    'settingspanel_laut_feature_windows' => 'laut.fm-Funktionsfenster',
    'settingspanel_laut_use_selected' => 'Ausgewählte Optionen nutzen',
    'settingspanel_laut_hide_all' => 'Alle ausblenden',
    'settingspanel_laut_default_windows' => 'Standard: alle Fenster anzeigen',
    'settingspanel_laut_playback_behavior' => 'Wiedergabeverhalten',
    'settingspanel_laut_schedule' => 'Sendeplan',
    'settingspanel_laut_playwith' => 'Player wechseln',
    'settingspanel_laut_global_override_note' => 'Alle laut.fm-Funktionsfenster sind derzeit durch den globalen nolfmw-Schalter deaktiviert. Die einzelnen Fenstereinstellungen werden ignoriert, bis dieser Schalter wieder zurückgestellt wird.',
    'settingspanel_laut_currentsongmodal' => 'Aktueller Titel',
    'settingspanel_laut_stationinfo' => 'Senderinformationen',
    'settingspanel_laut_trackhistory' => 'Titelhistorie',
    'settingspanel_laut_lbn' => 'Live nach Sendungsname',

    //about PanPlay
    'about_modal_title' => 'PanPlay',
    'about_brand_phrase' => '<b><u>Der</u></b> HTML5-Audioplayer!',
    'about_license_owner_is' => 'Lizensiert an',
    'about_license_datewording' => 'in der Fassung vom',
    'about_prerelease_warning_title' => 'Instabile Vorabversion',
    'about_prerelease_warning_p1' => 'Diese Version von',
    'about_prerelease_warning_p2' => 'ist eine Vorabversion, die ausschließlich dazu dient, den Fortschritt der Entwicklung zu verfolgen. Eine produktive Nutzung wird nicht empfohlen.',
    'about_documentation_p1' => 'Weitere Informationen finden Sie auf der',
    'about_documentation_p2' => 'Dokumentation',
    'about_documentation_p3' => '.',
    'about_legal_p1' => 'Es gelten die',
    'about_legal_p2' => 'Datenschutz',
    'about_legal_p3' => 'und das ',
    'about_legal_p4' => 'Impressum',
    'about_legal_p5' => '. Weiterhin gelten die',
    'about_legal_p6' => 'Nutzungsbedingungen',
    'about_legal_p7' => 'die Sie ',
    'about_legal_p8' => 'hier',
    'about_legal_p9' => ' finden können.',

    //bluescreen
    'bluescreen_heading' => '%s hat einen Serverfehler verursacht',
    'bluescreen_exception_label' => 'Server-Ausnahme',
    'bluescreen_explanation_label' => 'Erklärung',
    'bluescreen_operator_hint' => 'Navigieren Sie zur vorherigen Seite zurück. Wenn das Problem weiterhin besteht, informieren Sie den Serverbetreiber (%s).',
    'cpm_block_headline' => 'Inhalt durch PanPlay CPM blockiert',
    'cpm_block_desc' => 'Die angeforderte baseaudio-URL wurde durch die Richtlinie dieser PanPlay-Instanz blockiert.',
    'cpm_block_source' => 'Auslösende Regelliste',
    'cpm_block_rule' => 'Auslösende Regel',
    'cpm_more_info' => 'Weitere Informationen zu dieser Inhaltsrichtlinie',

    //compatibility check
    'compat_meta_title' => 'Fehler: Inhalt nicht unterstützt - PanPlay',
    'compat_headline' => 'Inhalt wird nicht unterstützt!',
    'compat_sub_headline' => 'Der angeforderte Inhalt wird von Ihrem Gerät oder Ihrer Software nicht unterstützt.',
    'compat_desc_1' => 'Diese Website stellt ihre Inhalte einem breiten Publikum bereit und unterstützt auch ältere Browser.',
    'compat_desc_2' => 'Ihre aktuelle Software wird jedoch als stark inkompatibel und unsicher eingestuft. Deshalb wurde der Inhalt nicht ausgeliefert.',
    'compat_ts_title' => 'Fehlerbehebungsinformationen',
    'compat_ts_desc' => 'Das System hat die folgenden technischen Details erkannt:',
    'compat_detected_browser' => 'Erkannter Browser',
    'compat_user_agent' => 'Vollständiger User-Agent-String',
    'compat_back' => 'Zurück',
    'compat_recommended_action' => 'Empfohlene Maßnahme',
    'compat_recommended_desc' => 'Bitte verwenden Sie eine moderne Browser-Software, um auf diese PanPlay-Instanz zuzugreifen.',
    'compat_more_help' => 'Weitere Hilfe und Hintergrundinformationen',
    'compat_detected_browser_link' => 'Website des erkannten Browsers öffnen',

    

    

    //PWF app shell (0.3.0.0 Fieldrush) -- added by Claude Code, see AI-HANDOFF.md
    'shell_skip_to_content' => 'Zum Inhalt springen',
    'shell_areas_label' => 'PanPlay Bereiche',
    'shell_areas_mobile_label' => 'PanPlay Bereiche mobil',
    'shell_tools_label' => 'Werkzeuge',
    'shell_tagline' => 'Der HTML5-Audioplayer',
    'shell_ready_status' => 'Bereit',
    'shell_no_source' => 'Keine Audioquelle ausgewählt',
    'shell_open_with_source' => 'Öffne PanPlay mit einer Audioquelle.',
    'shell_preparing_source' => 'Audioquelle wird vorbereitet.',
    'share_heading' => 'Teilen',
    'share_page_heading' => 'Diesen Player teilen',
    'share_page_desc' => 'Teile diese PanPlay-Seite mit der ausgewählten Audioquelle.',
    'share_track_heading' => 'Aktuellen Titel teilen',
    'share_track_loading' => 'Titelinformationen werden geladen.',
    'switch_player_desc' => 'Öffne diese Audioquelle in einem anderen Dienst oder Abspielprogramm.',
    'direct_stream_url_label' => 'Direkte Stream-URL',
    'settings_lang_theme_legend' => 'Sprache und Theme',
    'settings_toggle_show' => '%s anzeigen',
    'play_action_label' => 'Wiedergabe starten',
    'mute_action_label' => 'Stummschalten',
    'volume_label' => 'Lautstärke',
    'cast_action_label' => 'Auf Google Cast-Gerät wiedergeben',
    'pause_action_label' => 'Wiedergabe pausieren',
    'unmute_action_label' => 'Ton einschalten',
    'transport_controls_toggle_label' => 'Wiedergabesteuerung',
    'artwork_alt_prefix' => 'Bild zu',
    'about_version_label' => 'Version',
    'about_stand_label' => 'Stand',
    'about_extension_label' => 'Erweiterung',
    'about_extension_none' => 'Keine',
    'about_legal_nav_label' => 'Dokumentation und Rechtliches',
    'about_warning_desc' => 'Dieser Build dient der Entwicklung und ist nicht für den produktiven Einsatz bestimmt.',
    'about_license_label' => 'Lizenz',
    'fact_album_label' => 'Album',
    'fact_genre_label' => 'Genre',
    'fact_duration_label' => 'Dauer',
    'fact_year_label' => 'Jahr',
    'fact_format_label' => 'Format',
    'fact_codec_label' => 'Codec',
    'fact_started_label' => 'Gestartet',
    'fact_ends_label' => 'Endet',
    'playback_playing_status' => 'Wiedergabe läuft',
    'playback_paused_status' => 'Pausiert',
    'playback_connecting_status' => 'Verbindung wird aufgebaut',
    'playback_error_status' => 'Audioquelle nicht erreichbar',
    'playback_start_failed_status' => 'Wiedergabe konnte nicht gestartet werden',
    'share_native_button' => 'Teilen',
    'share_page_intent_text' => 'Diesen Player mit PanPlay öffnen.',
    'share_track_intent_prefix' => 'Ich höre gerade',
    'share_track_intent_suffix' => 'mit PanPlay.',
);

?>
