<?php
echo '<script type="text/javascript" src="//api.laut.fm/js_tools/lautfm_js_tools.0.10.0.js.min.js" ></script>';


// Angenommen, $lfmstream ist hier bereits definiert, z.B.:
// $lfmstream = $_GET['station'] ?? 'defaultstation'; 

// --- NEU: Platzhalterseite definieren ---
// Ersetze 'deine_platzhalterseite.php' mit dem tatsächlichen Pfad zu deiner Platzhalterseite!
$fallback_page_url = 'deine_platzhalterseite.php'; 

// --- NEU: Serverseitige API-Statusprüfung ---
$api_status_ok = true; // Standardmäßig ist der API-Status OK
$api_error_message = '';

$api_check_url = "https://api.laut.fm/station/" . $lfmstream;

// Verwende cURL für eine robuste HTTP-Anfrage
if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_check_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Gib die Antwort als String zurück
    curl_setopt($ch, CURLOPT_HEADER, 0);         // Keine Header im Output
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);       // Timeout nach 5 Sekunden
    // FÜR PRODUKTION: CURLOPT_SSL_VERIFYPEER auf true lassen und CA-Zertifikate konfigurieren
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Für Entwicklungszwecke oft auf false gesetzt

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    // Prüfen auf cURL-Fehler, HTTP-Status >= 400 oder HTTP-Status 0 (Verbindungsfehler)
    if ($response === false || $http_status >= 400 || $http_status === 0) {
        $api_status_ok = false;
        $api_error_message = "Laut.fm API-Fehler für Station '{$lfmstream}': ";
        if ($http_status !== 0) {
            $api_error_message .= "HTTP-Status {$http_status}.";
        } else {
            $api_error_message .= "Verbindungsfehler: {$curl_error}.";
        }
        
        // Optional: Rufe hier deine PHP-Fehlerbehandlungsfunktion auf (z.B. für Logging)
        if (function_exists('errorHandler')) {
            errorHandler($api_error_message);
        } else {
            error_log("API Check Error (no errorHandler): " . $api_error_message);
        }

    } else {
        // Wenn HTTP-Status 200 OK ist, aber der JSON-Inhalt ungültig oder leer ist
        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($data) || !isset($data['display_name'])) {
            $api_status_ok = false;
            $api_error_message = "Laut.fm API-Fehler für Station '{$lfmstream}': Ungültige oder leere API-Antwort.";
            
            // Optional: Rufe hier deine PHP-Fehlerbehandlungsfunktion auf (z.B. für Logging)
            if (function_exists('errorHandler')) {
                errorHandler($api_error_message);
            } else {
                error_log("API Check Error (invalid JSON): " . $api_error_message);
            }
        }
    }
} else {
    // Fallback, wenn cURL nicht verfügbar ist
    $headers = @get_headers($api_check_url);
    if ($headers && strpos($headers[0], '200') === false) {
        $api_status_ok = false;
        $api_error_message = "Laut.fm API-Fehler für Station '{$lfmstream}': Status konnte nicht überprüft werden (cURL nicht verfügbar oder kein 200 OK).";
        
        // Optional: Rufe hier deine PHP-Fehlerbehandlungsfunktion auf (z.B. für Logging)
        if (function_exists('errorHandler')) {
            errorHandler($api_error_message);
        } else {
            error_log("API Check Error (get_headers): " . $api_error_message);
        }
    }
}

// === WICHTIG: Weiterleitung bei API-Fehler ===
if (!$api_status_ok) {
    header("Location: " . $fallback_page_url);
    exit; // Wichtig: Beende das Skript nach der Weiterleitung
}

// ... (Rest deines PHP-Codes, der die Seite normal rendert,
//      wenn die API-Prüfung erfolgreich war.) ...


$lfmapiloader_content = <<<HTML
<script>
// Vor dem eigentlichen laut.fm Code oder direkt danach, um die Standard-Definition zu überschreiben
window.laut.fm.errorcallback = function(msg) {
    console.error("Laut.fm API Error:", msg);
    // Hier könntest du auch eine Fehlermeldung auf der Webseite anzeigen
    // z.B. updateElementById('error_display_area', 'Ein Fehler ist aufgetreten: ' + msg);
};
</script>

<script type='text/javascript'>
    document.title = '$lfmstream - PanPlay'
</script>

<!-- ///// Get API Values -->

<!-- // Set Station-ID: -->
    <script>
    //lfmstation_id = "lfmstream";
    var lfmstation_id = '$lfmstream';
    //console.log('🎧 ' + lfmstation_id);</script>

