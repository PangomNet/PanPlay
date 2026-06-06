<?php
echo <<<HTML
<oop_div id='oolfm_currentshow' class='d-flex justify-content-center'>
<!-- Wenn lfmstream einen Wert hat, wird der Code ausgeführt -->
HTML;
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
if (!empty($lfmstream)):
echo <<<HTML
<div id='api_lfm_current_playlists' data-bs-toggle='modal' data-bs-target='#sendeplan_modal' style='cursor: pointer;'></div>
<script type='text/html' id='current_playlists_template' charset='utf-8'>
<%= '' + this.current_playlist.name %>
</script>
<!-- <script type='text/javascript' charset='utf-8'>
laut.fm.station('$lfmstream')
.info({container:'api_lfm_current_playlists', template:'current_playlists_template'}, true);
</script> -->
&nbsp;<div id="api_lfm_song_live"></div>
    <script type="text/html" id="api_lfm_song_live_template" charset="utf-8">
<% if (this.live)  { %>
<%= "  <span class='badge bg-danger text-white' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-wifi'></i> LIVE</span>" %>
<% } else { %>
<%= "" %>
<% } %>
</script>
<!--<script type="text/javascript" charset="utf-8">
laut.fm.station('$lfmstream')
.current_song({container:'api_lfm_song_live', template:'api_lfm_song_live_template'}, true);
</script>-->
HTML;
endif;
echo "</oop_div> <br>";






echo <<<HTML
<style>
    /* Der Wrapper umschließt NUR das Bild */
    .play-pause-wrapper {
        border-radius: 8px;
        overflow: hidden;
        line-height: 0;
        display: inline-block;
        position: relative;
        vertical-align: middle; /* Verhindert das Verschieben der Textzeilen */
        cursor: pointer;
        
    }

    /* Das Overlay */
    .pp-cover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Etwas dunkler für besseren Kontrast */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 10;
    }

    .play-pause-wrapper:hover .pp-cover-overlay {
        opacity: 1;
    }

    .pp-cover-overlay i {
        color: white;
        font-size: 3.5rem; /* Etwas größer für den YouTube-Look */
        filter: drop-shadow(0 0 10px rgba(0,0,0,0.8));
    }
</style>

<div id='oolfm_songcover' class='text-center w-100 mb-3'>
    <div class="play-pause-wrapper" onclick="playPause()">
        <div id="api_lfm_current_song_live_img"></div>
        
        <div id="pp-overlay-layer" class="pp-cover-overlay">
            <i id="pp-overlay-icon" class="fas fa-play"></i>
        </div>
    </div>
</div>
HTML;

echo <<<HTML

<style>
    #currentsong_lbl_holder,
#currentalbum_lbl_holder {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
    </style>
    <div id="bgscriptcssholder">

</div>

    
<oop_div id='oolfm_current_song' style='width: 100%;' class='d-flex justify-content-center'>
<!-- Wenn lfmstream einen Wert hat, wird der Code ausgeführt -->
HTML;

echo <<<HTML
<div id='api_lfm_current_song3' style='width: 100%;'></div>
<span id="currentsong_scrobbler_titel_lbl" hidden >Untitled</span>
    <span id="currentsong_scrobbler_interpret_lbl" hidden >Various</span>

<!--<script type="text/javascript" charset="utf-8">
laut.fm.station('$lfmstream')
.current_song({container:'api_lfm_current_song3', template:'current_song_template3'}, true);


</script> 

<i> Comin Soon: "Rich-Content"!</i>-->
HTML;

echo "</oop_div>";

// echo '<script>alert("DEBUG: Inetgration laut-playerui ✔ /n Continue")</script>'; 

if ($sendeplan !== true) {
    echo "<style> #api_lfm_current_playlists {display: none;}</style>";
  }

?>