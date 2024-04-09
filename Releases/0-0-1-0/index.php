<!DOCTYPE html>

<!----------------------------------------------- LOADING BAISC DEPENDENCIES ------------------------------------->
<!----------------------------------------------- COMPAT-CHECK ------------------------------------->
<?php require('src/assets/compatcheck.php');?>
<!--------------------------------------------------- SUBDOMAIN CHECK ------------------------------------>
<?php require('src/assets/subdomaincheck.php');?>
    <!----------------------------------------------- CENTRALERRORLOG ------------------------------------->
    <?php require('src/assets/centralerrorlog_c.php');?>
<!----------------------------------------------- OFLINEHANDLER ------------------------------------->
<?php require('src/assets/offlinehandler.php');?>







<!----------------------------------------------- PLAYER-PAGE-BASE ------------------------------------->

<html lang="de">
<html prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="src/assets/img/favicon.png">
    <link rel="apple-touch-icon" href="src/assets/img/apple-touch-icon.png">
    
<link rel="stylesheet" href="src/css/styles.css">
<link rel="stylesheet" href="src/css/conveyor.css">
<link rel="stylesheet" href="src/css/loader.min.css">
<style>
  #topnavbar,
#playercontrolbar {
    visibility: hidden;
    display: none; /* Element ausblenden und Platz freigeben */
}
  </style>


    <title>oOPlay - Player</title>
<!----------------------------------------------- UITHEMEHANDLER ------------------------------------->
<?php require('src/assets/uithemehandler.php');?>

<!--- ICONLIBLOADER ------->
<!-- Füge ein unsichtbares iframe-Element hinzu, das die iconlibloader.php-Datei aufruft -->
<iframe id="iconlibloaderFrame" src="src/css/iconlibloader.php" style="display:none;"></iframe>

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
              link.href = 'src/css/iconlib.css';
              document.head.appendChild(link);
                }
                catch(err) {
                  errorHandler("Font Awesome CSS konnte nicht geladen werden!." + err.message);
                }
            
        }
    }, 1000); // Überprüfe alle 1 Sekunde
</script>

<!----------------------------------------------- PLAYERMODE? ------------------------------------->
<?php
    // Überprüfen, ob die URL-Parameter lfmstream und webstream vorhanden sind
    $lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
    $webstream = isset($_GET['webstream']) ? $_GET['webstream'] : '';

    // Wenn beide Parameter leer oder nicht vorhanden sind, oder beide Parameter Inhalt haben, wird der Seiteninhalt durch "src/nomedia.html" ersetzt
    if ((empty($lfmstream) && empty($webstream)) || (!empty($lfmstream) && !empty($webstream))) {
        include('src/nomedia.html');
        exit;
    }

    // Setzen des playermode basierend auf den URL-Parametern
    $playermode = '';
    if (!empty($lfmstream)) {
        $playermode = 'lautstream';
    } elseif (!empty($webstream)) {
        $playermode = 'webstream';
    }

    // Basis-URL für den Stream
    $streamBaseUrl = 'https://stream.laut.fm/';

    // Streaming-URL erstellen
    $streamUrl = '';
    if ($playermode === 'lautstream') {
        $streamUrl = $streamBaseUrl . $lfmstream;
    } elseif ($playermode === 'webstream') {
        $streamUrl = $webstream;
    }
?>

<!----------------------------------------------- LAUTAPI? ------------------------------------->
<?php
if ($playermode === 'lautstream') {
        echo "<meta property='og:title' content='🎶" . $lfmstream . " - oOPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre das laut.fm-Radio " . $lfmstream ." in oOPlayer! Mit Titelinformationen, Sendeplan, u.v.m.' />";
    }
?>
<?php
if ($playermode === 'lautstream') {
        require('src/lautapi.php');
    }
?>
<!----------------------------------------------- WEBAPI? ------------------------------------->
<?php
if ($playermode === 'webstream') {
        require('src/webapi.php');
    }
?>




<meta property="og:site_name" content="oOPlay von OwnOnline" />
<meta property="og:image" content="src/assets/img/apple-touch-icon.png" />

</head>
<body id="oop_body">
<div class="loader-body" id="loader">
	<div class="loader"></div>
</div>

<oop_div id="oop_base-container" class="container-fluid">
    