<!-- // Grab Station-Infos: Set vars-->
    <script> 
    var lfmstation_location;
    var lfmstation_djs;
    var lfmstation_slogan;
    var lfmstation_genres;
    var lfmstation_livestat;
    var lfmstation_top_artists;
    var lfmstation_website_url;
    var lfmstation_display_name;
    var lfmstation_rang;
    var lfmstation_description;
    var lfmstation_listeners;
    var lfmstation_schedule;
    var lfmstation_next_artists;
    var lfmstation_current_song;
    var lfmstation_next_playlist;
    var lfmstation_current_artist_image;
    </script>
<!-- // Grab Station-Infos: ask lfm_api-->
<!--<script charset="utf-8">
        var show_schedule = function(schedule){
  var no_entry = 'Leider keine Sendung';
  var days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
  var days_buffer = {mon: [], tue: [], wed: [], thu: [], fri: [], sat: [], sun: []}; 
  Array.prototype.slice.call(schedule).forEach(function(schedule_entry) {
    var start_time = schedule_entry.hour;
    if (start_time < 10) { start_time = '0' + start_time }
    start_time = start_time + ':00 Uhr';
    days_buffer[schedule_entry.day].push('<span style="display: flex; padding-bottom:8px;">' + start_time + ' - ' + schedule_entry.name + '</span>');
  });
  Array.prototype.slice.call(days).forEach(function(schedule_days) {
    if (document.getElementById('api_lfm_schedule_' + schedule_days) !== null) {
      if (days_buffer[schedule_days].length >= 1) {
        document.getElementById('api_lfm_schedule_' + schedule_days).innerHTML = days_buffer[schedule_days].join('');
      } else {
        document.getElementById('api_lfm_schedule_' + schedule_days).innerHTML = no_entry;
      }
    }
  }); 
};
     </script> -->

     <script>
