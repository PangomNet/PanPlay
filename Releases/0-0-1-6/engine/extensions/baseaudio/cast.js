

/////////// Cast-JS:

// Wait for user interaction
document.getElementById('cast').addEventListener('click', function() {
    // Check if casting is available
    if (cjs.available) {
        // URL-Parameter überprüfen
        const streamUrl = new URLSearchParams(window.location.search).get('webstream');

        // Streaming-URL erstellen
        const cast_webstream = streamUrl;

        // Initiate new cast session with the streaming URL
        cjs.cast(streamUrl, {
            // Weitere Optionen wie Poster, Titel und Beschreibung können hier hinzugefügt werden
            poster: currentAlbumArtUrl,
            title: currentArtistName + " - " + currentSongTitle  ,
            description: 'oOPlay',
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
};