<?php
if ($playermode === 'lautstream') {
        require('src/laut-topnavbar.php');
    }
?>
    
  
    
    
 <!---------------------------- PLAYER PLAYER PLAYER MAIN PLAYER -------------------->   

          
 <div id="blurlayer" > 
 </div>   
    <oop_div id="oop_player" class="position-absolute top-50 start-50 translate-middle" style="overflow:hidden; width:90%; padding: 1em;">
          
    <?php
if ($playermode === 'lautstream') {
        require('src/laut-playerui.php');
    }
?>


           
               

         

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
    
    <?php
if ($playermode === 'lautstream') {
        require('src/laut-playermodals.php');
    }
?>



<!---------------------------- LABOUT OOP MODAL -------------------->


<div class="modal fade" id="about_oop_modal" tabindex="-1" aria-labelledby="about_oop_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Über <span class="badge bg-dark">oO</span>Play</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
            <?php require('ver.php');?>
            </p>
      </div>
    </div>
  </div>
</div>

    

<nav id="playercontrolbar" class=" fixed-bottom navbar-dark bg-dark">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-2" style="flex: 0 0 20%;">
            <!-- Hier kommt das erste Element (20%) -->
            <button style="font-size: 2em;" class="btn " id="playpausebtn" onclick="playPause()" href="#">⏵</button>
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

<!-- Modal für API-Fehler -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="lfmapistrange" tabindex="-1" aria-labelledby="lfmapistrangeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lfmapistrangeLabel">Wiedergabe unterbrochen!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <!-- <p>Der Audiostream ist abgebrochen oder konnte erst garnicht geladen werden! <hr>
        Das kann viele Ursachen haben:<br>
        <ul>
          <li>Du hast keine Interverbindung oder die Verbindung wird unterdrückt. Sie kann auch durch einen Netzwerkwechsel zurückgesetzt worden sein und muss manuell durch ein Neuladen des Players wieder gestartet werden.</li>
          <li>Du hast einen ungültigen Sernder angefragt. Also einen, den es nicht gibt.</li>
          <li>Der Anbieter des Audiostreams laut.fm hat derzeit Probleme mit seiner Technik. Wenn du keine Titelinformationen siehst, kann er auch schwierigkeiten haben, deine Anfrage zu verarbeiten. Wir versuchen die Stream-URL unten in diesem Fenster anzuklingeln. Schaue dir das Ergebnis an.</li> 
</ul><hr>-->
<div id="neterrornotifier"> Eine Skeunde, wir versuchen zu erfahren, was schief gelaufen ist ...
  <script>
  // Funktion, die den Serverstatus abruft und anzeigt
function checkServerStatus() {
  fetch('https://api.laut.fm/server_status')
    .then(response => response.json())
    .then(data => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      if (data.running) {
        netErrorNotifier.innerHTML = '<div class="alert alert-success" role="alert"><b>Verbindung zum Internet und laut.fm fehlerfrei</b><hr>laut.fm läuft im regulären Betrieb. Das heißt, dass deine Internetverbindung aktiv ist und laut.fm aufgerufen werden kann. <hr><i>Das kann nur bedeuten, dass der Sender den du aufrufen möchtest, nicht existiert. Überprüfe auf laut.fm, ob die Station <kbd><?php echo $lfmstream; ?></kbd> wirklich existiert und korrigiere wenn nötig die URL.</i><hr><a class="btn btn-success" target="_blank" href="https://laut.fm/<?php echo $lfmstream; ?>">Überprüfen</a></div>';
        console.log('laut.fm läuft im regulären Betrieb');
      } else {
        netErrorNotifier.innerHTML = '<div class="alert alert-danger" role="alert"><b>Verbindung zum Internet und laut.fm fehlerhaft</b><hr>laut.fm hat derzeit Probleme. Es kann also sein, dass alle oder einige Inhalte von laut.fm nicht geladen werden können. Daran kann dieser Player nichts ändern. Du musst dich in Geduld üben, bis laut.fm wieder funktioniert.</div>';
        console.log('laut.fm hat derzeit Probleme');
      }
    })
    .catch(error => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      netErrorNotifier.innerHTML = '<div class="alert alert-warning" role="alert"><b>Verbindung zum Internet und laut.fm fehlerhaft</b><hr>Fehler beim Abrufen des Serverstatus von laut.fm. Entweder gibt es bei laut.fm gravierende Serverfehler oder die Verbindung zum Server wurde unterbrochen/unterbunden oder kann durch andere Störungen nicht aufgebaut werden. Du solltest deine Internetverbindung überprüfen. <br><br> Auf Mobilgeräten kann dieser Fehler durch einen Netzwerkwechsel (zum Beispiel von WLAN auf Mobile-Daten) auftreten. In diesem Fall hilft es jedoch bestimmt, die Seite einfach neu zu laden.</div>';
      console.error('Fehler beim Abrufen des Serverstatus:', error);
    });
}

