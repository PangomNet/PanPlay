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
    'meta_description' => 'Openbare informatie over PanPlay CPM, lokale en centrale filterlijsten, privacy en de verantwoordelijkheid van beheerders.',
    'language_label' => 'Taal',
    'language_apply' => 'Toepassen',
    'status_label' => 'Openbare documentatie',
    'title' => 'PanPlay Content Protection Mechanism',
    'lead' => 'Hoe PanPlay directe audio-URL’s controleert, lokale en optionele centrale regels gebruikt en afspelen beschermt zonder beluisterde URL’s te melden.',
    'current_title' => 'Centrale lijst beschikbaar',
    'current_body' => 'De openbare CPM-filterlijst kan door deelnemende PanPlay-instanties worden gebruikt. Elke beheerder bepaalt zelf of de instantie deelneemt.',
    'what_title' => 'Wat CPM is',
    'what_body' => 'CPM is een filterlaag voor de Baseaudio-uitbreiding van PanPlay. Bekende of lokaal verboden directe audio-URL’s kunnen vóór het afspelen worden geblokkeerd. Het is geen DRM en geen juridisch oordeel over een website, gebruiker of bestand.',
    'geography_title' => 'Geen geografische regels',
    'why_title' => 'Waarom CPM bestaat',
    'why_body' => 'CPM geeft beheerders van PanPlay-instanties een technisch middel om te reageren op meldingen van rechthebbenden, DMCA-achtige verwijderingsverzoeken en vergelijkbare auteursrechtelijke vereisten in de Europese Unie en andere rechtsgebieden. Het is geen uploadfilter en geen actieve campagne tegen piraterij; het filtert afspelen en verwerken via PanPlay.',
    'effect_title' => 'Wat een blokkade doet',
    'effect_body' => 'Een overeenkomst verwijdert of confisqueert het bronbestand niet en maakt het evenmin op een andere manier ontoegankelijk. PanPlay weigert alleen om het via Baseaudio op te halen en af te spelen. De controle stuurt geen waarschuwing of melding naar de gebruiker, rechthebbende, hostingprovider, overheid of een andere derde partij.',
    'geography_body' => 'De centrale lijst neemt geen landspecifieke beslissingen. Als het rechtsgebied of beleid van een beheerder andere regels vereist, moet CPM by CDN worden uitgeschakeld en een passende lokale lijst worden onderhouden.',
    'flow_title' => 'Zo werkt een controle',
    'flow_1' => 'PanPlay ontvangt in Baseaudio-modus een directe audio-URL.',
    'flow_2' => 'De instantie normaliseert de URL voor een voorspelbare vergelijking.',
    'flow_3' => 'Lokale regels worden op de PanPlay-server gecontroleerd.',
    'flow_4' => 'Indien ingeschakeld, wordt ook de lokaal opgeslagen centrale lijst gecontroleerd.',
    'flow_5' => 'Uitzonderingen gaan voor blokkades. Een resterende overeenkomst stopt het afspelen en toont een neutrale 403-fout.',
    'lists_title' => 'Regels en bronnen',
    'local_title' => 'Lokale regels',
    'local_body' => 'Elke zelfgehoste instantie kan eigen regels onderhouden. Ze gelden onafhankelijk van de centrale lijst en blijven onder controle van de beheerder.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Deelnemende instanties downloaden en bewaren regelmatig de openbare PanPlay-lijst. Controles blijven lokaal en gebruiken geen live dienst voor URL-controle.',
    'exceptions_title' => 'Uitzonderingen',
    'exceptions_body' => 'Regels die met @@ beginnen staan een overeenkomend adres uitdrukkelijk toe en hebben voorrang op blokkades. Hiermee kunnen te brede overeenkomsten worden gecorrigeerd.',
    'rules_title' => 'Filterlijstformaat',
    'rules_intro' => 'CPM gebruikt een gedocumenteerde Adblock-achtige deelverzameling: opmerkingen, domeinen, exacte URL’s, eenvoudige jokertekens, uitzonderingen en PanPlay-importinstructies.',
    'rule_comment' => 'Opmerking',
    'privacy_title' => 'Privacy',
    'privacy_body' => 'Met CPM by CDN downloadt PanPlay een lijst en beoordeelt de aangevraagde URL op de lokale instantie. De beluisterde URL wordt bij normale controles niet naar Pangom gestuurd.',
    'operator_title' => 'Verantwoordelijkheid bij zelfhosting',
    'operator_body' => 'De beheerder bepaalt of CPM en CPM by CDN actief zijn en is verantwoordelijk voor passende lokale regels, juridische documenten, contactgegevens en naleving van de lokale wetgeving.',
    'complaints_title' => 'Correcties en klachten',
    'complaints_body' => 'Neem voor een lokale blokkade contact op met de beheerder van die instantie. Meldingen voor de gedeelde lijst kunnen aan PanPlay worden gestuurd en worden handmatig beoordeeld.',
    'contact_link' => 'Contact opnemen met PanPlay',
    'limits_title' => 'Technische grenzen',
    'limits_body' => 'CPM geldt alleen voor Baseaudio en niet voor laut.fm-weergave. Het biedt geen volledige piraterijpreventie, geen geografische handhaving en geen garantie dat elke verboden bron bekend is.',
    'resources_title' => 'Openbare bronnen',
    'filterlist_link' => 'Centrale filterlijst openen',
    'source_link' => 'Geïmporteerde antipiraterijbron',
    'repository_link' => 'Broncode van PanPlay',
    'footer_note' => 'CPM documenteert filterbeslissingen; het vervangt geen juridische beoordeling door de beheerder van een instantie.',
);
