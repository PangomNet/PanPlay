<!-- Modal fuer API-Fehler -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="neterror-container" tabindex="-1" aria-labelledby="neterror-containerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="neterror-containerLabel"><?php echo $ext_lang['neterr_modal_title']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <div id="neterrornotifier"> <?php echo $ext_lang['neterr_desc_net_thinking']; ?>
          <script>
function checkServerStatus() {
  fetch('https://api.laut.fm/server_status')
    .then(response => response.json())
    .then(data => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      if (data.running) {
        netErrorNotifier.innerHTML = '<div class="alert alert-success" role="alert"><?php echo $ext_lang['neterr_desc_net_okay1']; ?> <kbd><?php echo $lfmstream; ?></kbd> <?php echo $ext_lang['neterr_desc_net_okay2']; ?> <a class="btn btn-link" target="_blank" href="https://laut.fm/<?php echo $lfmstream; ?>"><?php echo $ext_lang['neterr_desc_net_okay3']; ?></a></div>';
        console.log('<?php echo $ext_lang['neterr_console_net_okay']; ?>');
      } else {
        netErrorNotifier.innerHTML = '<div class="alert alert-danger" role="alert"><?php echo $ext_lang['neterr_desc_net_laut_not_okay1']; ?></div>';
        console.log('<?php echo $ext_lang['neterr_console_net_laut_not_okay']; ?>');
      }
    })
    .catch(error => {
      const netErrorNotifier = document.getElementById('neterrornotifier');
      netErrorNotifier.innerHTML = '<div class="alert alert-warning" role="alert"><?php echo $ext_lang['neterr_desc_net_not_okay1']; ?><?php echo $ext_lang['neterr_desc_net_not_okay2']; ?></div>';
      console.error('<?php echo $ext_lang['neterr_console_net_not_okay']; ?>', error);
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
        <button onclick="reloadPage()" class="btn btn-lg btn-primary"><?php echo $lang['reload_player'] ?? 'Reload player'; ?></button>
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
