<!----------------------------------------------- LOADING BAISC DEPENDENCIES ------------------------------------->
<!----------------------------------------------- COMPAT-CHECK ------------------------------------->
<?php require('../../src/assets/compatcheck.php');?>
<!--------------------------------------------------- SUBDOMAIN CHECK ------------------------------------>
<?php require('../../src/assets/subdomaincheck.php');?>
<!----------------------------------------------- CENTRALERRORLOG ------------------------------------->
<?php require('../../src/assets/centralerrorlog.php');?>
<!----------------------------------------------- OFLINEHANDLER ------------------------------------->
<?php require('../../src/assets/offlinehandler.php');?>







<!----------------------------------------------- PLAYER-PAGE-BASE ------------------------------------->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../../../src/css/styles.css">
<link rel="stylesheet" href="../../../../src/css/conveyor.css">
    <title>oOPlay - Player</title>
<!----------------------------------------------- UITHEMEHANDLER ------------------------------------->
<?php require('../../src/assets/uithemehandler.php');?>

<!--- ICONLIBLOADER ------->
<!-- Füge ein unsichtbares iframe-Element hinzu, das die iconlibloader.php-Datei aufruft -->
<iframe id="iconlibloaderFrame" src="../../../../src/css/iconlibloader.php" style="display:none;"></iframe>

<!-- Füge ein Skript hinzu, das überprüft, ob die CSS-Datei generiert wurde und sie dann automatisch als CSS einbindet -->
<script>
    // Überprüfe, ob die CSS-Datei generiert wurde
    var checkInterval = setInterval(function() {
        if (document.getElementById('iconlibloaderFrame').contentDocument.body.innerText === 'Font Awesome CSS wurde erfolgreich gespeichert.') {
            // Wenn die CSS-Datei generiert wurde, binde sie automatisch als CSS ein
            try {
              clearInterval(checkInterval);
              var link = document.createElement('link');
              link.rel = 'stylesheet';
              link.type = 'text/css';
              link.href = '../../../../src/css/iconlib.css';
              document.head.appendChild(link);
                }
                catch(err) {
                  errorHandler("Font Awesome CSS konnte nicht geladen werden!." + err.message);
                }
            
        }
    }, 1000); // Überprüfe alle 1 Sekunde
</script>

    <script type="text/javascript" src="//api.laut.fm/js_tools/lautfm_js_tools.0.10.0.js.min.js" ></script>

</head>
<oop_body id="oop_body">
    <?php
        // Parameter für die Stream-URL überprüfen
        $streamParam = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
        
        // Parameter für die Web-Stream-URL überprüfen, falls lfmstream leer ist
        if (empty($streamParam)) {
            $webStreamParam = isset($_GET['webstream']) ? $_GET['webstream'] : '';
        } else {
            $webStreamParam = '';
        }

        // Basis-URL für den Stream
        $streamBaseUrl = 'https://stream.laut.fm/';

        // Streaming-URL erstellen
        if (!empty($streamParam)) {
            $streamUrl = $streamBaseUrl . $streamParam;
        } elseif (!empty($webStreamParam)) {
            $streamUrl = $webStreamParam;
        } else {
            // Wenn keine Stream-URL vorhanden ist, lade die Unterseite src/nomedia.html
            include('../../src/nomedia.html');
            exit;
        }
    ?>
<oop_div id="oop_base-container" class="container-fluid">
    
    <nav id="topnavbar" class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
       <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">
     <oop_div id="oolfm_stationimg">
   <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_station_img">Loading...</div>
