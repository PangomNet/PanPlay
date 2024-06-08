<?php 

echo "
<!--- errorolog modla ----->
<div class='modal fade' id='openerrorlog' tabindex='-1' aria-labelledby='openerrorlog' aria-hidden='true'>
  <div class='modal-dialog modal-fullscreen-md-down'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'><i class='fa fa-exclamation-triangle' style='color: red;'></i> " .$lang['centralerrorlog_modal_title'] ."</h5>
        <button type='button' class='btn btn-outline-danger' data-bs-dismiss='modal' aria-label='Close'>❌</button>
      </div>
      <div class='modal-body'>
          <div class='alert alert-danger' role='alert'>
          " .$lang['centralerrorlog_modal_desc'] ."
</div>
           <textarea disabled class='text-white bg-danger' id='errorTextarea' style='overflow: auto;' width='100%' rows='10' cols='60'>
               
           </textarea>
      </div>
    </div>
  </div>
</div>
<!--- newerror modla ----->
<div class='modal fade' id='shownewerror' tabindex='-1' aria-labelledby=' errlog_modal' aria-hidden='true'>
  <div class='modal-dialog modal-fullscreen-md-down'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'><i class='fa fa-exclamation-triangle' style='color: red;'></i>UPS!</h5>
        <button type='button' class='btn btn-outline-danger' data-bs-dismiss='modal' aria-label='Close'>❌</button>
      </div>
      <div class='modal-body'>
          <div class='alert alert-danger' role='alert'>
          " .$lang['centralerrorlog_occuring_modal_desc1'] ." <a class='alert-link' data-bs-toggle='modal' data-bs-target='#openerrorlog' data-bs-dismiss='modal' href='#'><i class='fa fa-exclamation-triangle' style='color: red;'></i> " .$lang['centralerrorlog_occuring_modal_desc2'] ."</a>!
      </div>
    </div>
  </div>
</div>
</div> "
?>