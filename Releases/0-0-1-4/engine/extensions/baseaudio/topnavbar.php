<nav id="topnavbar" class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
       <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#fileinfo_modal" href="#">
     <b>oOPlayer</b>
    </a>
    <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#fileinfo_modal" href="#">  <oop_div class="d-none d-sm-block" id="oop_streamtitle">
<?php
    echo $webstream;
?>
</oop_div>

</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a id="aboutsenderlink_lbl" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#fileinfo_modal" ><i class="fas fa-info-circle"></i> Eigenschaften</a></li>
        </li>


            <li class="nav-item"> <a class="nav-link" data-bs-toggle="modal" data-bs-target="#playwith_modal" href="#"><i class="fas fa-download"></i> Download</a></li>
            <li class="nav-item alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#"><i class="fas fa-question-circle"></i> Über <span class="badge bg-dark">oO</span>Player </a></li>

      </ul>
    </div>
  </div>
</nav>