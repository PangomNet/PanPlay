<!-- Modal fuer Baseaudio playback errors -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="neterror-container" tabindex="-1" aria-labelledby="neterror-containerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="neterror-containerLabel"><?php echo $ext_lang['neterr_modal_title'] ?? 'Playback Error'; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <div id="neterrornotifier"><?php echo $ext_lang['neterr_desc_net_thinking'] ?? 'Something is wrong. Checking the stream.'; ?>
          <script>
const panplayBaseaudioStreamUrl = <?php echo json_encode($streamUrl); ?>;

function checkServerStatus() {
  fetch(panplayBaseaudioStreamUrl, {
    method: 'GET',
    cache: 'no-store',
    mode: 'no-cors'
  })
    .then(() => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      netErrorNotifier.innerHTML = <?php echo json_encode($ext_lang['neterr_desc_net_okay1'] ?? '<b>Connection is fine</b><hr>The requested audio source appears to be reachable again. If playback does not continue, reload the player.'); ?>;
      console.log(<?php echo json_encode($ext_lang['neterr_console_net_okay'] ?? 'Connection is fine.'); ?>);
    })
    .catch(error => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      netErrorNotifier.innerHTML = <?php echo json_encode(($ext_lang['neterr_desc_net_not_okay1'] ?? '<b>No internet connection</b><hr>The requested audio source could not be reached. Reloading the player can help after network changes.') . ($ext_lang['neterr_desc_net_not_okay2'] ?? '')); ?>;
      console.error(<?php echo json_encode($ext_lang['neterr_console_net_not_okay'] ?? 'Error while checking stream status: '); ?>, error);
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
