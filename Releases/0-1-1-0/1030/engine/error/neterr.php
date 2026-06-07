<!-- Modal fuer API-Fehler -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="neterror-container" tabindex="-1" aria-labelledby="neterror-containerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="neterror-containerLabel">Playback interrupted</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <div id="neterrornotifier"> One moment, PanPlay is checking what went wrong ...
          <script>
function checkServerStatus() {
  fetch('<?php echo $streamUrl ?>')
    .then(response => response.json())
    .then(data => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      if (data.running) {
        netErrorNotifier.innerHTML = '<div class="alert alert-success" role="alert"><b>Connection check successful</b><hr>The checked server appears to be reachable. If playback still fails, the requested stream or station may be invalid or temporarily unavailable.</div>';
        console.log('Connection check successful.');
      } else {
        netErrorNotifier.innerHTML = '<div class="alert alert-danger" role="alert"><b>Connection check failed</b><hr>The remote service may be unavailable or cannot be reached from this browser right now.</div>';
        console.log('Connection check failed.');
      }
    })
    .catch(error => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      netErrorNotifier.innerHTML = '<div class="alert alert-warning" role="alert"><b>No connection</b><hr>The server status could not be checked. Your connection may have been interrupted, blocked, or changed while playback was active. Reloading the player can help after network changes.</div>';
      console.error('Error while checking server status:', error);
    });
}

let panplayNetErrorIntervalId = null;
let panplayNetErrorModal = null;

function startCheckInterval() {
  if (panplayNetErrorIntervalId !== null) {
    return panplayNetErrorIntervalId;
  }

  checkServerStatus();
  panplayNetErrorIntervalId = setInterval(checkServerStatus, 30000);

  return panplayNetErrorIntervalId;
}

function stopCheckInterval() {
  if (panplayNetErrorIntervalId !== null) {
    clearInterval(panplayNetErrorIntervalId);
    panplayNetErrorIntervalId = null;
  }
}

function getNetErrorModal() {
  const netErrorContainer = document.getElementById("neterror-container");

  if (!netErrorContainer) {
    return null;
  }

  if (!panplayNetErrorModal) {
    panplayNetErrorModal = bootstrap.Modal.getOrCreateInstance(netErrorContainer);
  }

  return panplayNetErrorModal;
}

function showModalAndStartInterval() {
  const apifailModal = getNetErrorModal();
  const netErrorContainer = document.getElementById("neterror-container");

  if (!apifailModal || !netErrorContainer) {
    return;
  }

  startCheckInterval();

  if (!netErrorContainer.classList.contains("show")) {
    apifailModal.show();
  }
}

function closeModalAndStopInterval() {
  const apifailModal = getNetErrorModal();
  const netErrorContainer = document.getElementById("neterror-container");

  stopCheckInterval();

  if (apifailModal && netErrorContainer && netErrorContainer.classList.contains("show")) {
    apifailModal.hide();
  }
}
          </script>
        </div>
      </div>
      <div class="modal-footer">
        <button onclick="reloadPage()" class="btn btn-primary"><?php echo $lang['reload_player'] ?? 'Reload player'; ?></button>
        <script>
function reloadPage() {
  window.location.reload();
}
        </script>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $lang['close'] ?? 'Close'; ?></button>
      </div>
    </div>
  </div>
</div>
