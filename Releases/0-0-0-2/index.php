<?php
// Aktuelle URL überprüfen ooPlay ist als SingleDomain-Anwendung entwickelt worden. Es soll auf der Domain alleine sein. Deshalb ist der Betrieb auf einer Subdomain [[subdomain.server.com]] empfohlen. Server, deren Unterverzeichniss einer Hauptdomain als Subdomain eingerichtet werden können [[server.com/subdomain]] (Standard zum Beispiel bei one.com, erlauben jedoch den Zugriff über die Hauptdomain ins das Verzeichniss für die Besucher. Dies kollidiert evtl. mit der Programmierung. Der Subdomaincheck prüft deshalb, den gegewärtigen HTTP_Host und verhindert so etwas. Um dieses Verhalten abzustellen, verhindern sie das Laden der Subdomain oder tragen sie einfach die Hauptdomain ein, das Skript akzeptiert sie dann als Subdomain (Beispiel Debugging-Eintrag)
$currentUrl = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$devmode = isset($_GET['devmode']) ? $_GET['devmode'] : '';
$expectedSubdomain = 'oop.ownonline.eu'; // Release
//$expectedSubdomain = 'localhost'; // Debug



if ((empty($devmode) && empty($devmode))) {
    // Überprüfen, ob die Seite über die erwartete Subdomain aufgerufen wurde
if (strpos($currentUrl, $expectedSubdomain) === false) {
    // Wenn nicht, include die falseentrypoint.html
    include('src/falseentrypoint.html');
    exit;
}
} else {
    echo "<div class='devmode_i'><b><i class='fas fa-exclamation-circle'></i> DEVMODE</b> </div> <style>    div.devmode_i {      color: red; position: -webkit-sticky;      position: sticky;      top: 0;      background-color: yellow;
      width: 100px;
      left: 50;
      z-index:9993;
    }
    </style>";
}
 
?>


<!--- OFLINEHANDLER --->
<script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('service-worker.js', { scope: '/' }).then(function(registration) {
                    console.log('Service Worker registered with scope:', registration.scope);
                }).catch(function(error) {
                    console.error('Service Worker registration failed:', error);
                });
            });
</script>







<!----------------------------------------------- COMPAT-CHECK ------------------------------------->
<?php

// Browser-Infos auslesen
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Liste der nicht kompatiblen Browser und Versionen (vor 2020)
$incompatibleBrowsers = array(
    'MSIE' => 11,  // Internet Explorer 11 und älter
    'Firefox' => 70,  // Firefox Version 70 und älter
    'Chrome' => 79,  // Chrome Version 79 und älter
    'Safari' => 12,  // Safari Version 12 und älter
    'Opera' => 60,  // Opera Version 60 und älter
);

// Prüfen, ob der Browser kompatibel ist
$compatible = true;

foreach ($incompatibleBrowsers as $browser => $version) {
    $pattern = '/'.$browser.'\/([\d.]+)/';

    if (preg_match($pattern, $userAgent, $matches)) {
        $browserVersion = (int)$matches[1];

        if ($browserVersion <= $version) {
            $compatible = false;
            echo "Nicht kompatibler Browser: $browser $browserVersion"; // Debug-Ausgabe
            break;
        }
    }
}

// Falls nicht kompatibel, Browsercompat-Quellcode nachladen
if (!$compatible) {
    // Hier den Quellcode von browsercompat.html einfügen oder den Pfad entsprechend anpassen
    $browserCompatHTML = file_get_contents('https://ownonline.eu/_res/compat/browsercompat.html');
    echo $browserCompatHTML;
    exit;
}

// Falls kompatibel, hier den normalen Inhalt der Webseite einfügen
/* echo "Der Browser ist kompatibel: $userAgent"; // Debug-Ausgabe */

?>

<!---- CENTRAL ERROR LOG! ----->
<script>
// Funktion, die den errorHandler beim Laden der Seite auslöst
// window.addEventListener('load', function() {
//    errorHandler('Beispiel Fehlermeldung beim Laden der Seite.');
// });


self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request)
        .catch(function() {
            const url = new URL(event.request.url);
            errorHandler('Netzwerkfehler beim Laden von ' + url.href);
        })
    );
});


    function errorHandler(message) {
    // Holen Sie sich die vorhandene Textarea
    var textarea = document.getElementById('errorTextarea');
    
    // Aktuelle Zeit für Zeitstempel
    var now = new Date();
    var timestamp = now.toLocaleString();

    // Überprüfen, ob die Textarea leer ist
    var isEmpty = textarea.value.trim() === '';

    // Fügen Sie die neue Fehlermeldung oben hinzu
    textarea.value = '[' + timestamp + '] ' + message + '\n' + textarea.value;

    // Überprüfen, ob das Modal bereits angezeigt wird
    var modal = document.getElementById('shownewerror');
    var isModalVisible = modal.classList.contains('show');

    // Wenn die Textarea leer ist, sichtbare den Navlink und zeige das Modal an
    if (isEmpty) {
        var navlink = document.getElementById('openerrorlog_nav');
        navlink.style.display = 'block';
        
        // Wenn das Modal nicht bereits angezeigt wird, zeigen Sie es an
        if (!isModalVisible) {
            var myModal = new bootstrap.Modal(modal);
            myModal.show();
        }
    }
}
</script>


