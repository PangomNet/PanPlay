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
//basic
    'lng_title' => 'Dansk',
    'extension_title' => 'Laut.fm-udvidelse til PanPlay',
    'extension_credits' => 'Laut.fm-udvidelse til PanPlay',
    'extension_credits_link' => 'https://laut.fm/?from=PanPlay-Extension',

    //Topnavbar Linktitel
    'trackhistory_navbar_title' => 'Sporhistorik',
    'stationinfo_navbar_title' => ' Information om ',
    'sendeplan_navbar_title' => 'Sendeskema',
    'playwith_navbar_title' => 'Skift afspiller',

    //trackhistory modal
    'trackhistory_modal_title' => 'Sporhistorik',
    'current_song' => 'Aktuelt afspillet nummer:',
    'last_songs' => 'Tidligere afspillede numre:',
    'current_song_modallink' => 'Nu spiller',

    //sendeplan modal
    'sendeplan_modal_title' => 'Sendeskema',
    'today' => 'I dag',
    'mo' => 'Mandag',
    'di' => 'Tirsdag',
    'mi' => 'Onsdag',
    'do' => 'Torsdag',
    'fr' => 'Fredag',
    'sa' => 'Lørdag',
    'so' => 'Søndag',
    'mo_s' => 'MAN',
    'di_s' => 'TIR',
    'mi_s' => 'ONS',
    'do_s' => 'TOR',
    'fr_s' => 'FRE',
    'sa_s' => 'LØR',
    'so_s' => 'SØN',
    'nospecialshow' => 'Ingen specielle programmer',
    'sendeplan_laut' => 'Fuld sendeskema på laut.fm',

    //Stationinfo modal
    'stationinfo_modal_title' => 'Information om ',

    //playwith modal
    'playwith_modal_title' => 'Skift Afspiller',
    'playwith_modal_topdesc' => 'Du kan åbne denne stream i andre applikationer eller eksterne afspilningsenheder. For at gøre det, vælg den passende afspilningsmulighed.',
    'playwith_modal_gcast_topdesc1' => 'Cast "',
    'playwith_modal_gcast_topdesc2' => '" til en enhed, der understøtter Chromecast eller Google Cast. For at gøre det, klik på Google Cast-ikonet nederst til højre på hovedskærmen (<i class="fab fa-chromecast"></i>)**',
    'directstreamtobrowserdropdown' => 'Åbn stream-URL',
    'directstreamtobrowserdropdown_option1' => '<span class="badge bg-dark">m3u</span>-Stream',
    'directstreamtobrowserdropdown_option2' => '<span class="badge bg-dark">pls</span>-Stream',
    'playwith_modal_bottomnote' => '* Hvis du bruger en tjenesteapplikation på din telefon (f.eks. laut.fm-appen på Android), kan denne app opfange navigeringen til denne tjeneste. Streamen vil derefter blive åbnet direkte i den tilsvarende app.',
    'playwith_modal_cast_bottomnote1' => '** Google Cast er ikke tilgængelig på alle enheder eller software. Linux-, Mac- og Windows-brugere har brug for en Chrome-baseret browser som Google Chrome, Microsoft Edge, Opera, Brave eller Vivaldi. På MacOS kan det være nødvendigt med den officielle Chromecast-applikation. Android- og iOS-brugere kan have brug for Google Home-appen. Fuldstændige systemkrav til Google Cast kan findes ',
    'playwith_modal_cast_bottomnote_linktitle' => 'her',

    //net error modal
    'neterr_modal_title' => 'Afspilningsfejl',
    'neterr_desc_net_thinking' => 'Noget gik galt. Analyserer data!',
    'neterr_desc_net_okay1' => '<b>✔ Stabil forbindelse</b><hr> Alle nødvendige servere til afspilning er tilgængelige. <hr><i>Dette kan betyde, at din forbindelse midlertidigt blev afbrudt, hvilket er grunden til, at du ser dette vindue. Fungerer afspilningen igen? For at sikre dig, at ',
    'neterr_desc_net_okay2' => ' sender, kan du også tjekke deres tilstedeværelse på Laut.fm',
    'neterr_desc_net_okay3' => 'Tjek',
    'neterr_console_net_okay' => '✔ Stabil forbindelse.',
    'neterr_desc_net_laut_not_okay1' => '<b>Delvis internetforbindelsesproblem</b><hr> Vi kan ikke nå laut.fm-serveren for din station. Det kan være, at få eller ingen indhold fra laut.fm kan indlæses.',
    'neterr_desc_net_laut_not_okay2' => '',
    'neterr_console_net_laut_not_okay' => '⚠ Forbindelsesfejl under hentning af stream fra Laut.fm',
    'neterr_desc_net_not_okay1' => '<b>Ingen internetforbindelse</b><hr> Alle internetforbindelser er blevet afbrudt. Dette har forårsaget, at afspilningen blev afbrudt. Det er usandsynligt, men muligt, at afspilningen kan genoptages uden at genindlæse afspilleren. <br><br> På mobile enheder kan denne fejl opstå på grund af et netværksskifte (f.eks. fra Wi-Fi til mobildata). I dette tilfælde er det normalt nok at genindlæse siden.',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => 'Fejl under hentning af serverstatus: ',  

    //PWF app shell (0.3.0.0 Fieldrush) -- added by Claude Code, see AI-HANDOFF.md
    'stationinfo_tab_title' => 'Stationsinfo',
    'stationinfo_heading' => 'Stationsoplysninger',
    'station_summary_heading' => 'Om stationen',
    'station_rich_content_heading' => 'Fra stationen',
    'empty_state_title' => 'Ingen data endnu',
    'history_loading_desc' => 'Indlaeser sanghistorik.',
    'schedule_loading_desc' => 'Indlaeser ugeplan.',
    'station_djs_heading' => 'DJ\'er',
    'station_location_heading' => 'Placering',
    'station_genres_heading' => 'Genrer',
    'station_top_artists_heading' => 'Ofte spillede kunstnere',
    'current_song_lastfm_link' => 'Sog paa Last.fm',
    'disable_station_accent_label' => 'Deaktiver automatisk accentfarve fra stationslogoet',
    'live_by_name_checkbox_label' => 'Udled ogsaa livestatus ud fra programnavnet',
    'station_source_suffix' => 'paa laut.fm',
    'station_description_fallback' => 'Der er ingen beskrivelse tilgaengelig for denne station.',
    'station_data_unavailable_status' => 'Stationsdata er i ojeblikket utilgaengelige',
    'station_format_prefix' => 'Format',
    'station_listeners_suffix' => 'lyttere',
    'station_rank_prefix' => 'Placering',
);
?>
