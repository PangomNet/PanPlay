// Funktion zum Aktualisieren der Metadaten basierend auf den Informationen des abgespielten Songs
function updateMediaMetadata(songTitle, artistName, albumTitle, albumArtUrl) {
    if ('mediaSession' in navigator) {
      // Metadaten für das aktuell abgespielte Medium erstellen
      var mediaMetadata = new MediaMetadata({
        title: songTitle,
        artist: artistName,
        album: albumTitle,
        artwork: [
          { src: albumArtUrl, sizes: '96x96', type: 'image/jpeg' },
          { src: albumArtUrl, sizes: '512x512', type: 'image/jpeg' },
      { src: albumArtUrl, sizes: '256x256', type: 'image/jpeg' },
      { src: albumArtUrl, sizes: '128x128', type: 'image/jpeg' }
        ]
      });
  
      // Setze die Metadaten für die Media Session
      navigator.mediaSession.metadata = mediaMetadata;
    }
  }
  
  // Funktion zum automatischen Aktualisieren der Metadaten alle 2 Minuten
  function autoUpdateMetadata() {
  
  
    // Aktualisiere die Metadaten mit den aktuellen Informationen des Songs
    updateMediaMetadata(currentSongTitle, currentArtistName, currentAlbumTitle, currentAlbumArtUrl);
  }

  // Führe die Funktion autoUpdateMetadata alle 2 Minuten aus
setInterval(autoUpdateMetadata, 2 * 60 * 1000); // 2 Minuten in Millisekunden


/////////// MediaMetadata-JS:

// Funktion zum Auslesen des aktuellen Interpreten, Titels und Albumtitels aus der Oberfläche
function getCurrentSongInfoFromUI() {
    var currentSongLabel = document.getElementById('currentsong_lbl');
    var currentAlbumLabel = document.getElementById('currentalbum_lbl');

    if (currentSongLabel) {
        var labelsContent = currentSongLabel.innerText;
        var labelsArray = labelsContent.split(' - ');
        currentArtistName = labelsArray.length > 1 ? labelsArray[0] : "<?php echo $lfmstream; ?>";
        currentSongTitle = labelsArray.length > 1 ? labelsArray[1] : "Unbekannter Titel";
    } else {
        // Setze Platzhalterwerte für Titel und Interpret, falls das Oberflächenelement nicht gefunden wird
        currentSongTitle = "Unbekannter Titel";
        currentArtistName = "<?php echo $lfmstream; ?>";
    }

    if (currentAlbumLabel) {
        currentAlbumTitle = currentAlbumLabel.innerText || "oOPlay";
    } else {
        // Setze einen Platzhalterwert für das Album, falls das Oberflächenelement nicht gefunden wird
        currentAlbumTitle = "oOPlay";
    }
}

// Rufe die Funktion getCurrentSongInfoFromUI auf, um die aktuellen Songinformationen aus der Oberfläche zu lesen
getCurrentSongInfoFromUI();



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
                updateMediaMetadata(currentSongTitle, currentArtistName, currentAlbumTitle, currentAlbumArtUrl);

                // Titel-Tag der Webseite aktualisieren
                document.title = `${songInfo} - oOPlayer`;
                getCurrentSongInfoFromUI();
                updateCurrentAlbumArtFromAPI();
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

updateMediaMetadata(currentSongTitle, currentArtistName, currentAlbumTitle, currentAlbumArtUrl);