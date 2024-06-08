<nav id="topnavbar" class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
       <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#fileinfo_modal" href="#">
       <oop_div class="d-none d-sm-block" id="oop_streamtitle">
       <i class="fas fa-music"></i> <?php
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
            <a id="aboutsenderlink_lbl" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#fileinfo_modal" ><i class="fas fa-info-circle"></i> <?php echo $ext_lang['stationinfo_navbar_title'] ?></a></li>
        </li>


            <li class="nav-item alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>


      </ul>

      <ul class="navbar-nav ms-auto">
          <?php
// Überprüfen, ob $playwith auf false steht
//if ($playwith === false) {
  // Wenn $playwith auf false steht, wird das HTML-Element nicht eingebunden
//} else {
  // Wenn $playwith nicht auf false steht, wird das HTML-Element eingebunden
//  echo " <li><a class='nav-link' data-bs-toggle='modal' data-bs-target='#playwith_modal' href='#'><i class='far fa-play-circle'></i> " . $ext_lang['playwith_navbar_title'] . "</a></li>";
//}
?>
<li><a class='nav-link' data-bs-toggle='modal' data-bs-target='#playwith_modal' href='#'><i class='far fa-play-circle'></i>  <?php echo $ext_lang['playwith_navbar_title']; ?></a></li>
          <li class='nav-item'>
          <li class="nav-link alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>
          </li>
          <li class='nav-item'>
          <li><a class='nav-link' data-bs-toggle="modal" data-bs-target="#settings_oop_modal" href="#"><i class="fas fa-cog"></i></a></li>
          </li> 
          <li class='nav-item'>
          <li><a class='nav-link' data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#"><span class="badge bg-dark text-light"><!--<i class="fas fa-music"></i>--> 🎶 oO<span class="text-danger">Play</span></span></a></li>
          </li> 
        </ul>
    </div>
  </div>
</nav>