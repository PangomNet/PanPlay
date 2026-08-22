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
    'meta_title' => 'Meccanismo di protezione dei contenuti PanPlay',
    'meta_description' => 'Informazioni pubbliche su PanPlay CPM, gli elenchi di filtri locali e centrali, la privacy e le responsabilità dei gestori.',
    'language_label' => 'Lingua',
    'language_apply' => 'Applica',
    'status_label' => 'Documentazione pubblica',
    'title' => 'Meccanismo di protezione dei contenuti PanPlay',
    'lead' => 'Come PanPlay controlla gli URL audio diretti, usa regole locali e centrali facoltative e protegge la riproduzione senza segnalare gli URL ascoltati.',
    'current_title' => 'Elenco centrale disponibile',
    'current_body' => 'L’elenco pubblico CPM può essere usato dalle istanze PanPlay partecipanti. Ogni gestore può decidere se partecipare.',
    'what_title' => 'Che cos’è CPM',
    'what_body' => 'CPM è un livello di filtro per l’estensione Baseaudio di PanPlay. Può bloccare prima della riproduzione URL audio diretti noti o vietati localmente. Non è un DRM né un giudizio legale su un sito, un utente o un file.',
    'geography_title' => 'Nessuna regola geografica',
    'why_title' => 'Perché esiste CPM',
    'why_body' => 'CPM offre ai gestori delle istanze PanPlay uno strumento tecnico per rispondere alle segnalazioni dei titolari dei diritti, alle richieste di rimozione simili al DMCA e a requisiti comparabili sul diritto d’autore nell’Unione europea e in altre giurisdizioni. Non è né un filtro di caricamento né una campagna attiva contro la pirateria: filtra la riproduzione e l’elaborazione tramite PanPlay.',
    'effect_title' => 'Cosa comporta un blocco',
    'effect_body' => 'Una corrispondenza non elimina né sequestra il file sorgente e non lo rende altrimenti inaccessibile. PanPlay si limita a rifiutare di recuperarlo e riprodurlo tramite Baseaudio. Il controllo non invia avvisi o segnalazioni all’utente, al titolare dei diritti, al provider di hosting, alle autorità o ad altri terzi.',
    'geography_body' => 'L’elenco centrale non applica decisioni specifiche per paese. Se la giurisdizione o la politica del gestore richiede regole diverse, occorre disattivare CPM by CDN e mantenere un elenco locale adeguato.',
    'flow_title' => 'Come funziona un controllo',
    'flow_1' => 'PanPlay riceve un URL audio diretto in modalità Baseaudio.',
    'flow_2' => 'L’istanza normalizza l’URL per rendere prevedibile il confronto.',
    'flow_3' => 'Le regole locali vengono controllate sul server PanPlay.',
    'flow_4' => 'Se abilitato, viene controllato anche l’elenco centrale memorizzato localmente.',
    'flow_5' => 'Le eccezioni prevalgono sui blocchi. Una corrispondenza restante interrompe la riproduzione e mostra un errore 403 neutro.',
    'lists_title' => 'Regole e fonti',
    'local_title' => 'Regole locali',
    'local_body' => 'Ogni istanza ospitata autonomamente può mantenere regole proprie. Si applicano indipendentemente dall’elenco centrale e restano sotto il controllo del gestore.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Le istanze partecipanti scaricano e memorizzano periodicamente l’elenco pubblico PanPlay. I controlli restano locali e non usano un servizio online di verifica degli URL.',
    'exceptions_title' => 'Eccezioni',
    'exceptions_body' => 'Le regole che iniziano con @@ consentono esplicitamente un indirizzo corrispondente e hanno priorità sui blocchi. Servono a correggere corrispondenze troppo ampie.',
    'rules_title' => 'Formato dell’elenco',
    'rules_intro' => 'CPM usa un sottoinsieme documentato in stile Adblock: commenti, domini, URL esatti, caratteri jolly semplici, eccezioni e direttive di importazione PanPlay.',
    'rule_comment' => 'Commento',
    'privacy_title' => 'Privacy',
    'privacy_body' => 'Con CPM by CDN, PanPlay scarica un elenco e valuta l’URL richiesto sull’istanza locale. L’URL ascoltato non viene inviato a Pangom durante i normali controlli.',
    'operator_title' => 'Responsabilità del self-hosting',
    'operator_body' => 'Il gestore decide se abilitare CPM e CPM by CDN ed è responsabile delle regole locali, dei documenti legali, dei contatti e del rispetto delle leggi locali.',
    'complaints_title' => 'Correzioni e segnalazioni',
    'complaints_body' => 'Per un blocco locale, contattare il gestore dell’istanza interessata. Le segnalazioni per l’elenco condiviso possono essere inviate a PanPlay e vengono esaminate manualmente.',
    'contact_link' => 'Contatta PanPlay',
    'limits_title' => 'Limiti tecnici',
    'limits_body' => 'CPM si applica solo a Baseaudio, non alla riproduzione laut.fm. Non garantisce una prevenzione completa della pirateria, un’applicazione geografica o la conoscenza di ogni fonte vietata.',
    'resources_title' => 'Risorse pubbliche',
    'filterlist_link' => 'Apri l’elenco centrale',
    'source_link' => 'Fonte anti-pirateria importata',
    'repository_link' => 'Codice sorgente di PanPlay',
    'footer_note' => 'CPM documenta le decisioni di filtro; non sostituisce la valutazione legale del gestore di un’istanza.',
);