// Funktion, um das Skript manuell zu starten und dann alle 30 Sekunden automatisch auszuführen
function startCheckInterval() {

  checkServerStatus();
  // Alle 30 Sekunden automatisch ausführen
  const intervalId = setInterval(checkServerStatus, 30000);

  // Rückgabe des Interval-IDs, um es später zu stoppen
  return intervalId;
}

// Funktion, um das Skript manuell zu stoppen
function stopCheckInterval(intervalId) {
  clearInterval(intervalId);
}

// Funktion zum Anzeigen des Modals und manuellen Starten des Intervalls
function showModalAndStartInterval() {
  const apifailModal = new bootstrap.Modal(document.getElementById("lfmapistrange"));
  apifailModal.show();
  // Manuell starten
  const intervalId = startCheckInterval();
}

// Funktion zum Schließen des Modals und automatischen Stoppen des Intervalls
function closeModalAndStopInterval() {
  const apifailModal = new bootstrap.Modal(document.getElementById("lfmapistrange"));
  apifailModal.hide();
  // Automatisch stoppen
  stopCheckInterval(intervalId);
}

</script>
</div>


      </div>
      <div class="modal-footer">
      <button onclick="reloadPage()" class="btn btn-primary">Player versuchen neu laden</button>

<script>
function reloadPage() {
    window.location.reload();
}
</script>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>


    
<!---------------------------- LOAD ALL FPR MAINPACKAGE JS ------------------->
<!---------------------------.... LOAD boostrapbundle js ---------------------->
<script src="src/assets/js/bootstrapbundel.js" ></script>
<!-----------------------.......-- LOAD CAST JS ---------------------------------->
 <script src="src/assets/castlibloader.php"></script>

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
    showModalAndStartInterval();
    handlePlaybackError();
});

// Event-Listener für das "abort"-Ereignis des Audioelements
oop_audio.addEventListener("abort", function() {
    console.log('Audiostream abgebrochen.');
    showModalAndStartInterval();
    // Weitere Behandlung hier
});

// Event-Listener für das "stalled"-Ereignis des Audioelements
oop_audio.addEventListener("stalled", function() {
    console.log('Audiostream konnte nicht weitergeladen werden.');
    showModalAndStartInterval();
    // Weitere Behandlung hier
});

// Event-Listener für das Schließen des Modals
document.getElementById("lfmapistrange").addEventListener("hidden.bs.modal", function () {
  closeModalAndStopInterval();
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
            poster: 'src/assets/img/ooplay_placeholder.png',
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

  /////////// UPDATE CONTENT function
  function updateContent(elementId, newContent) {
    var element = document.getElementById(elementId);
    if (!element) return; // Element nicht gefunden

    var transitionDuration = 500; // Übergangsdauer in Millisekunden
    var fadeOutDuration = transitionDuration * 0.4; // Dauer des Ausblendeffekts
    var fadeInDuration = transitionDuration * 0.6; // Dauer des Einblendeffekts

    // Führe den Ausblendeffekt durch
    element.style.opacity = 0;
    setTimeout(function() {
        // Aktualisiere den Inhalt nach dem Ausblendeffekt
        element.innerHTML = newContent;
        // Führe den Einblendeffekt durch
        element.style.opacity = 1;
    }, fadeOutDuration);
}


</script>

<!----------------------------------------------- CENTRALERRORLOG UI ------------------------------------->
<?php require('src/assets/centralerrorlog_ui.php');?>


</body>
<script src="src/js/loader.js"></script>
<!-----------------------.......-- LOAD CONVEYOR JS ---------------------------------->
<script src="src/js/conveyor.js"></script>
</html>