function updateElementById(id, content) {
  // Überprüfen, ob das Element existiert
  var element = document.getElementById(id);
  if (element) {
      element.innerHTML = content;
  } else {
      console.warn('⚠ Element with ID "' + id + '" not found, so we can not change the Content.');
      // errorHandler('⚠ Element with ID "' + id + '" not found, so we can not change the Content.')
  }
}
</script>
<script>
  var data = function(stationData) {
    // proofing website-url
    if (stationData.third_parties.website && stationData.third_parties.website.url) {
                                 var domain = stationData.third_parties.website.url.split('/')[2]; 
                               if (domain.includes('twitter.com') || domain.includes('x.com')) {
                                var domain =  "<a target='_blank' href='" + stationData.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/x/x-blackwhite.png' width='48px' height='auto' alt='" + stationData.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>"
                               } else if (domain.includes('facebook.com') || domain.includes('fb.me')) {
                                var domain =  "<a target='_blank' href='" + stationData.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/facebook/fb-color.png' width='48px' height='auto' alt='" + stationData.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>"
                                 } else if (domain.includes('instagram.com')) {
                                    var domain =   "<a target='_blank' href='" + stationData.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/instagramm/ig-color.png' width='48px' height='auto' alt='" + stationData.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>"
                                     } else if (domain.includes('laut.fm')) {
                                        var domain = "<a target='_blank' href='" + stationData.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='" + stationData.third_parties.website.url + "'></a>" 
                                } else { 
                                    var domain = "<a target='_blank' href='" + stationData.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/homepage_link/link-tealwhite.png' width='48px' height='auto' alt='" + stationData.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>"
                                 }
                             }
    // addhttps if needed
    function addHttpsIfNeeded(url, domain) {
    // Überprüfen, ob die URL leer oder undefined ist
    if (!url) {
        return '&nbsp;'; // Gebe einen leeren String zurück, wenn die URL leer ist
    }

    // Überprüfen, ob die URL bereits mit http:// oder https:// beginnt
    if (!url.startsWith('http://') && !url.startsWith('https://')) {
        // Wenn nicht, füge https:// hinzu
        url = 'https://' + url;
    }

    // Überprüfen, ob die Domain in der URL vorhanden ist
    if (!url.includes(domain + '/')) {
        // Wenn nicht, füge die Domain hinzu
        url = url.startsWith('https://') ? url.replace('://', '://' + domain + '/') : url;
    }

    return url;
}







if (stationData.third_parties.phonostar && stationData.third_parties.phonostar.url) {
    let phonostarUrl = addHttpsIfNeeded(stationData.third_parties.phonostar.url, 'phonostar.de');
    var phonostarlink = '';

    // Überprüfen, ob die Funktion eine gültige URL zurückgegeben hat
    if (phonostarUrl) {
        phonostarlink = "<a class='btn btn-block' style='width: 100%; color: red !important; background-color: white;' target='_blank' href='" + phonostarUrl + "'><img style='margin: 0.2em;' class='rounded' src='rscs/imglibs/misc/vendors/phonostar.svg' width='62px' height='auto' alt='Twitter'>*</a>";
    }

    // Überprüfen, ob twitterxlink einen gültigen Wert hat, bevor das Element aktualisiert wird

}
if (phonostarlink) {
        updateElementById('lfmlink_phonostar', phonostarlink); // 'twitterElementId' durch die tatsächliche ID des Elements ersetzen
}

if (stationData.third_parties.tunein && stationData.third_parties.tunein.url) {
    let tuneinUrl = addHttpsIfNeeded(stationData.third_parties.tunein.url, 'tunein.com');
    var tuneinlink = '';

    // Überprüfen, ob die Funktion eine gültige URL zurückgegeben hat
    if (tuneinUrl) {
        tuneinlink = "<a class='btn btn-block' style='width: 100%; color: white !important; background-color: #44475d;' target='_blank' href='" + tuneinUrl + "'><img style='margin: 0.2em;' class='rounded' src='rscs/imglibs/misc/vendors/tunein.png' width='48px' height='auto' alt='TuneIn'>*</a>";
    }

    // Überprüfen, ob twitterxlink einen gültigen Wert hat, bevor das Element aktualisiert wird

}
if (tuneinlink) {
        updateElementById('lfmlink_tunein', tuneinlink); // 'twitterElementId' durch die tatsächliche ID des Elements ersetzen
}

if (stationData.third_parties.radiode && stationData.third_parties.radiode.url) {
    let radiodeUrl = addHttpsIfNeeded(stationData.third_parties.radiode.url, 'radio.de');
    var radiodelink = '';

    // Überprüfen, ob die Funktion eine gültige URL zurückgegeben hat
    if (radiodeUrl) {
        radiodelink = "<a class='btn btn-block' style='width: 100%; color: #6af34a !important; background-color: #37393a;' target='_blank' href='" + radiodeUrl + "'><img style='margin: 0.2em;' class='rounded' src='rscs/imglibs/misc/vendors/radiode.svg' width='62px' height='auto' alt='Twitter'>*</a>";
    }

    // Überprüfen, ob twitterxlink einen gültigen Wert hat, bevor das Element aktualisiert wird

}
if (radiodelink) {
        updateElementById('lfmlink_radiode', radiodelink); // 'twitterElementId' durch die tatsächliche ID des Elements ersetzen
}

if (stationData.third_parties.twitter && stationData.third_parties.twitter.url) {
    let twitterUrl = addHttpsIfNeeded(stationData.third_parties.twitter.url, 'twitter.com');
    var twitterxlink = '';

    // Überprüfen, ob die Funktion eine gültige URL zurückgegeben hat
    if (twitterUrl) {
        twitterxlink = "<a target='_blank' href='" + twitterUrl + "'><img style='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/x/x-blackwhite.png' width='48px' height='auto' alt='Twitter'></a>";
    }

    // Überprüfen, ob twitterxlink einen gültigen Wert hat, bevor das Element aktualisiert wird

}
if (twitterxlink) {
        updateElementById('api_lfm_twitter_link', twitterxlink); // 'twitterElementId' durch die tatsächliche ID des Elements ersetzen
}



if (stationData.third_parties.facebook && stationData.third_parties.facebook.page) {
    let facebookUrl = addHttpsIfNeeded(stationData.third_parties.facebook.page, 'facebook.com');
    
    // Überprüfen, ob addHttpsIfNeeded einen gültigen Wert zurückgegeben hat
    if (facebookUrl) {
        var fb_link = "<a target='_blank' href='" + facebookUrl + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/facebook/fb-color.png' width='48px' height='auto' alt='Facebook'></a>";
        updateElementById('api_lfm_facebook_link', fb_link);
    } else {
        var fb_link = '';
    }
} else {
    var fb_link = '';
    updateElementById('api_lfm_facebook_link', fb_link);
}
if (stationData.third_parties.instagram && stationData.third_parties.instagram.name) {
    let instagramUrl = addHttpsIfNeeded(stationData.third_parties.instagram.name, 'instagram.com');
    
    // Überprüfen, ob addHttpsIfNeeded einen gültigen Wert zurückgegeben hat
    if (instagramUrl) {
        var ig_link = "<a target='_blank' href='" + instagramUrl + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/instagramm/ig-color.png' width='48px' height='auto' alt='Instagram'></a>";
        updateElementById('api_lfm_instagram_link', ig_link);
    } else {
        var ig_link = '';
    }
} else {
    var ig_link = '';
    updateElementById('api_lfm_instagram_link', ig_link);
}

    if (!domain) {
    updateElementById('api_lfm_website_link', '');
    if (typeof station_image_about___nolink !== 'undefined') {
        var station_image_about___nolink = "<img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' style='width: 70%; max-width: 320px;'>";
        updateElementById('stationlogoholder', station_image_about___nolink);
    } else {
        var station_image_about___nolink = "<img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' style='width: 70%; max-width: 320px;'>";
        updateElementById('stationlogoholder', station_image_about___nolink);
        //console.warn('station_image_about___nolink is undefined');
    }
} else {
    var station_image_about = "<a target='_blank' href='" + stationData.third_parties.website.url + "' alt ='" + stationData.display_name + "'><img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' style='width: 70%; max-width: 320px;'></a>";
    updateElementById('api_lfm_website_link', domain);
    if (typeof station_image_about !== 'undefined') {
        updateElementById('stationlogoholder', station_image_about);
    } else {
        //console.warn('station_image_about is undefined');
    }
}
  var description = '' + stationData.description;
  var display_name = stationData.display_name;
  var format = "<figure class='text-center'>  <blockquote class='blockquote'>   <b>" + stationData.format + "</b></blockquote></figure>";
  

  var station_image_navbar = "<img id ='current_station_img' src='" + stationData.images.station  + "' alt='" + stationData.display_name + "' width='30'>";
  //var currentPlaylist = 'Aktuelle Sendung: ' + stationData.started_at.humanTimeShort() + ' - ' + stationData.ends_at.humanTimeShort() + ' Uhr <br />Du H&ouml;rst: ' + stationData.name;

  var djs = "<span class='badge rounded-pill bg-primary text-dark'><i class='fas fa-compact-disc'></i> &nbsp;" + stationData.djs + "</span>";
  let station_genres_raw = stationData.genres;
var station_genres = "";
for (let i = 0; i < station_genres_raw.length; i++) {
            // Generiere die Badges
            station_genres += '<a style="text-decoration: none;" target="_blank" href="' + 'https://www.last.fm/tag/' + station_genres_raw[i] + '"  class="badge rounded-pill bg-primary text-dark"><i class="fas fa-guitar"></i> &nbsp;' + station_genres_raw[i] + '</a> ';
        }
let station_top_artists_raw = stationData.top_artists;
var station_top_artists = "";
for (let i = 0; i < station_top_artists_raw.length; i++) {
            // Generiere die Badges
            station_top_artists += '<a style="text-decoration: none;" target="_blank" href="' + 'https://www.last.fm/music/' + station_top_artists_raw[i] + '" class="badge rounded-pill bg-primary text-dark"><i class="fas fa-user-tie"></i> &nbsp;' + station_top_artists_raw[i] + '</a> ';
        }

var station_location = '<a style="text-decoration: none;" target="_blank" href="' + 'https://www.google.com/maps/search/?api=1&query=' + stationData.lat + ',' + stationData.lng + '" class=" badge rounded-pill bg-primary text-dark btn-link"><i class="fas fa-map-marker"></i> &nbsp;' + stationData.location + '</a>'

console.log(stationData.current_playlist.name);
var currentPlaylist = stationData.current_playlist.name;

    document.title = display_name + ' - PanPlay';
  updateElementById('api_lfm_description', description);
  updateElementById('api_lfm_display_name', display_name);
  updateElementById('aboutModaltitleLabel', display_name);
  updateElementById('lfmdisplaynamelabelcontainer', display_name);
  updateElementById('api_lfm_format', format);
  updateElementById('api_lfm_djs', djs);
  updateElementById('api_lfm_location', station_location);
 updateElementById('api_lfm_genres', station_genres);
 updateElementById('api_lfm_top_artists', station_top_artists);

  updateElementById('api_lfm_station_img_nav', station_image_navbar);

  // updateElementById('triggerhappy', station_image_navbar);

  
updateElementById('api_lfm_current_playlists', currentPlaylist);
};
laut.fm.station('$lfmstream').info(data, true);

