<?php







// Hier können Sie PHP-Code einfügen, der benötigt wird, um Variablen zu initialisieren oder andere Logik auszuführen

$playwithmodal_content = <<<HTML
<!---------------------------- PLAYWITH MODAL -------------------->
<div class="modal fade" id="playwith_modal" tabindex="-1" aria-labelledby="playwith_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {$ext_lang["playwith_modal_title"]} </h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
       {$ext_lang["playwith_modal_topdesc"]}<br><br>
       
        <input type="text" class="form-control" value="$webstream"readonly><br>
        <a class="btn btn-block" style="width: 100%; background-color: black;" target="_blank" href="$webstream">{$ext_lang["directstreamtobrowserdropdown"]}</a><br><br>

        {$ext_lang["playwith_modal_gcast_topdesc1"]}$webstream{$ext_lang["playwith_modal_gcast_topdesc2"]}</p>
      </div>
    </div>
  </div>
</div>
HTML;


$fileinfomodal_code = <<<HTML
<div class="modal fade" id="fileinfo_modal" tabindex="-1" aria-labelledby="fileinfo_modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModaltitleLabel"><i class="fa-solid fa-radio"></i> $webstream</h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">


            {$ext_lang["stationinfo_modal_topdesc"]}






            </div>
        </div>
    </div>
</div>
HTML;








echo $fileinfomodal_code;
echo $playwithmodal_content;

?>