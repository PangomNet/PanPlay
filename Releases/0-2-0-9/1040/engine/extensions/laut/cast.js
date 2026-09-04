/////////// Cast-JS:

// Wait for user interaction
document.getElementById('cast').addEventListener('click', function() {

    // Check if casting is available
    if (cjs.available) {

        // URL-Parameter überprüfen
        const urlParams = new URLSearchParams(window.location.search);
        const lfmstream = urlParams.get('lfmstream');
        const webstream = urlParams.get('webstream');

        // Streaming-URL erstellen
        const streamUrl = lfmstream
            ? `https://stream.laut.fm/${lfmstream}`
            : webstream;

        // Debug-Ausgabe für unseren Custom-Receiver-Test
        console.log('PanPlay Cast wird gestartet');
        console.log('Stream:', streamUrl);
        console.log('Receiver:', cjs.receiver);

        // Initiate new cast session with the streaming URL
        // Castjs 5.1.0 gibt hier KEIN Promise zurück,
        // deshalb kein .then() / .catch().
        cjs.cast(streamUrl, {
            poster: currentAlbumArtUrl,
            title: currentArtistName + " - " + currentSongTitle,
            description: lfmstream
                ? lfmstream + ' @laut.fm'
                : 'PanPlay'
        });

    } else {
        console.warn('Casting ist derzeit nicht verfügbar');
    }
});


/////////// Cast-JS Events

// Castjs besitzt ein eigenes Event-System.
// Das ist hier zuverlässiger als direkt beim Seitenstart auf
// cast.framework.RemotePlayerEventType zuzugreifen.
if (typeof cjs.on === 'function') {

    cjs.on('connect', function() {
        console.log('Casting erfolgreich verbunden');
        console.log('Cast-Gerät:', cjs.device);
        console.log('Receiver:', cjs.receiver);
    });

    cjs.on('playing', function() {
        console.log('Chromecast spielt');
        console.log('Stream:', cjs.src);
    });

    cjs.on('disconnect', function() {
        console.log('Cast-Verbindung getrennt');
    });

    cjs.on('error', function(error) {
        console.error('Fehler beim Casting:', error);
        handleCastingError(error);
    });

} else {
    console.warn('Castjs Event-System ist nicht verfügbar');
}


function handleCastingError(error) {
    console.error('Casting Error occurred', error || '');
}


/////////// UPDATE CONTENT function

function updateContent(elementId, newContent) {
    var element = document.getElementById(elementId);
    if (!element) return; // Element nicht gefunden

    var transitionDuration = 500; // Übergangsdauer in Millisekunden
    var fadeOutDuration = transitionDuration * 0.4; // Dauer des Ausblendeeffekts
    var fadeInDuration = transitionDuration * 0.6; // Dauer des Einblendeeffekts

    // Führe den Ausblendeeffekt durch
    element.style.opacity = 0;

    setTimeout(function() {
        // Aktualisiere den Inhalt nach dem Ausblendeeffekt
        element.innerHTML = newContent;

        // Führe den Einblendeeffekt durch
        element.style.opacity = 1;
    }, fadeOutDuration);
}