///////////////////////////// Now Trackhistory

// Definiere globale Variablen für die aktuellen Songinformationen
var currentSongTitle = "";
var currentArtistName = "";
var currentAlbumTitle = "";
var currentAlbumArtUrl = "";

var historyData = function(lastSongs) {
  var currentSong = lastSongs[0].artist.name + ' - ' + lastSongs[0].title;
  var currentSong_title = lastSongs[0].title;
  var currentSong_artist = lastSongs[0].artist.name;
  var currentSong_album = lastSongs[0].album;
  var currentSong_genre = lastSongs[0].genre;
  var currentSong_length_raw = lastSongs[0].length;
        var minutes = Math.floor(currentSong_length_raw / 60);
        var seconds = currentSong_length_raw % 60;
        var currentSong_length = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
  var currentSong_image = lastSongs[0].artist.image;
  var currentSong_background = lastSongs[0].artist.image;
  var currentSong_thumb = lastSongs[0].artist.thumb;
  currentSongTitle = lastSongs[0].title;
currentArtistName = lastSongs[0].artist.name;
currentAlbumTitle = lastSongs[0].album;


  var trackHistory = '';
  for (i = 1; i < 10; i++) {
   // trackHistory = trackHistory + '<p>' + lastSongs[i].started_at.humanTimeLong() + ' - ' + lastSongs[i].ends_at.humanTimeLong() + ' Uhr <br />' + lastSongs[i].artist.name + ' - ' + lastSongs[i].title + '<br /></p>';


    trackHistory = trackHistory + "<a target=\"_blank\" href=\"https://www.last.fm/search/tracks?q="+ lastSongs[i].artist.name + " - " + lastSongs[i].title + "\" style=\"background-color: transparent;\" class=\"list-group-item list-group-item-action \"><div class=\"d-flex w-100\"><small class=\"listboxstatebadge\" style=\"margin-right: 10px;\" >" + lastSongs[i].started_at.humanTimeLong() + "</small><p class=\"mb-1\"> <i class=\"fas fa-music\"></i>  " + lastSongs[i].artist.name + " - " + lastSongs[i].title + "</p></div></a>";
  }


  var template_currentsong_lbl_holder_PART1 = "<br><div id='currentsong_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: pointer;' class='h3 d-flex justify-content-center text-container'> <span id='currentsong_lbl_holder' class='oop_title_label_meta oop_title_label_meta--song oop_title_label_meta--scroll text-center' data-bs-toggle='tooltip' data-bs-placement='top' title='"

  if (currentSong_album) {
    // Mache etwas mit currentSong_album
    var template_currentsong_lbl_holder = template_currentsong_lbl_holder_PART1 + currentSong_artist + " - " + currentSong_title + "'>" + currentSong_artist + " - " + currentSong_title + "</span><div class='fader fader-left'></div><div class='fader fader-right'></div></div> <div id='currentalbum_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: pointer;' class='h5 d-flex justify-content-center text-truncate'><span id='currentalbum_lbl_holder' data-bs-toggle='tooltip' data-bs-placement='top' title='" + currentSong_artist + " - " + currentSong_title + "' class='text-center' bs-toggle='tooltip' data-bs-placement='top' title='" + currentSong_album + "'>" + currentSong_album + "</span></div>";
    //var template_currentsong_lastplayed_modal_lbl_holder = currentSong_artist + " - " + currentSong_title + "<br><small>" + currentSong_album + "</small>";
    var template_currentsong_lastplayed_modal_lbl_holder = "<a target=\"_blank\" href=\"https://www.last.fm/search/tracks?q="+ currentSong_artist + " - " + currentSong_title + "\" style=\"background-color: #48527f;\" class=\"list-group-item list-group-item-action \"><b><div class=\"d-flex w-100\"><small class=\"listboxstatebadge\" style=\"margin-right: 10px;\" ><span class=\"badge bg-danger\">LIVE</span></small><p class=\"mb-1\"> <i class=\"fas fa-music\"></i>  " + currentSong_artist + " - " + currentSong_title + "<br><small>" + currentSong_album + "</small></p></div></b></a>";
} else {
    // Mache etwas, wenn currentSong_album keinen gültigen Wert hat
    var template_currentsong_lbl_holder = template_currentsong_lbl_holder_PART1 + currentSong_artist + " - " + currentSong_title + "'>" + currentSong_artist + " - " + currentSong_title + "</span><div class='fader fader-left'></div><div class='fader fader-right'></div></div> ";
    var template_currentsong_lastplayed_modal_lbl_holder = "<a target=\"_blank\" href=\"https://www.last.fm/search/tracks?q="+ currentSong_artist + " - " + currentSong_title + "\" style=\"background-color: #48527f;\" class=\"list-group-item list-group-item-action \"><b><div class=\"d-flex w-100\"><small class=\"listboxstatebadge\" style=\"margin-right: 10px;\" ><span class=\"badge bg-danger\">LIVE</span></small><p class=\"mb-1\"> <i class=\"fas fa-music\"></i>  " + currentSong_artist + " - " + currentSong_title + "</p></div></b></a>";
}

if (currentSong_album) {
    // Mache etwas mit currentSong_album
    var current_song_modal_album = "💿 <b>" + currentSong_album + "</b>"; //currentalbum_lbl;
} else {
    // Mache etwas, wenn currentSong_album keinen gültigen Wert hat
    var current_song_modal_album = "";
}

if (currentSong_genre) {
    // Mache etwas mit currentSong_album
    var current_song_modal_genre = "💿 <b>" + currentSong_genre +  "</b>"; //currentalbum_lbl;
} else {
    // Mache etwas, wenn currentSong_album keinen gültigen Wert hat
    var current_song_modal_genre = "";
}



// BILDER


if (currentSong_image) {
    var lfm_images = currentSong_image;
    var currentAlbumArtUrl = currentSong_image;
    var lfm_images_bg = currentSong_background;
    var alt_txt = currentSong;
    var current_song_modal_img = lfm_images

} else {
    var lfm_images = "https://api.laut.fm/station/{$lfmstream}/images/station";
    var currentAlbumArtUrl = "https://api.laut.fm/station/{$lfmstream}/images/station";
    //var lfm_images_bg = "engine/extensions/laut/lautbg.png";
    var lfm_images_bg = "https://api.laut.fm/station/{$lfmstream}/images/station";
    var alt_txt = currentSong;
    var current_song_modal_img = "rscs/imglibs/misc/music/audionote.png"
}

if (currentSong_image) {
    var currentAlbumArtUrl = currentSong_image;
} else {
    var currentAlbumArtUrl = "https://api.laut.fm/station/{$lfmstream}/images/station";
}
//console.log('Aktuelle Albumkunst URL:', currentAlbumArtUrl);


var songcover_template = "<img id='songcover' class='pp_songcover mx-auto d-block img-fluid' src='" + lfm_images + "' alt='" + alt_txt + "'>";
var current_song_modal_img_html = "<img id='songcover' class='mx-auto d-block img-fluid' src='" + current_song_modal_img + "' style='width: 100%; max-width: 512px; max-height: 512px; min-width: 48px; min-height: 48px; height: auto; cursor: pointer;' alt='" + alt_txt + "'>";
var bg_template = lfm_images_bg;
var bg_template_css = "<style>body{ background-image: url('" + bg_template + "') !important;</style>";

try {
        if ('mediaSession' in navigator) {
            // Metadaten für das aktuell abgespielte Medium erstellen
            var mediaMetadata = new MediaMetadata({
                title: currentSong_title,
                artist: currentSong_artist,
                album: currentSong_album,
                artwork: [
                    { src: lfm_images, sizes: '96x96', type: 'image/jpg' },
                    { src: lfm_images, sizes: '512x512', type: 'image/jpg' },
                    { src: lfm_images, sizes: '256x256', type: 'image/jpg' },
                    { src: lfm_images, sizes: '128x128', type: 'image/jpg' }
                ]
            });

            // Setze die Metadaten für die Media Session
            navigator.mediaSession.metadata = mediaMetadata;

            // Konsolenausgabe zur Überprüfung der aktuellen Werte

        } else {
            console.warn('First Media Session wird nicht unterstützt.');
        }
    } catch (error) {
        console.error('Fehler beim Setzen der First Metadaten:', error);
    }




updateElementById('api_lfm_current_song_live_img', songcover_template);
updateElementById('current_song_modal_songcovercontainer', songcover_template);
updateElementById('bgscriptcssholder', bg_template_css);
updateElementById('api_lfm_current_song3', template_currentsong_lbl_holder);
updateElementById('currentsong_modal_title', currentSong);
updateElementById('currentsong_modal_titel_lbl', currentSongTitle);
updateElementById('currentsong_scrobbler_titel_lbl', currentSongTitle);
updateElementById('currentsong_modal_interpret_lbl', currentSong_artist);
updateElementById('currentsong_scrobbler_interpret_lbl', currentSong_artist);
updateElementById('currentsong_lastplayed_modal_lbl_holder', template_currentsong_lastplayed_modal_lbl_holder);
updateElementById('api_lfm_last_x_songs_spezial', trackHistory);
updateElementById('currentsong_modal_album_lbl', current_song_modal_album);
updateElementById('currentsong_modal_length_lbl', "🕖 " + currentSong_length);

//updateElementById('currentplaylist_modal_title_lbl', currentPlaylist);

};




