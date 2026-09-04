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
    'meta_title' => 'PanPlay Content Protection Mechanism',
    'meta_description' => 'Öffentliche Informationen über PanPlay CPM, lokale und zentrale Filterlisten, Datenschutz und die Verantwortung von Betreibern.',
    'language_label' => 'Sprache',
    'language_apply' => 'Übernehmen',
    'status_label' => 'Öffentliche Dokumentation',
    'title' => 'PanPlay Content Protection Mechanism',
    'lead' => 'Wie PanPlay direkte Audio-URLs prüft, lokale und optionale zentrale Regeln verwendet und die Wiedergabe schützt, ohne gehörte URLs zu melden.',
    'current_title' => 'Zentrale Liste verfügbar',
    'current_body' => 'Die öffentliche CPM-Filterliste kann von teilnehmenden PanPlay-Instanzen verwendet werden. Die Teilnahme bleibt für jeden Betreiber einstellbar.',
    'what_title' => 'Was CPM ist',
    'what_body' => 'CPM ist eine Filterschicht für die PanPlay-Erweiterung Baseaudio. Sie kann bekannte oder lokal unerwünschte direkte Audio-URLs vor Beginn der Wiedergabe sperren. CPM ist weder DRM noch eine rechtliche Bewertung einer Website, eines Nutzers oder einer Datei.',
    'geography_title' => 'Keine geografischen Regeln',
    'why_title' => 'Warum es CPM gibt',
    'why_body' => 'CPM gibt Betreibern von PanPlay-Instanzen eine technische Möglichkeit, auf Meldungen von Rechteinhabern, Sperr- und Löschaufforderungen wie DMCA-Takedowns sowie vergleichbare urheberrechtliche Anforderungen in der EU und anderen Rechtsräumen zu reagieren. Es ist weder ein Uploadfilter noch eine aktive Kampagne gegen Piraterie, sondern filtert die Wiedergabe und Verarbeitung durch PanPlay.',
    'effect_title' => 'Was eine Sperre bewirkt',
    'effect_body' => 'Ein Treffer löscht oder beschlagnahmt die Quelldatei nicht und macht sie auch sonst nicht unzugänglich. PanPlay weigert sich lediglich, sie über Baseaudio abzurufen und abzuspielen. Die Prüfung versendet keine Abmahnung oder Meldung an Nutzer, Rechteinhaber, Hostinganbieter, Behörden oder andere Dritte.',
    'geography_body' => 'Die zentrale Liste trifft keine länderspezifischen Entscheidungen. Erfordert die Rechtslage oder Richtlinie eines Betreibers andere Regeln, sollte CPM by CDN deaktiviert und eine passende lokale Liste gepflegt werden.',
    'flow_title' => 'So läuft eine Wiedergabeprüfung ab',
    'flow_1' => 'PanPlay empfängt im Baseaudio-Modus eine direkte Audio-URL.',
    'flow_2' => 'Die Instanz normalisiert die URL für eine vorhersehbare Prüfung.',
    'flow_3' => 'Lokale Regeln werden auf dem PanPlay-Server geprüft.',
    'flow_4' => 'Wenn aktiviert, wird zusätzlich die lokal zwischengespeicherte zentrale Liste geprüft.',
    'flow_5' => 'Ausnahmen überschreiben Sperren. Ein verbleibender Treffer stoppt die Wiedergabe und zeigt einen neutralen 403-Fehler.',
    'lists_title' => 'Regeln und Quellen',
    'local_title' => 'Lokale Regeln',
    'local_body' => 'Jede selbst gehostete Instanz kann eigene Regeln pflegen. Sie gelten unabhängig von der zentralen Liste und bleiben unter der Kontrolle des Betreibers.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Teilnehmende Instanzen laden die öffentliche PanPlay-Liste regelmäßig herunter und speichern sie zwischen. Die Wiedergabeprüfung bleibt lokal und nutzt keinen Live-Dienst zur URL-Prüfung.',
    'exceptions_title' => 'Ausnahmen',
    'exceptions_body' => 'Regeln, die mit @@ beginnen, erlauben eine passende Adresse ausdrücklich und haben Vorrang vor Sperrregeln. Damit können Betreiber zu weit gefasste Treffer korrigieren.',
    'rules_title' => 'Format der Filterliste',
    'rules_intro' => 'CPM nutzt einen dokumentierten Adblock-ähnlichen Teilumfang: Kommentare, Domains, exakte URLs, einfache Platzhalter, Ausnahmen und PanPlay-Importanweisungen.',
    'rule_comment' => 'Kommentar',
    'privacy_title' => 'Datenschutz',
    'privacy_body' => 'Bei CPM by CDN lädt PanPlay eine Liste herunter und prüft die angeforderte URL auf der lokalen Instanz. Die gehörte URL wird bei normalen Wiedergabeprüfungen nicht an Pangom gesendet.',
    'operator_title' => 'Verantwortung beim Self-Hosting',
    'operator_body' => 'Der Betreiber entscheidet, ob CPM und CPM by CDN aktiv sind, und ist für passende lokale Regeln, Rechtsdokumente, Kontaktdaten sowie die Einhaltung des örtlichen Rechts verantwortlich.',
    'complaints_title' => 'Korrekturen und Beschwerden',
    'complaints_body' => 'Wenden Sie sich bei einer lokalen Sperre an den jeweiligen Instanzbetreiber. Meldungen für die gemeinsame Liste können an PanPlay gesendet werden und werden vor einer zentralen Änderung manuell geprüft.',
    'contact_link' => 'PanPlay kontaktieren',
    'limits_title' => 'Technische Grenzen',
    'limits_body' => 'CPM gilt nur für Baseaudio, nicht für die laut.fm-Wiedergabe. Es bietet keinen vollständigen Schutz vor Piraterie, keine geografische Durchsetzung und keine Garantie, dass jede unzulässige Quelle bekannt ist.',
    'resources_title' => 'Öffentliche Ressourcen',
    'filterlist_link' => 'Zentrale Filterliste öffnen',
    'source_link' => 'Importierte Anti-Piracy-Quelle',
    'repository_link' => 'PanPlay-Quellcode',
    'footer_note' => 'CPM dokumentiert Filterentscheidungen; es ersetzt keine rechtliche Prüfung durch den Betreiber einer Instanz.',
);
