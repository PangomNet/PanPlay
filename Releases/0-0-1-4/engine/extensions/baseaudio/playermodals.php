<?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
// Prüfen, ob die nolfmfeatures-Variable auf 'y' gesetzt ist
$nolfmfeatures = isset($_GET['nolfmfeatures']) ? $_GET['nolfmfeatures'] : '';
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn nolfmfeatures nicht auf 'y' gesetzt ist und lfmstream nicht leer ist, wird der Code ausgegeben
if ($nolfmfeatures !== 'y' && !empty($lfmstream)):
 

    
endif;






// Hier können Sie PHP-Code einfügen, der benötigt wird, um Variablen zu initialisieren oder andere Logik auszuführen

$playwithmodal_content = '
<!---------------------------- PLAYWITH MODAL -------------------->
<div class="modal fade" id="playwith_modal" tabindex="-1" aria-labelledby="playwith_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Player wechseln:</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
       
        <input type="text" class="form-control" value="' . $webstream . '"readonly><br>
        <a class="btn btn-block" style="width: 100%; background-color: black;" target="_blank" href="' . $webstream . '">Streamdatei Extern öffnen</a><br><br>

        <p class=""><small><b><u>Nutzen Sie den Button unten Rechts im Hauptbildschirm, um diesen Stream auf ein Google Cast-Gerät zu übertragen.</u></b> Google Cast ist nicht auf jedem Gerät oder auf jeder Software verfügbar. Android- und Windows-Nutzer benötgen einen Chrome- oder einen auf Chrome-basierenden Browser wie Micrsoft Edge, oder Vivaldi. Die völlständigen Systemanforderungen für GoogleCast finden Sie <a target="_blank" href="../../../docs/chromecast.html#requirements">hier</a></small></p>
      </div>
    </div>
  </div>
</div>
';


$fileinfomodal_code = <<<HTML
<div class="modal fade" id="fileinfo_modal" tabindex="-1" aria-labelledby="fileinfo_modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModaltitleLabel"><i class="fa-solid fa-radio"></i> $webstream</h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">


Weitere Details zur Datei sind derzeit nicht auffindbar. Hierfür müssen Sie auf die Fortschreitende Entwicklung von oOPlay warten. Für die Zukunft ist das Auslesen aus Dateien geplant. Aber bislang ist es noch nicht umgesetzt.






            </div>
        </div>
    </div>
</div>
HTML;








echo $fileinfomodal_code;
echo $playwithmodal_content;

?>