//updateElementById('api_lfm_song_live', "<span class='badge bg-danger text-white' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-info-circle'></i> LIVE</span>");

laut.fm.station('$lfmstream').last_songs(historyData, true);

// --- NEU: Deklariere currentPlaylist hier global, ganz am Anfang deiner Skripte ---
var livedata;


// Funktion für die erweiterte LBN-Logik (prüft NUR auf '[LIVE]' im globalen Playlistnamen)
function handleLiveLabelWithLbnCheck() { 
    console.log("handleLiveLabelWithLbnCheck aufgerufen.");
    console.log("Aktuelle globale currentPlaylist (vor Bereinigung):", currentPlaylist); // Debug-Ausgabe

    if (currentPlaylist && currentPlaylist.includes('[LIVE]')) {
        console.log("[LIVE] im Playlistnamen gefunden!");
        
        // --- NEU: "[LIVE]" aus dem Sendungstitel entfernen ---
        // Erstelle eine bereinigte Version des Playlistnamens
        let cleanedPlaylistName = currentPlaylist.replace('[LIVE]', '').trim();
        
        // Überprüfe, ob nach der Entfernung noch Leerzeichen am Ende sind
        if (cleanedPlaylistName.endsWith('')) { // Dies prüft auf ein abschließendes Leerzeichen
             // Optional: Entferne ein einzelnes Leerzeichen am Ende, wenn der Titel damit endet
            if (cleanedPlaylistName.length > 0 && cleanedPlaylistName.charAt(cleanedPlaylistName.length - 1) === ' ') {
                cleanedPlaylistName = cleanedPlaylistName.slice(0, -1);
            }
        }
        
        // Aktualisiere das Element mit dem bereinigten Titel
        updateElementById('api_lfm_current_playlists', cleanedPlaylistName);
        
        // Zeige das LIVE-Label an (wie bisher)
        updateElementById('api_lfm_song_live', "<span class='badge bg-danger text-white' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-wifi'></i> LIVE</span>");
    } else {
        console.log("[LIVE] im Playlistnamen NICHT gefunden oder currentPlaylist ist null/undefined.");
        // Wenn [LIVE] nicht gefunden wurde, soll der Originaltitel bleiben und das LIVE-Label nicht angezeigt werden.
        // Stelle sicher, dass der Originaltitel angezeigt wird (falls er zuvor geändert wurde).
        updateElementById('api_lfm_current_playlists', currentPlaylist); // Den Originaltitel wiederherstellen/setzen
        updateElementById('api_lfm_song_live', '');
    }
}