<!--- errorolog modla ----->
<div class="modal fade" id="openerrorlog" tabindex="-1" aria-labelledby="openerrorlog" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" role="alert">
  Wenn Sie auf dieses Fenster Zugriff haben, sind kritische Fehler (höchstwahrscheinlich Verbindungsfehler) aufgetreten. Diese Fehler könnten den weiteren Betrieb von 'oOPlay' entweder nur gering oder sehr maßgeblich stören und zum absturz führen. Bitte seien Sie aufmerksam. Wenn Sie sich mit den Entwicklertools Ihres Gerätes auskennen, empfehlen wir Ihnen, auch dort nach zusätzlichen Fehlern zu suchen. Die Fehler können eventuell behebbar sein.
</div>
           <textarea disabled class="text-white bg-danger" id="errorTextarea" style="overflow: auto;" width="100%" rows="10" cols="60">
               
           </textarea>
      </div>
    </div>
  </div>
</div>
<!--- newerror modla ----->
<div class="modal fade" id="shownewerror" tabindex="-1" aria-labelledby=" errlog_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle" style="color: red;"></i>UPS!</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" role="alert">
  Es sind Fehler aufgetreten! Es kommt eventuelle zu einem Verbindungsverlust! Bitte prüfen Sie die <a class="alert-link" data-bs-toggle="modal" data-bs-target="#openerrorlog" data-bs-dismiss="modal" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a>!
      </div>
    </div>
  </div>
</div>
</div>




<!----------------------------------------------- PLAYER-PAGE-BASEK ------------------------------------->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../../../src/css/styles.css">
    <title>oOPlay - Player</title>
    

<!--- ICONLIBLOADER ------->
<!-- Füge ein unsichtbares iframe-Element hinzu, das die iconlibloader.php-Datei aufruft -->
<iframe id="iconlibloaderFrame" src="../../../../src/css/iconlibloader.php" style="display:none;"></iframe>

<!-- Füge ein Skript hinzu, das überprüft, ob die CSS-Datei generiert wurde und sie dann automatisch als CSS einbindet -->
<script>
    // Überprüfe, ob die CSS-Datei generiert wurde
    var checkInterval = setInterval(function() {
        if (document.getElementById('iconlibloaderFrame').contentDocument.body.innerText === 'Font Awesome CSS wurde erfolgreich gespeichert.') {
            // Wenn die CSS-Datei generiert wurde, binde sie automatisch als CSS ein
            clearInterval(checkInterval);
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = '../../../../src/css/iconlib.css';
            document.head.appendChild(link);
        }
    }, 1000); // Überprüfe alle 1 Sekunde
</script>




         <style>
        <?php
        // Standardfarben
        $backgroundColor = '#1a1b23';
        $textColor = 'white';

        // Überprüfen, ob der "colors"-Parameter vorhanden und nicht leer ist
        if (isset($_GET['colors']) && !empty($_GET['colors'])) {
            $colorsParam = $_GET['colors'];

            // Überprüfen, ob der Parameter "light" ist
            if ($colorsParam == 'light') {
                $backgroundColor = '#fafafc';
                $textColor = 'black';
            }
            // Überprüfen, ob der Parameter "custom" ist
            elseif ($colorsParam == 'custom') {
                // Überprüfen, ob die Parameter bcolor und tcolor vorhanden sind und gültige Hexcodes sind
                if (isset($_GET['bcolor']) && preg_match('/^[a-f0-9]{6}$/i', $_GET['bcolor'])) {
                    $backgroundColor = '#' . $_GET['bcolor'];
                }

                if (isset($_GET['tcolor']) && preg_match('/^[a-f0-9]{6}$/i', $_GET['tcolor'])) {
                    $textColor = '#' . $_GET['tcolor'];
                }
            }
        }
        ?>
        body, html, .modal-header, .modal-content, .modal-footer, .btn-close, .accordion, .accordion-item, .accordion-button {
            background-color: <?php echo $backgroundColor; ?>;
            color: <?php echo $textColor; ?>;
        }
        

    </style>
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
            include('src/nomedia.html');
            exit;
        }
    ?>
