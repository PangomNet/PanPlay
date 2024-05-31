<!-- Modal für API-Fehler -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="neterror-container" tabindex="-1" aria-labelledby="neterror-containerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="neterror-containerLabel">Wiedergabe unterbrochen!</h5>
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
  const apifailModal = new bootstrap.Modal(document.getElementById("neterror-container"));
  apifailModal.show();
  // Manuell starten
  const intervalId = startCheckInterval();
}

// Funktion zum Schließen des Modals und automatischen Stoppen des Intervalls
function closeModalAndStopInterval() {
  const apifailModal = new bootstrap.Modal(document.getElementById("neterror-container"));
  apifailModal.hide();
  // Automatisch stoppen
  stopCheckInterval(intervalId);
}

</script>
</div>


      </div>
      <div class="modal-footer">
      <button onclick="reloadPage()" class="btn btn-lg btn-primary">Player versuchen neu laden</button>

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