// Funktion für die Standard-Logik (prüft NUR auf livedata.live)
function handleLiveLabelDefault(response) { 
    if (response && response.live === true) { 
        updateElementById('api_lfm_song_live', "<span class='badge bg-danger text-white' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-fa-wifi'></i> LIVE</span>");
    } else {
        updateElementById('api_lfm_song_live', '');
    }
}

laut.fm.station('$lfmstream').last_songs(historyData, true);

// --- WICHTIG: Die 'data'-Funktion muss 'currentPlaylist' global befüllen ---
var data = function(stationData) {
    // ... (restlicher Code deiner data-Funktion) ...

    // Finde diese Zeile in deiner data-Funktion und stelle sicher, dass sie currentPlaylist global setzt:
    currentPlaylist = stationData.current_playlist.name; // Zuweisung zur GLOBALEN Variable
    
    // ... (restlicher Code deiner data-Funktion) ...
};
laut.fm.station('$lfmstream').info(data, true);


// Der Hauptteil für die Live-Anzeige
laut.fm.station('$lfmstream').current_song(function(response) {
    livedata = response; 

    if (!livedata) {
        updateElementById('api_lfm_song_live', '');
        return; 
    }

    if (isLbnActive === true) {
        console.log('lfmlbn is true (LBN-Modus aktiv)');
        handleLiveLabelWithLbnCheck(); 
    } else {
        console.log('lfmlbn is false (Standard-Modus aktiv)');
        handleLiveLabelDefault(livedata); 
    }
}, true);


    
/////////// MediaMetadata-JS:

