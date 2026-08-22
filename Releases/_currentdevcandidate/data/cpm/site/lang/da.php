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
    'meta_description' => 'Offentlig information om PanPlay CPM, lokale og centrale filterlister, privatliv og operatørens ansvar.',
    'language_label' => 'Sprog',
    'language_apply' => 'Anvend',
    'status_label' => 'Offentlig dokumentation',
    'title' => 'PanPlay Content Protection Mechanism',
    'lead' => 'Sådan kontrollerer PanPlay direkte lyd-URL’er, bruger lokale og valgfrie centrale regler og beskytter afspilningen uden at rapportere lyttede URL’er.',
    'current_title' => 'Central liste tilgængelig',
    'current_body' => 'Den offentlige CPM-filterliste kan bruges af deltagende PanPlay-installationer. Den enkelte operatør bestemmer selv deltagelsen.',
    'what_title' => 'Hvad CPM er',
    'what_body' => 'CPM er et filterlag til PanPlays Baseaudio-udvidelse. Det kan blokere kendte eller lokalt forbudte direkte lyd-URL’er før afspilning. Det er hverken DRM eller en juridisk afgørelse om et websted, en bruger eller en fil.',
    'geography_title' => 'Ingen geografiske regler',
    'why_title' => 'Hvorfor CPM findes',
    'why_body' => 'CPM giver operatører af PanPlay-installationer en teknisk måde at reagere på meddelelser fra rettighedshavere, DMCA-lignende krav om fjernelse og sammenlignelige ophavsretlige krav i EU og andre jurisdiktioner. Det er hverken et uploadfilter eller en aktiv kampagne mod piratkopiering; det filtrerer afspilning og behandling gennem PanPlay.',
    'effect_title' => 'Hvad en blokering gør',
    'effect_body' => 'Et match sletter eller beslaglægger ikke kildefilen og gør den heller ikke utilgængelig på anden vis. PanPlay nægter kun at hente og afspille den gennem Baseaudio. Kontrollen sender ingen advarsel eller rapport til brugeren, rettighedshaveren, hostingudbyderen, myndigheder eller andre tredjeparter.',
    'geography_body' => 'Den centrale liste træffer ikke landespecifikke beslutninger. Hvis en operatørs jurisdiktion eller politik kræver andre regler, bør CPM by CDN deaktiveres og en passende lokal liste vedligeholdes.',
    'flow_title' => 'Sådan fungerer en kontrol',
    'flow_1' => 'PanPlay modtager en direkte lyd-URL i Baseaudio-tilstand.',
    'flow_2' => 'Installationen normaliserer URL’en for at gøre sammenligningen forudsigelig.',
    'flow_3' => 'Lokale regler kontrolleres på PanPlay-serveren.',
    'flow_4' => 'Hvis funktionen er aktiveret, kontrolleres den lokalt cachede centrale liste også.',
    'flow_5' => 'Undtagelser går forud for blokeringer. Et tilbageværende match stopper afspilningen og viser en neutral 403-fejl.',
    'lists_title' => 'Regler og kilder',
    'local_title' => 'Lokale regler',
    'local_body' => 'Hver selvhostet installation kan vedligeholde egne regler. De gælder uafhængigt af den centrale liste og forbliver under operatørens kontrol.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Deltagende installationer henter og cacher jævnligt den offentlige PanPlay-liste. Kontrollen foregår fortsat lokalt og bruger ikke en direkte URL-kontroltjeneste.',
    'exceptions_title' => 'Undtagelser',
    'exceptions_body' => 'Regler, der begynder med @@, tillader udtrykkeligt en matchende adresse og har prioritet over blokeringer. De kan rette for brede match.',
    'rules_title' => 'Filterlistens format',
    'rules_intro' => 'CPM bruger et dokumenteret Adblock-lignende delsæt: kommentarer, domæner, nøjagtige URL’er, enkle jokertegn, undtagelser og PanPlay-importdirektiver.',
    'rule_comment' => 'Kommentar',
    'privacy_title' => 'Privatliv',
    'privacy_body' => 'Med CPM by CDN henter PanPlay en liste og vurderer den anmodede URL på den lokale installation. Den lyttede URL sendes ikke til Pangom under normale kontroller.',
    'operator_title' => 'Ansvar ved selvhosting',
    'operator_body' => 'Operatøren bestemmer, om CPM og CPM by CDN er aktiveret, og er ansvarlig for passende lokale regler, juridiske dokumenter, kontaktoplysninger og overholdelse af lokal lovgivning.',
    'complaints_title' => 'Rettelser og klager',
    'complaints_body' => 'Kontakt den relevante operatør ved en lokal blokering. Rapporter til den fælles liste kan sendes til PanPlay og gennemgås manuelt, før en central regel ændres.',
    'contact_link' => 'Kontakt PanPlay',
    'limits_title' => 'Tekniske begrænsninger',
    'limits_body' => 'CPM gælder kun Baseaudio og ikke laut.fm-afspilning. Det giver ingen fuldstændig beskyttelse mod piratkopiering, ingen geografisk håndhævelse og ingen garanti for, at alle forbudte kilder er kendt.',
    'resources_title' => 'Offentlige ressourcer',
    'filterlist_link' => 'Åbn den centrale filterliste',
    'source_link' => 'Importeret anti-piracy-kilde',
    'repository_link' => 'PanPlay-kildekode',
    'footer_note' => 'CPM dokumenterer filterbeslutninger; det erstatter ikke operatørens juridiske vurdering.',
);
