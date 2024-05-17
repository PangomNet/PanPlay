<?php
echo <<<HTML

<oop_div id='ooweb_songcover'>

<img id="songcover" class="mx-auto d-block img-fluid" src="engine/extensions/baseaudio/placeholder-cover.png" style="width: 30em; max-width: 65%; max-height: 65%; min-width: 70px; min-height: 70px; height: auto; cursor: hand;" alt="oOPlayer">
<style>
 body{ background-image: url('engine/extensions/baseaudio/bg.png'); }
</style>

    <script type="text/javascript" charset="utf-8">
 // Funktion zum Aktualisieren des Interpretenbildes basierend auf dem aktuellen Song
function updateCurrentAlbumArtFromAPI() {
        // Verwende ein Standardbild, wenn kein Bild für den Interpreten vorhanden ist
        currentAlbumArtUrl = "engine/extensions/baseaudio/placeholder-cover.png";
    };

updateCurrentAlbumArtFromAPI();

// Rufe die Funktion updateCurrentAlbumArtFromAPI auf, um das Interpretenbild basierend auf dem aktuellen Song zu aktualisieren

    </script>
HTML;

echo "</oop_div><br>";

echo <<<HTML

<style>
    #currentsong_lbl_holder,
#currentalbum_lbl_holder {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
    </style>
<oop_div id='ooweb_current_song' style='width: 100%;' class='d-flex justify-content-center'>
<!-- Wenn lfmstream einen Wert hat, wird der Code ausgeführt -->
HTML;

echo "<br><div id='currentsong_lbl' data-bs-toggle='modal' data-bs-target='#lastplayed_modal' style='animation-delay: 3s; animation-duration: 6.875s; cursor: hand;' class='h3 d-flex justify-content-center text-container'><span id='currentsong_lbl_holder' class='text-center oop_title_label_meta oop_title_label_meta--song oop_title_label_meta--scroll' data-bs-toggle='tooltip' data-bs-placement='top' title='" . $webstream .  "'>" . $webstream . "<span></div>";

echo "</oop_div>";

// echo '<script>alert("DEBUG: Inetgration laut-playerui ✔ /n Continue")</script>'; 
?>