function setupMetadataAndTitleUpdate() {
s_currentAlbumArtUrl = currentAlbumArtUrl

    // Funktion zum Auslesen des aktuellen Interpreten, Titels und Albumtitels aus der Oberfläche
    function getCurrentSongInfoFromUI() {
        var currentSongLabel = document.getElementById('currentsong_lbl');
        var currentAlbumLabel = document.getElementById('currentalbum_lbl');

        if (currentSongLabel) {
            var labelsContent = currentSongLabel.innerText;
            var labelsArray = labelsContent.split(' - ');
            currentArtistName = labelsArray.length > 1 ? labelsArray[0] : "$lfmstream";
            currentSongTitle = labelsArray.length > 1 ? labelsArray[1] : "Unbekannter Titel";
        }

        if (currentAlbumLabel) {
            currentAlbumTitle = currentAlbumLabel.innerText || "PanPlay";
        }

        // Rufe updateMediaMetadata auf, um die Metadaten zu aktualisieren
        //updateMediaMetadata(currentSongTitle, currentArtistName, currentAlbumTitle, s_currentAlbumArtUrl);
    }



    // Funktion zur Aktualisierung des Title-Tags und der Metadaten
    function updateTitleAndMetadata() {
        try {
            var currentSongLbl = document.getElementById('currentsong_lbl');
            if (currentSongLbl) {
                var songInfo = currentSongLbl.innerText.trim();
                // Hier ist der Wert korrekt
                //console.log('Song Info:', songInfo);

                // Aktualisiere die Metadaten mit aktuellen Werten
                //updateMediaMetadata(currentSongTitle, currentArtistName, currentAlbumTitle, currentAlbumArtUrl);

                // Titel-Tag der Webseite aktualisieren
                document.title = songInfo + ` - PanPlay`;
            }
        } catch (error) {
            console.error('JavaScript-Fehler im Titel-Update-Teil:', error);
        }
    }

    // Starte die Aktualisierung des Titels und der Metadaten alle 5 Sekunden
    setInterval(updateTitleAndMetadata, 10000);

    // Führe die Funktion updateTitleAndMetadata direkt nach dem Laden der Seite aus
    window.addEventListener('load', function() {
        setTimeout(updateTitleAndMetadata, 10000);
    });

    // Führe getCurrentSongInfoFromUI beim Laden der Seite aus, um die initialen Metadaten zu setzen
    window.addEventListener('load', getCurrentSongInfoFromUI);

    // Führe die Funktion getCurrentSongInfoFromUI alle 2 Minuten aus, um die Metadaten zu aktualisieren
    setInterval(getCurrentSongInfoFromUI, 2 * 60 * 1000); // 2 Minuten in Millisekunden
}

