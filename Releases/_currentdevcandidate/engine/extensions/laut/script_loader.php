<?php
echo '<script type="text/javascript" src="//api.laut.fm/js_tools/lautfm_js_tools.0.10.0.js.min.js" ></script>';

$lfmapiloader_content = <<<HTML
<!-- ///// Get API Values -->

<!-- // Set Station-ID: -->
    <script>
    //lfmstation_id = "lfmstream";
    var lfmstation_id = '$lfmstream';
    console.log('🎧 ' + lfmstation_id);</script>

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
      console.warn('Element mit ID ' + id + ' nicht gefunden.');
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
        var station_image_about___nolink = "<img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' width='70%' max-width='350px'>";
        updateElementById('stationlogoholder', station_image_about___nolink);
    } else {
        var station_image_about___nolink = "<img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' width='70%' max-width='350px'>";
        updateElementById('stationlogoholder', station_image_about___nolink);
        //console.warn('station_image_about___nolink is undefined');
    }
} else {
    var station_image_about = "<a target='_blank' href='" + stationData.third_parties.website.url + "' alt ='" + stationData.display_name + "'><img id ='current_station_img_about' class='rounded' alt='" + stationData.display_name + "' src='" + stationData.images.station + "' width='70%' max-width='350px'></a>";
    updateElementById('api_lfm_website_link', domain);
    if (typeof station_image_about !== 'undefined') {
        updateElementById('stationlogoholder', station_image_about);
    } else {
        //console.warn('station_image_about is undefined');
    }
}
  var description = 'Beschreibung: ' + stationData.description;
  var display_name = stationData.display_name;
  var format = "<figure class='text-center'>  <blockquote class='blockquote'>   <b>" + stationData.format + "</b></blockquote></figure>";
  

  var station_image_navbar = "<img id ='current_station_img' src='" + stationData.images.station  + "' alt='" + stationData.display_name + "' width='30'>";
  //var currentPlaylist = 'Aktuelle Sendung: ' + stationData.started_at.humanTimeShort() + ' - ' + stationData.ends_at.humanTimeShort() + ' Uhr <br />Du H&ouml;rst: ' + stationData.name;

  updateElementById('api_lfm_description', description);
  updateElementById('api_lfm_display_name', display_name);
  updateElementById('aboutModaltitleLabel', display_name);
  updateElementById('api_lfm_format', format);

  updateElementById('api_lfm_station_img_nav', station_image_navbar);

  
  //updateElementById('api_lfm_current_playlists', currentPlaylist);
};
laut.fm.station('$lfmstream').info(data, true);





    
</script>
<!-- // Grab Station-Infos: filltemplates with api-infos
    <div id="api_lfm_location">Loading...</div>    
    <script type="text/html" id="location_template" charset="utf-8">
    <%= "Standort: " + this.location %>
    </script>
    <div id="api_lfm_djs">Loading...</div>
    <script type="text/html" id="djs_template" charset="utf-8">
    <%= "DJ's:" + this.djs %>
    </script>
    <div id="api_lfm_format">Loading...</div>
    <script type="text/html" id="format_template" charset="utf-8">
    <%= "Unser Slogan: " + this.format %>
    </script>
    <div id="api_lfm_genres">Loading...</div>
    <script type="text/html" id="genres_template" charset="utf-8">
    <%= "<p style='font-size:18px; font-weight:bold; margin-bottom:10px;'>Unsere Genres</p>" %>
    <% for (i=0; i<this.genres.length; i++) { %>
    <%= "&#187; " + this.genres[i] + "<br />" %>
    <% } %>
    </script>
    <div id="api_lfm_song_live">Loading...</div>
    <script type="text/html" id="api_lfm_song_live_template" charset="utf-8">
    <% if (this.live)  { %>
    <%= "Station ist live" %>
    <% } else { %>
    <%= "Station ist nicht live" %>
    <% } %>
    </script>
    <div id="api_lfm_top_artists">Loading...</div>
    <script type="text/html" id="top_artists_template" charset="utf-8">
    <%= "<p style='font-size:18px; font-weight:bold; margin-bottom:10px;'>Top-Artist:</p>" %>
    <% 
    for (i=0; i<this.top_artists.length; i++) { 
    var orang = i+1
    %>
    <%= "&#10149; " + orang + " - " + this.top_artists[i] + "<br />" %>
    <% } %>
    </script>
    <div id="api_lfm_website_link">Loading...</div>
    <script type="text/html" id="website_link_template" charset="utf-8">
    <%= "Website: <a target='_blank' href='" + this.third_parties.website.url + "'>" + this.third_parties.website.url + "</a>" %>
    </script>
    <div id="api_lfm_display_name">Loading...</div>
    <script type="text/html" id="display_name_template" charset="utf-8">
    <%= "Display-Name: " + this.display_name %>
    </script>
    <div id="api_lfm_position">Loading...</div>
    <script type="text/html" id="position_template" charset="utf-8">
    <%= "Aktueller Rang: " + this.position %>
    </script>
    <div id="api_lfm_description">Loading...</div>
    <script type="text/html" id="description_template" charset="utf-8">
    <%= "Beschreibung: " + this.description %>
    </script>
    <div id="api_lfm_listener1">Loading...</div>
    <script type="text/html" id="api_lfm_listener_template" charset="utf-8">
    <%= "H&ouml;rerzahl: " + this %>
    </script>
    <div id="api_lfm_next_artists">Loading..</div>
