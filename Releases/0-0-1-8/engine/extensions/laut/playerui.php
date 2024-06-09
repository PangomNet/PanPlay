<?php
echo <<<HTML
<oop_div id='oolfm_currentshow' class='d-flex justify-content-center'>
<!-- Wenn lfmstream einen Wert hat, wird der Code ausgeführt -->
HTML;
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
if (!empty($lfmstream)):
echo <<<HTML
<div id='api_lfm_current_playlists' data-bs-toggle='modal' data-bs-target='#sendeplan_modal' style='cursor: hand;'>Loading...</div>
<script type='text/html' id='current_playlists_template' charset='utf-8'>
<%= '' + this.current_playlist.name %>
</script>
<script type='text/javascript' charset='utf-8'>
laut.fm.station('$lfmstream')
.info({container:'api_lfm_current_playlists', template:'current_playlists_template'}, true);
</script>
&nbsp;<div id="api_lfm_song_live">Loading...</div>
    <script type="text/html" id="api_lfm_song_live_template" charset="utf-8">
<% if (this.live)  { %>
<%= "  <span class='badge bg-danger text-white' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-info-circle'></i> LIVE</span>" %>
<% } else { %>
<%= "" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('$lfmstream')
.current_song({container:'api_lfm_song_live', template:'api_lfm_song_live_template'}, true);
</script>
HTML;
endif;
echo "</oop_div> <br>";

echo <<<HTML
<oop_div id='oolfm_songcover'>
<!-- Nur einbinden, wenn lfmstream Inhalt hat -->
HTML;
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
if (!empty($lfmstream)) {
    echo <<<HTML
    <div id="api_lfm_current_song_live_img">Loading...</div>
    <script type="text/html" id="current_song_live_img_template" charset="utf-8">
        <% 
        if (this.artist.image) {
            var lfm_images = this.artist.image;
            var lfm_images_bg = this.artist.image;
            var alt_txt = "Artistcover";
        } else {
            var lfm_images = "https://api.laut.fm/station/{$lfmstream}/images/station";
            var lfm_images_bg = "engine/extensions/laut/lautbg.png";
            var alt_txt = "🎵 Musikcover";
        } 
        %>
        <%= "<img id='songcover' class='mx-auto d-block img-fluid' src='" + lfm_images + "' style='width: 30em; max-width: 55%; max-height: 65%; min-width: 70px; min-height: 70px; height: auto; cursor: hand;' alt='" + alt_txt + "'>" + "<style> body{ background-image: url('" + lfm_images_bg + "'); }</style>" %>
    </script> 
    <script type="text/javascript" charset="utf-8">
        laut.fm.station('$lfmstream')
        .current_song({container:'api_lfm_current_song_live_img', template:'current_song_live_img_template'}, true);
</script> 
    <script type="text/javascript" charset="utf-8">
// Funktion zum Aktualisieren des Interpretenbildes basierend auf dem aktuellen Song
function updateCurrentAlbumArtFromAPI() {
    // Rufe die getCurrentSong-Funktion der API auf, um Informationen zum aktuellen Song zu erhalten
    laut.fm.station('$lfmstream').current_song(function(result) {
        // Überprüfe, ob ein Bild für den aktuellen Interpreten vorhanden ist
        if (result.artist && result.artist.image) {
            // Speichere die URL des Interpretenbildes in currentAlbumArtUrl
            currentAlbumArtUrl = result.artist.image;
        } else {
            // Verwende ein Standardbild, wenn kein Bild für den Interpreten vorhanden ist
            currentAlbumArtUrl = "https://api.laut.fm/station/{$lfmstream}/images/station";
        }
    });
}

updateCurrentAlbumArtFromAPI();

// Führe die Funktion updateCurrentAlbumArtFromAPI alle 10 Sekunden aus
setInterval(updateCurrentAlbumArtFromAPI, 10000);

// Führe die Funktion updateCurrentAlbumArtFromAPI auch unmittelbar nach dem Laden der Seite aus
window.addEventListener('load', updateCurrentAlbumArtFromAPI);

    </script>
HTML;
}
echo "</oop_div>";

echo <<<HTML

<style>
    #currentsong_lbl_holder,
#currentalbum_lbl_holder {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
    </style>
<oop_div id='oolfm_current_song' style='width: 100%;' class='d-flex justify-content-center'>
<!-- Wenn lfmstream einen Wert hat, wird der Code ausgeführt -->
HTML;
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
if (!empty($lfmstream)):
echo <<<HTML
<div id='api_lfm_current_song3' style='width: 100%;' class=''>Loading...</div>
<script type="text/html" id="current_song_template3" charset="utf-8">
<% if (this.album) { %>
<%= "<br><div id='currentsong_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: hand;' class='h3 d-flex justify-content-center text-container'><span id='currentsong_lbl_holder' class='oop_title_label_meta oop_title_label_meta--song oop_title_label_meta--scroll text-center' data-bs-toggle='tooltip' data-bs-placement='top' title='" + this.artist.name + " - " + this.title + "'>" + this.artist.name + " - " + this.title + "</span><div class='fader fader-left'></div><div class='fader fader-right'></div></div>
<div id='currentalbum_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: hand;' class='h5 d-flex justify-content-center text-truncate'><span id='currentalbum_lbl_holder' data-bs-toggle='tooltip' data-bs-placement='top' title='" + this.album + "' class='text-center' bs-toggle='tooltip' data-bs-placement='top' title='" + this.album + "'>" + this.album + "</span></div>"%>
<% } else { %>
<%= "<br><div id='currentsong_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: hand;' class='h3 d-flex justify-content-center text-container'><span id='currentsong_lbl_holder' class='text-center oop_title_label_meta oop_title_label_meta--song oop_title_label_meta--scroll' data-bs-toggle='tooltip' data-bs-placement='top' title='" + this.artist.name + " - " + this.title + "'>" + this.artist.name + " - " + this.title + "<span></div>"%>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('$lfmstream')
.current_song({container:'api_lfm_current_song3', template:'current_song_template3'}, true);


</script>
HTML;
endif;
echo "</oop_div>";

// echo '<script>alert("DEBUG: Inetgration laut-playerui ✔ /n Continue")</script>'; 
?>