// Rufe die Funktion setupMetadataAndTitleUpdate auf, um die Metadaten- und Titelaktualisierung zu starten
setupMetadataAndTitleUpdate();


// Aktuellen Wochentag erhalten (0 = Sonntag, 1 = Montag, usw.)
const today = new Date().getDay();

// ID des Tabs für den aktuellen Wochentag
const tabId = '#' + ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][today] + '-tab';
const tabContentId = '#' + ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][today];

// Den aktuellen Wochentag aktivieren
const currentTab = document.querySelector(tabId);
currentTab.classList.add('show', 'active');

// Den zugehörigen Inhalt anzeigen und "(Heute)" hinzufügen, wenn es der aktuelle Tag ist
document.querySelector(tabContentId).classList.add('show', 'active');
const heading = document.querySelector(tabContentId).querySelector('h5');
heading.textContent += ' ({$ext_lang["today"]})';

            var show_schedule = function(schedule){
              var no_entry = '{$ext_lang["nospecialshow"]}';
              var days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
              var days_buffer = {mon: [], tue: [], wed: [], thu: [], fri: [], sat: [], sun: []}; 
              Array.prototype.slice.call(schedule).forEach(function(schedule_entry) {
                var start_time = schedule_entry.hour;
                if (start_time < 10) { start_time = "0" + start_time; }
                start_time = start_time + ":00  {$lang['uhr']}";
                days_buffer[schedule_entry.day].push("<a href=\"#\" style=\"background-color: transparent;\" class=\"list-group-item list-group-item-action \"><div class=\"d-flex w-100 justify-content-between\"><p class=\"mb-1\"><span style=\"font-size: 1em; color:" + schedule_entry.color + ";\">■</span> " + schedule_entry.name + "</p><small class=\"listboxstatebadge\">" + start_time + "</small></div></a>");
               // here with description for all shows days_buffer[schedule_entry.day].push("<a href=\"#\" class=\"list-group-item list-group-item-action bg-dark\"><div class=\"d-flex w-100 justify-content-between\"><h5 class=\"mb-1\">" + schedule_entry.name + "</h5><small class=\"text-muted\">" + start_time + "</small></div><p class=\"mb-1\">" + schedule_entry.description + "</p></a>");
              });
              Array.prototype.slice.call(days).forEach(function(schedule_days) {
                if (document.getElementById("api_lfm_schedule_" + schedule_days) !== null) {
                  if (days_buffer[schedule_days].length >= 1) {
                    document.getElementById("api_lfm_schedule_" + schedule_days).innerHTML = days_buffer[schedule_days].join("");
                  } else {
                    document.getElementById("api_lfm_schedule_" + schedule_days).innerHTML = no_entry;
                  }
                }
              }); 
            };
            laut.fm.station("{$lfmstream}").schedule(show_schedule);


</script>

 


HTML;
echo $lfmapiloader_content;

?>