<script type="text/html" id="station_img_template" charset="utf-8">
<% if (this.image) { %>
<%= "<img src='" + this.image + "' alt='Station Image'>" %>
<% } else { %>
<%= "<img src='https://api.laut.fm/station/" + '<?php echo $lfmstream; ?>' + "/images/station' alt='Placeholder Image' width='30'>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
try {
    laut.fm.station('<?php echo $lfmstream; ?>').info({container:'api_lfm_station_img', template:'station_img_template'}, true);
} catch(error) {
    errorHandler(error.message);
}
</script>
<?php endif; ?>
    </oop_div>
    </a>
    <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">  <oop_div id="oolfm_stationname">
<?php
if (isset($_GET['lfmstream']) && !empty($_GET['lfmstream'])) {
    $lfmstream = $_GET['lfmstream'];
    echo '<div id="api_lfm_display_name">Loading...</div>';
    echo '<script type="text/html" id="display_name_template" charset="utf-8">';
    echo '<%= "" + this.display_name %>';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'api_lfm_display_name\', template:\'display_name_template\'}, true);';
    echo '</script>';
}
?></oop_div></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal">Letzte Titel</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">mehr </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown10">
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">Über <?php echo $lfmstream; ?></a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#sendeplan_modal" href="#">Sendeplan</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#playwith_modal" href="#">Andere Player</a></li>
            <li class="alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#">Über <span class="badge bg-dark">oO</span>Player </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
  
    
    
 <!---------------------------- PLAYER PLAYER PLAYER MAIN PLAYER -------------------->   

          
 <div id="blurlayer" > 
 </div>   
    <oop_div id="oop_player" class="position-absolute top-50 start-50 translate-middle" style="overflow:hidden; width:90%; padding: 1em;">
          
           
               <oop_div id="oolfm_currentshow"  class="d-flex justify-content-center">
             <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_current_playlists">Loading...</div>
<script type="text/html" id="current_playlists_template" charset="utf-8">
<%= "" + this.current_playlist.name %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_current_playlists', template:'current_playlists_template'}, true);
</script>
<?php endif; ?>
    </oop_div>
<br>

         <oop_div id="oolfm_songcover"  >
         <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Nur einbinden, wenn lfmstream Inhalt hat
if (!empty($lfmstream)) {
    echo '
    <div id="api_lfm_current_song_live_img">Loading...</div>
    <script type="text/html" id="current_song_live_img_template" charset="utf-8">
        <% 
        if (this.live) {
            var lfm_images = "../../../../src/assets/img/ooplay_placeholder_live.png";
            var alt_txt = "Live Images";
        } else if (this.artist.image) {
            var lfm_images = this.artist.image;
            var alt_txt = "Images";
        } else {
            var lfm_images = "../../../../src/assets/img/ooplay_placeholder.png";
            var alt_txt = "No Images";
        } 
        %>
        <%= "<img id=\'songcover\' class=\'mx-auto d-block img-fluid\' src=\'" + lfm_images + "\' style=\'width: 30em; max-width: 65%; max-height: 65%; min-width: 70px; min-height: 70px; height: auto;\' alt=\'" + alt_txt + "\'>" + "<style> body{ background-image: url(\'" + lfm_images + "\'); }</style>" %>
    </script> 
    <script type="text/javascript" charset="utf-8">
        laut.fm.station(\'' . $lfmstream . '\')
        .current_song({container:\'api_lfm_current_song_live_img\', template:\'current_song_live_img_template\'}, true);
    </script>';
}
?>
    </oop_div>
    <oop_div id="oolfm_current_song"  class="d-flex justify-content-center">
    <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_current_song3"  class="">Loading...</div>
<script type="text/html" id="current_song_template3" s charset="utf-8">
<% if (this.album) { %>
<%= "<br><div id='currentsong_lbl'  class='h3 d-flex justify-content-center '><span class='text-center'   data-bs-toggle='tooltip' data-bs-placement='top' title='" + this.artist.name + " - " + this.title + "'>" + this.artist.name + " - " + this.title + "<span></div><div id='currentsong_album_lbl'  class='h5 d-flex justify-content-center text-truncate'<span  class='text-center' bs-toggle='tooltip' data-bs-placement='top' title='" + this.album + "'>" + this.album + "</span></div>"%>
<% } else { %>
<%= "<br><div id='currentsong_lbl'   class='h3 d-flex justify-content-center '><span  class='text-center' data-bs-toggle='tooltip' data-bs-placement='top' title='" + this.artist.name + " - " + this.title + "'>" + this.artist.name + " - " + this.title + "<span></div>"%>
<% } %>
</script> 
<script type="text/javascript" charset="utf-8"> laut.fm.station('<?php echo $lfmstream; ?>') 
.current_song({container:'api_lfm_current_song3', template:'current_song_template3'}, true); </script>
<?php endif; ?>
</oop_div>
        <audio id="oop_audio" autoplay volume="0.3">
            <source src="<?php echo htmlspecialchars($streamUrl); ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        
 
 
 
 
 
       
        <div id="oop_player-controls text-center" class="btn-group" role="group" aria-label="Basic example" style=" width:90%">
         
         <!-- <button onclick="document.getElementById('oop_audio').pause()">Pause</button> -->
           
           <!-- <button onclick="document.getElementById('oop_audio').volume += 0.1">Vol +</button> 
            <button onclick="document.getElementById('oop_audio').volume -= 0.1">Vol -</button> -->
          
</div>
    </oop_div>
    
<!---------------------------- LASTPLAYED MODAL -------------------->


<div class="modal fade" id="lastplayed_modal" tabindex="-1" aria-labelledby="lastplayed_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Letzte Titel</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
            <oop_div id="oolfm_lastplayed">
        <!-- Prüfen, ob die nolfmfeatures-Variable auf 'y' gesetzt ist -->
<?php
$nolfmfeatures = isset($_GET['nolfmfeatures']) ? $_GET['nolfmfeatures'] : '';
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn nolfmfeatures auf 'y' gesetzt ist, wird der Code nicht ausgeführt
if ($nolfmfeatures !== 'y' && !empty($lfmstream)):
?>
<div id="api_lfm_last_x_songs_spezial">Loading...</div>
<script type="text/html" id="last_x_songs_spezial_template" charset="utf-8"> 
<%= "" %>
<% for (i=0; i < 10; i++) {
if (this[i].type == "song" || this[i].type == "news") {%>
<%= "<p><i class='fas fa-music'></i> " + this[i].artist.name + " - " + this[i].title + "<br /></p>" %>
<% } else { } }%>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.last_songs({container:'api_lfm_last_x_songs_spezial', template:'last_x_songs_spezial_template'}, true);
</script>
<?php endif; ?>

    </oop_div>
      </div>
    </div>
  </div>
</div>



<!---------------------------- LABOUT OOP MODAL -------------------->


<div class="modal fade" id="about_oop_modal" tabindex="-1" aria-labelledby="about_oop_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Über <span class="badge bg-dark">oO</span>Play</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
            <?php require('ver.php');?>
            </p>
      </div>
    </div>
  </div>
</div>

<!---------------------------- PLAYWITH MODAL -------------------->


<div class="modal fade" id="playwith_modal" tabindex="-1" aria-labelledby="playwith_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wiedergabe wechseln:</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
        
      </div>
      <div class="modal-body">
          <p><span class="badge bg-dark">oO</span>Player kann Ihnen diesen Stream in anderen Diensten oder externen Abspielgeräten öffnen, da die notwendigen Informatioenn vorliegen. Wählen Sie die gewünschte Abspieloption.</p>
         <div class="alert alert-info d-flex align-items-center" role="alert">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <div>
    Übertragen Sie den Stream von <?php echo $lfmstream; ?> auf ein Gerät in Ihrem Netzwerk, das Chromecast oder Casting unterstützt. Hierzu müssen SIe diesen Player auf einem Chromium-basierten-Browser oder einem Browser öffnen, der Google-Cast unterstützt. Klicken Sie nun im Hauptbildschirm unten rechts auf das Google-Cast Symbol (<i class="fab fa-chromecast"></i>) und wählen Sie das Gerät aus.
  </div>
</div>
        
    <oop_div id="oolfm_tunein_url">
        <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_tunein_link">Loading...</div>
<script type="text/html" id="tunein_link_template" charset="utf-8">
<% if (this.third_parties.tunein && this.third_parties.tunein.url) { %>
    <%= "<a class='btn btn-block text-white' style='width: 100%; background-color: #1c203c;' target='_blank' href='" + this.third_parties.tunein.url + "'> TuneIn*</a><br><br>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_tunein_link', template:'tunein_link_template'}, true);
</script>
<?php endif; ?>

    </oop_div>
    <oop_div id="oolfm_radiode_url">
     <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_radiode_link">Loading...</div>
<script type="text/html" id="radiode_link_template" charset="utf-8">
<% if (this.third_parties.radiode && this.third_parties.radiode.url) { %>
    <%= "<a class='btn btn-success btn-block' style='width: 100%;' target='_blank' href='" + this.third_parties.radiode.url + "'>radio.de*</a><br><br>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_radiode_link', template:'radiode_link_template'}, true);
</script>
<?php endif; ?>
    </oop_div>
    <oop_div id="oolfm_phonostar_url">
      <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_phonostar_link">Loading...</div>
<script type="text/html" id="phonostar_link_template" charset="utf-8">
<% if (this.third_parties.phonostar && this.third_parties.phonostar.url) { %>
    <%= "<a class='btn btn-danger btn-block' style='width: 100%;' target='_blank' href='" + this.third_parties.phonostar.url + "'>phonostar*</a><br><br>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_phonostar_link', template:'phonostar_link_template'}, true);
</script>
<?php endif; ?>
    </oop_div>
    <a class='btn btn-block' style='width: 100%; background-color: #1ed9b4;' target='_blank' href='" + this.third_parties.radiode.url + "'>laut.fm*</a><br><br>
    
    <div class="btn-group">
  <a href="https://stream.laut.fm/<?php echo $lfmstream; ?>" class="btn btn-danger">Direkten Stream auf externem Gerät</a>
<a class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas "></i>
  <span class="visually-hidden">Toggle Dropdown</span>
</a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="https://stream.laut.fm/<?php echo $lfmstream; ?>.m3u">m3u-Stream im externen Player oder Browser-Abspieler</a></li>
    <li><a class="dropdown-item" href="https://stream.laut.fm/<?php echo $lfmstream; ?>.pls">pls-Stream im externen Player oder Browser-Abspieler</a></li>
  </ul>
</div>
<br><br>
<p class=""><small><b>*</b> Wenn Sie auf Ihrem Gerät eine Endanwendung des ausgewählte Dienstes verwenden (zum Beispiel laut.fm-App auf Android), könnte diese App die Navigation zu diesem Dienst abfangen. Dann wird der Stream direkt in der jeweiligen App geöffnet.</small></p>

    
      </div>
    </div>
  </div>
</div>


<!---------------------------- STATIONINFO MODAL -------------------->


<div class="modal fade" id="stationinfo_modal" tabindex="-1" aria-labelledby="stationinfo_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ℹ️ <?php echo $lfmstream; ?></h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
            <oop_div id="oolfm_lafm_url"><p class='lead'>
                <div class='lead' id="api_lfm_description">Loading...</div>
<script type="text/html" id="description_template" charset="utf-8">
<%= "" + this.description +"<br><br>Dieser Sender ist ein laut.fm user-generated-radio, erreichbar unter <a target=_blank'' href='https://laut.fm/<?php echo $lfmstream; ?>'>laut.fm/<?php echo $lfmstream; ?></a>" %>
</script>
</p>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_description', template:'description_template'}, true);
</script>
            </oop_div>
            <br>
            <oop_div id="oolfm_station_url">
<?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_website_link">Loading...</div>
<script type="text/html" id="website_link_template" charset="utf-8">
<% if (this.third_parties.website && this.third_parties.website.url) { %>
    <% var domain = this.third_parties.website.url.split('/')[2]; %>
    <% if (domain.includes('twitter.com')) { %>
        <%= "<span class='badge bg-info' style='padding: 0.4rem 0.6rem;'><i class='fab fa-twitter'></i> Website (Twitter)</span> <a target='_blank' href='" + this.third_parties.website.url + "'>" + this.third_parties.website.url + "</a>" %>
    <% } else if (domain.includes('facebook.com')) { %>
        <%= "<span class='badge bg-primary' style='background-color: #0d6efd; color: white; padding: 0.4rem 0.6rem;'><i class='fab fa-facebook'></i> Website (Facebook)</span> <a target='_blank' href='" + this.third_parties.website.url + "'>" + this.third_parties.website.url + "</a>" %>
    <% } else if (domain.includes('instagram.com')) { %>
        <%= "<span class='badge bg-dark' style='padding: 0.4rem 0.6rem;'><i class='fab fa-instagram'></i> Website (Instagram)</span> <a target='_blank' href='" + this.third_parties.website.url + "'>" + this.third_parties.website.url + "</a>" %>
    <% } else { %>
        <%= "<span class='badge bg-dark' style='padding: 0.4rem 0.6rem;'><i class='fas fa-globe'></i> Website</span> <a target='_blank' href='" + this.third_parties.website.url + "'>" + this.third_parties.website.url + "</a>" %>
    <% } %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_website_link', template:'website_link_template'}, true);
</script>
<?php endif; ?>
            </oop_div>
      <oop_div id="oolfm_station_x_url">
   <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_twitter_link">Loading...</div>
<script type="text/html" id="twitter_link_template" charset="utf-8">
<% if (this.third_parties.twitter && this.third_parties.twitter.url) { %>
    <%= "<span class='badge bg-info' style='padding: 0.4rem 0.6rem;'><i class='fab fa-twitter-square fa-lg'></i> Twitter/X</span> <a target='_blank' href='" + this.third_parties.twitter.url + "'>" + this.third_parties.twitter.url + "</a>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_twitter_link', template:'twitter_link_template'}, true);
</script>
<?php endif; ?>
    </oop_div>
    <oop_div id="oolfm_station_fb_url">
  <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_facebook_link">Loading...</div>
<script type="text/html" id="facebook_link_template" charset="utf-8">
<% if (this.third_parties.facebook && this.third_parties.facebook.page) { %>
    <%= "<span class='badge bg-blue' style='background-color: #0d6efd; color: white; padding: 0.4rem 0.6rem;'><i class='fab fa-facebook-square fa-lg'></i> Facebook</span> <a target='_blank' href='" + this.third_parties.facebook.page + "'>" + this.third_parties.facebook.page + "</a>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_facebook_link', template:'facebook_link_template'}, true);
</script>
<?php endif; ?>
    </oop_div>
    <oop_div id="oolfm_station_insta_url">
<?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_instagram_link">Loading...</div>
<script type="text/html" id="instagram_link_template" charset="utf-8">
<% if (this.third_parties.instagram && this.third_parties.instagram.name) { %>
    <%= "<span class='badge bg-dark' style='padding: 0.4rem 0.6rem;'><i class='fab fa-instagram fa-lg'></i>  Instagram</span> <a target='_blank' href='https://instagram.com/" + this.third_parties.instagram.name + "'>" + "https://instagram.com/" + this.third_parties.instagram.name + "</a>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('<?php echo $lfmstream; ?>')
.info({container:'api_lfm_instagram_link', template:'instagram_link_template'}, true);
</script>
<?php endif; ?>


    </oop_div>
      </div>
    </div>
  </div>
</div>

<!---------------------------- SENDEPLAN MODAL -------------------->


<div class="modal fade" id="sendeplan_modal" tabindex="-1" aria-labelledby="sendeplan_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sendeplan</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
<oop_div id="oolfm_sendeplan">
<?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>

<div class="accordion" id="sendeplan_accordion">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingMO">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMO" aria-expanded="true" aria-controls="collapseMO">
        Montag
      </button>
    </h2>
    <div id="collapseMO" class="accordion-collapse collapse show" aria-labelledby="headingMO" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
      <div id="api_lfm_schedule_mon">Loading...</div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingDI">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDI" aria-expanded="false" aria-controls="collapseDI">
       Dienstag
      </button>
    </h2>
    <div id="collapseDI" class="accordion-collapse collapse" aria-labelledby="headingDI" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_tue">Loading...</div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingMI">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMI" aria-expanded="false" aria-controls="collapseMI">
        Mittwoch
      </button>
    </h2>
    <div id="collapseMI" class="accordion-collapse collapse" aria-labelledby="headingMI" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_wed">Loading...</div>
      </div>
    </div>
  </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingDO">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDO" aria-expanded="false" aria-controls="collapseDO">
       Donnerstag
      </button>
    </h2>
    <div id="collapseDO" class="accordion-collapse collapse" aria-labelledby="headingDO" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_thu">Loading...</div>
      </div>
    </div>
  </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingFR">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFR" aria-expanded="false" aria-controls="collapseFR">
        Freitag
      </button>
    </h2>
    <div id="collapseFR" class="accordion-collapse collapse" aria-labelledby="headingFR" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_fri">Loading...</div>
      </div>
    </div>
  </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingSA">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSA" aria-expanded="false" aria-controls="collapseSA">
       Samstag
      </button>
    </h2>
    <div id="collapseSA" class="accordion-collapse collapse" aria-labelledby="headingSA" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_sat">Loading...</div>
      </div>
    </div>
  </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingSO">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSO" aria-expanded="false" aria-controls="collapseSO">
        Sonntag
      </button>
    </h2>
    <div id="collapseSO" class="accordion-collapse collapse" aria-labelledby="headingSO" data-bs-parent="#sendeplan_accordion">
      <div class="accordion-body">
        <div id="api_lfm_schedule_sun">Loading...</div>
      </div>
    </div>
  </div>
</div>
<br>
<script type="text/javascript" charset="utf-8">
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
laut.fm.station('<?php echo $lfmstream; ?>').schedule(show_schedule);
</script>
<?php endif; ?>


</oop_div>
Den vollständigen Sendeplan finden Sie <a href="https://laut.fm/<?php echo $lfmstream; ?>">auf der laut.fm-Seite von <?php echo $lfmstream; ?></a>
      </div>
    </div>
  </div>
</div>







    
    
    
    

    
   
    
     





  
    

<nav id="playercontrolbar" class=" fixed-bottom navbar-dark bg-dark">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-2" style="flex: 0 0 20%;">
            <!-- Hier kommt das erste Element (20%) -->
            <a style="font-size: 2em;" class="btn " id="playpausebtn" onclick="playPause()" href="#">⏵</a>
            </div>
        <div class="col-8" style="flex: 0 0 60%;">
            <!-- Hier kommt das zweite Element (60%) -->
            <input class="btn btn-block form-range" type="range" onchange="setVolume()" style="max-width: 90%;" id='volume1' min=0 max=1 step=0.01 value="0.3"/>
        </div>
        <div class="col-2" style="flex: 0 0 20%;">
            <!-- Hier kommt das dritte Element (20%) -->
            <a id="cast" class="btn btn-success" href="#" onclick="playPause()"><i class="fab fa-chromecast" style="color: #ffffff;"></i></a>
        </div>
    </div>
</div>
</nav>

    
<!---------------------------- LOAD ALL FPR MAINPACKAGE JS ------------------->
<!---------------------------.... LOAD boostrapbundle js ---------------------->
<script src="../../../../../../src/assets/js/bootstrapbundel.js" ></script>
<!-----------------------.......-- LOAD CAST JS ---------------------------------->
 <script src="../../../../../../src/assets/castlibloader.php"></script>
<!-----------------------.......-- LOAD CONVEYOR JS ---------------------------------->
 <script src="../../../../../../src/js/conveyor.js"></script>
 <!----------------------------------- LOAD MAINPACKAGE JS ------------------->
<script>

//////////////////////  .:.  THIS IS THE JAVASCRIPT-MAIN-PACKAGE FOR oOPlay - Last Updated on 14. Feb. 2024 18:00  by PS(oO)

//////////////////////  .:.  SET VARIABLES evtl. values (var and const)
/////////// For Cast-JS:
const cjs = new Castjs();
/////////// For the PlayerControls:
var mediaClip = document.getElementById("oop_audio").value;






//////////////////////  .:.  RUN CODE

/////////// Enable Tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

/////////// PlayerControls-JS:



    
window.onload = function() {
    var backgroundAudio=document.getElementById("oop_audio");
    backgroundAudio.volume=0.3;
}
    

// Event-Listener für das "error"-Ereignis des Audioelements
oop_audio.addEventListener("error", function() {
    console.log('Fehler: Der Audiostream konnte nicht geladen werden.');
    handlePlaybackError();
});

// Event-Listener für das "abort"-Ereignis des Audioelements
oop_audio.addEventListener("abort", function() {
    console.log('Audiostream abgebrochen.');
    // Weitere Behandlung hier
});

// Event-Listener für das "stalled"-Ereignis des Audioelements
oop_audio.addEventListener("stalled", function() {
    console.log('Audiostream konnte nicht weitergeladen werden.');
    // Weitere Behandlung hier
});

function handlePlaybackError() {
    // Hier wird die Wiedergabe des Audiostreams neu gestartet
    oop_audio.load(); // Stoppt die Wiedergabe und lädt den Audiostream neu
    oop_audio.play(); // Startet die Wiedergabe erneut
}



    function setVolume() {
   document.getElementById("oop_audio").value = oop_audio;
   oop_audio.volume = document.getElementById("volume1").value;

}


function playPause() {
    if (oop_audio.paused) {
        oop_audio.play();   
    } else {
        oop_audio.pause();
    }
    updatePlayPauseButton();
}

function updatePlayPauseButton() {
    var playpauseb = document.getElementById("playpausebtn");
    var icon = oop_audio.paused ? "play" : "pause";

    // Lösche alle vorhandenen Kinder des Buttons
    playpauseb.innerHTML = '';

    // Erzeuge ein <i> Element für das FontAwesome-Icon
    var iconElement = document.createElement("i");

    // Setze die Klassen für das FontAwesome-Icon entsprechend dem Zustand
    iconElement.classList.add("fa"); // Füge die Klasse "fab" für das Brand-Icon-Set hinzu
    iconElement.classList.add(icon === "play" ? "fa-play" : "fa-pause"); // Wähle das entsprechende Icon

    // Setze die Farbe des Icons auf Weiß
    iconElement.style.color = "#ffffff";

    // Füge das FontAwesome-Icon dem Button hinzu
    playpauseb.appendChild(iconElement);
} 


// Event-Listener für Änderungen des Audio-Status
oop_audio.addEventListener("play", function() {
    updatePlayPauseButton();
    autoplayCheck();
    cjs.play();
});

oop_audio.addEventListener("pause", function() {
    updatePlayPauseButton();
    cjs.pause();
});

// Initialisierung des Play/Pause-Buttons
updatePlayPauseButton();

// Überprüfung des Autoplay-Status nach einer kurzen Verzögerung
setTimeout(autoplayCheck, 1000); 

function autoplayCheck() {
    if (oop_audio.autoplay && oop_audio.paused) {
        oop_audio.play();
        
        updatePlayPauseButton();
    }
}

/////////// MediaMetadata-JS:
// Warte 3 Sekunden, bevor das Skript ausgeführt wird
setTimeout(function() {
    // Funktion zur Aktualisierung des Title-Tags
    function updateTitle() {
        try {
            var currentSongLbl = document.getElementById('currentsong_lbl');
            if (currentSongLbl) {
                var songInfo = currentSongLbl.innerText.trim();
                // Hier ist der Wert korrekt
                console.log('Song Info:', songInfo);

                // Titel-Tag der Webseite aktualisieren
                document.title = `${songInfo} - oOPlayer`;
            }
        } catch (error) {
            console.error('JavaScript-Fehler im Titel-Update-Teil:', error);
        }
    }

    // Starte die Aktualisierung alle 5 Sekunden
    setInterval(updateTitle, 50000);

    // Führe die Funktion direkt nach dem Laden der Seite aus
    updateTitle();
}, 3000);


/////////// Cast-JS:

// Wait for user interaction
document.getElementById('cast').addEventListener('click', function() {
    // Check if casting is available
    if (cjs.available) {
        // URL-Parameter überprüfen
        const lfmstream = new URLSearchParams(window.location.search).get('lfmstream');
        const webstream = new URLSearchParams(window.location.search).get('webstream');

        // Streaming-URL erstellen
        const streamUrl = lfmstream ? `https://stream.laut.fm/${lfmstream}` : webstream;

        // Initiate new cast session with the streaming URL
        cjs.cast(streamUrl, {
            // Weitere Optionen wie Poster, Titel und Beschreibung können hier hinzugefügt werden
            poster: 'https://oop.ownonline.eu/src/assets/img/ooplay_placeholder.png',
            title: 'oOPlayer',
            description: 'ooPlayer Audiostream',
        }).then(() => {
            console.log('Casting erfolgreich');
        }).catch(error => {
            console.error('Fehler beim Casting:', error);
            handleCastingError();
        });
    }
});

function handleCastingError() {
    // Hier wird die Fehlerbehandlung für das Casting durchgeführt
    // Zum Beispiel: Neuer Versuch, Casting zu starten oder alternative Aktion
};

cjs.addEventListener(
  cast.framework.RemotePlayerEventType.MEDIA_INFO_CHANGED, function() {
    // Use the current session to get an up to date media status.
    let session = cast.framework.CastContext.getInstance().getCurrentSession();

    if (!session) {
        return;
    }

    // Contains information about the playing media including currentTime.
    let mediaStatus = session.getMediaSession();
    if (!mediaStatus) {
        return;
    }

    // mediaStatus also contains the mediaInfo containing metadata and other
    // information about the in progress content.
    let mediaInfo = mediaStatus.media;
  });



</script>





</html>