<script type="text/html" id="next_artists_template" charset="utf-8">
<%= "<p style='font-size:18px; font-weight:bold; margin-bottom:10px;'>Next Artists</p>" %>
<% for (i=0; i<this.length; i++) { %>
<%= "&#10149; " + this[i].artist.name + "<br />" %>
<% } %>
</script> 
<script type="text/javascript" charset="utf-8">
laut.fm.station('STATIONSNAME') 
.next_artists ({container:'api_lfm_next_artists', template:'next_artists_template'}, true);
</script>
<div id="api_lfm_current_song3">Loading...</div>
<script type="text/html" id="current_song_template3" charset="utf-8">
<% if (this.album) { %>
<%= "Aktuell l&auml;uft:<br />" + this.artist.name + " - " + this.title + "<br />Aus dem Album: " + this.album %>
<% } else { %>
<%= "Aktuell l&auml;uft:<br />" + this.artist.name + " - " + this.title%>
<% } %>
</script> 
<div id="api_lfm_next_playlists">Loading...</div>
<script type="text/html" id="next_playlists_template" charset="utf-8">
<%= "<b>N&auml;chste Sendung: </b>" + this.next_playlist.started_at.humanTimeShort() + " - " + this.next_playlist.ends_at.humanTimeShort() + " Uhr <br /> <b>Dann H&ouml;rst du: </b>" + this.next_playlist.name%>
</script>
<div id="api_lfm_current_playlists">Loading...</div>
<script type="text/html" id="current_playlists_template" charset="utf-8">
<%= "<b>Aktuelle Sendung: </b>" + this.current_playlist.started_at.humanTimeShort() + " - " + this.current_playlist.ends_at.humanTimeShort() + " Uhr <br /> <b>Du H&ouml;rst: </b>" + this.current_playlist.name %>
</script> 
<div id="api_lfm_current_song_img">Loading...</div>
<script type="text/html" id="current_song_img_template" charset="utf-8">
<% 
if (this.artist.image) {
var lfm_images = this.artist.image;
var alt_txt = "Images";
} else {
var lfm_images = "Ersatzbild.png";
var alt_txt = "No Images";
} 
%>
<%= "<img src='" + lfm_images + "' width='100' height='100' alt='" + alt_txt + "'>" %>
</script> 
<div id="api_lfm_last_x_songs_spezial">Loading...</div>
<script type="text/html" id="last_x_songs_spezial_template" charset="utf-8"> 
<%= "<b>Zuletzt lief</b>" %>
<% for (i=0; i < 10; i++) {
if (this[i].type == "song" || this[i].type == "news") {%>
<%= "<p>" + this[i].started_at.humanTimeLong() + " - " + this[i].ends_at.humanTimeLong() + " Uhr <br />" + this[i].artist.name + " - " + this[i].title + "<br /></p>" %>
<% } else { } }%>
</script>
<div id="api_lfm_twitter_link">Loading...</div>
<script type="text/html" id="twitter_link_template" charset="utf-8">
<%= "Instagram: <a target='_blank' href='https://instagram.com/" + this.third_parties.instagram.name + "'>" + "https://instagram.com/" + this.third_parties.instagram.name + "</a>" %>
</script>
<div id="api_lfm_twitter_link">Loading...</div>
<script type="text/html" id="twitter_link_template" charset="utf-8">
<%= "Twitter: <a target='_blank' href='" + this.third_parties.twitter.url + "'>" + this.third_parties.twitter.url + "</a>" %>
</script>
<div id="api_lfm_tunein_link">Loading...</div>
<script type="text/html" id="tunein_link_template" charset="utf-8">
<%= "TuneIn: <a target='_blank' href='" + this.third_parties.tunein.url + "'>" + this.third_parties.tunein.url + "</a>" %>
</script>
<div id="api_lfm_phonostar_link">Loading...</div>
<script type="text/html" id="phonostar_link_template" charset="utf-8">
<%= "Phonostar: <a target='_blank' href='" + this.third_parties.phonostar.url + "'>" + this.third_parties.phonostar.url + "</a>" %>
</script>
<div id="api_lfm_radiode_link">Loading...</div>
<script type="text/html" id="radiode_link_template" charset="utf-8">
<%= "Radio.de: <a target='_blank' href='" + this.third_parties.radiode.url + "'>" + this.third_parties.radiode.url + "</a>" %>
</script>

     <p style=font-weight:bold;>Sendeplan Montag:</p>
<div id="api_lfm_schedule_mon">Loading...</div>

<p style=font-weight:bold;>Sendeplan Dienstag:</p>
<div id="api_lfm_schedule_tue">Loading...</div>

<p style=font-weight:bold;>Sendeplan Mittwoch:</p>
<div id="api_lfm_schedule_wed">Loading...</div>

<p style=font-weight:bold;>Sendeplan Donnerstag:</p>
<div id="api_lfm_schedule_thu">Loading...</div>

<p style=font-weight:bold;>Sendeplan Freitag:</p>
<div id="api_lfm_schedule_fri">Loading...</div>

<p style=font-weight:bold;>Sendeplan Samstag:</p>
<div id="api_lfm_schedule_sat">Loading...</div>

<p style=font-weight:bold;>Sendeplan Sonntag:</p>
<div id="api_lfm_schedule_sun">Loading...</div> -->

HTML;
echo $lfmapiloader_content;

?>