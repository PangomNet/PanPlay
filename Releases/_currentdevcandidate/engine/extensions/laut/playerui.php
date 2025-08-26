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
<oop_div id='oolfm_songcover'>
<a class="link-underline-opacity-0" href="#"onclick="playPause()" >
<!-- Nur einbinden, wenn lfmstream Inhalt hat -->
HTML;
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
if (!empty($lfmstream)) {
    echo <<<HTML
    <div id="api_lfm_current_song_live_img"></div></a>
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