<oop_div id="oop_base-container" class="container-fluid">
    
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
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

          
          
    <oop_div id="oop_player" class="position-absolute top-50 start-50 translate-middle" style="width:90%">
          
           
               <oop_div id="oolfm_currentshow" class="d-flex justify-content-center">
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
         <oop_div id="oolfm_songcover">
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
        <%= "<img id=\'songcover\' class=\'mx-auto d-block img-fluid\' src=\'" + lfm_images + "\' style=\'width: 40%; max-width: 200px; max-height: 200px; height: auto;\' alt=\'" + alt_txt + "\'>" %>
    </script> 
    <script type="text/javascript" charset="utf-8">
        laut.fm.station(\'' . $lfmstream . '\')
        .current_song({container:\'api_lfm_current_song_live_img\', template:\'current_song_live_img_template\'}, true);
    </script>';
}
?>
    </oop_div>
    <oop_div id="oolfm_current_song" class="d-flex justify-content-center">
    <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_current_song3" class="">Loading...</div>
<script type="text/html" id="current_song_template3" charset="utf-8">
<% if (this.album) { %>
<%= "<br><p id='currentsong_lbl' class='h3 d-flex justify-content-center'>" + this.artist.name + " - " + this.title + "</p><p id='currentsong_album_lbl' class='h5 d-flex justify-content-center'>" + this.album + "</p>"%>
<% } else { %>
<%= "<br><p class='h3 justify-content-center'>" + this.artist.name + " - " + this.title + "</p>"%>
<% } %>
</script> 
<script type="text/javascript" charset="utf-8"> laut.fm.station('<?php echo $lfmstream; ?>') 
.current_song({container:'api_lfm_current_song3', template:'current_song_template3'}, true); </script>
<?php endif; ?>
</oop_div>
        <audio id="oop_audio" autoplay volume="0.2">
            <source src="<?php echo htmlspecialchars($streamUrl); ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        
 
 
 
 
 
        
        <div id="oop_player-controls text-center" class="btn-group" role="group" aria-label="Basic example" style="width:90%">
         
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
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
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
<%= "<p><i class='fas fa-music'></i>  " + this[i].artist.name + " - " + this[i].title + "<br /></p>" %>
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
        <h5 class="modal-title" id="exampleModalLabel">Über <span class="badge bg-dark">oO</span>Player</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
          <p class="lead">Eine vollständige Dokumentation und Anleitungen zur Inplementierung des Players in Ihr Projekt, finden Sie auf <a target="_blank" href="../../../../index.php">oop.ownonline.eu</a></p>
            <p>
                Versionsrelease 0.0.0.2 vom 12.02.2024 <small>(inkl. Patch 0.0.0.2A vom 17.02.2024 (FA-FIX) & Patch 0.0.0.2B vom 04.03.2024 (Player-Selector-Patch)</small> <br> ©️2024 ownOnline/Patrick Schneider
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
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        
      </div>
      <div class="modal-body">
          <p><span class="badge bg-dark">oO</span>Player kann Ihnen diesen Stream in anderen Diensten oder externen Abspielgeräten öffnen, da die notwendigen Informatioenn vorliegen. Wählen Sie die gewünschte Abspieloption.</p>
         <div class="alert alert-info d-flex align-items-center" role="alert">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <div>
    Übertragen Sie den Stream von <?php echo $lfmstream; ?> auf ein Gerät in Ihrem Netzwerk, das Chromecast oder Casting unterstützt. Hierzu müssen SIe diesen Player auf einem Chromium-basierten-Browser oder einem Browser öffnen, der Google-Cast unterstützt. Klicken SIe nun im Hauptbildschirm unten rechts auf "Streamen" und wählen Sie das Gerät aus.
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
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
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
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
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







    
    
    
    

    
   
    
     





  
    

<nav class=" fixed-bottom navbar-dark bg-dark">
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

    
   <!-- Neues JavaScript-Script für die dynamische Elementerstellung -->

<!---------------------------- PLAYERCONTROL JS ------------------------->
<script defer>
    
window.onload = function() {
    var backgroundAudio=document.getElementById("oop_audio");
    backgroundAudio.volume=0.3;
}
    
</script>

<script>
var oop_audio = document.getElementById('oop_audio');

oop_audio.onerror = function() {
    console.log('Fehler: Der Audiostream konnte nicht geladen werden.');
    // Weitere Fehlerbehandlung hier
};

oop_audio.onabort = function() {
    console.log('Audiostream abgebrochen.');
    // Weitere Behandlung hier
};

oop_audio.onstalled = function() {
    console.log('Audiostream konnte nicht weitergeladen werden.');
    // Weitere Behandlung hier
};


    function setVolume() {
   var mediaClip = document.getElementById("oop_audio").value;
   document.getElementById("oop_audio").value = oop_audio;
   oop_audio.volume = document.getElementById("volume1").value;

}

var oop_audio = document.getElementById("oop_audio");

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
});

oop_audio.addEventListener("pause", function() {
    updatePlayPauseButton();
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

</script>
<!--------------------------- boostrapbundle js ---------------------->
<script src="../../../../../../src/assets/js/bootstrapbundel.js" ></script>
<!------------------------- CAST JS ---------------------------------->
 <script src="../../../../../../src/assets/castlibloader.php"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/castjs/5.2.0/cast.min.js"></script>-->
<script>
// Create new Castjs instance
const cjs = new Castjs();

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
            poster: '../../../../src/assets/img/ooplay_placeholder.png',
            title: 'oOPlayer',
            description: 'ooPlayer Audiostream',
        });
    }
});

</script>

<!-- -------------------- -MEDIAMETADAT-API INPLEMENTATION --------------------------------->
<script>
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
</script>



</html>
