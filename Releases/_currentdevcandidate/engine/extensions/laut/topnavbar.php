<nav id="topnavbar" class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
       <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">
     <oop_div id="oolfm_stationimg">
   <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_station_img_nav"></div>

<?php endif; ?>
    </oop_div>
   
    </a>
    <a class="navbar-brand d-none d-md-block" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">  <oop_div class="" id="oolfm_stationname">
<?php
    $lfmstream = $_GET['lfmstream'];
    echo '<div id="api_lfm_display_name"></div>';

?>
</oop_div> 
</a>

<?php
// Annahme: Die Variablen $stationinfo, $trackhistory und $sendeplan sind bereits als boolean gesetzt

// Überprüfen, ob alle Variablen auf false stehen und ob es sich um die mobile Ansicht handelt
if ($stationinfo === false && $trackhistory === false && $sendeplan === false) {
    // Wenn alle Bedingungen erfüllt sind, wird das <a>-Element eingefügt

   echo " <a id='mviewstationname' class='navbar-brand d-block d-lg-none' href='#'></a> ";

}
?>


<div class="d-block d-md-none btn-group btn-lg" role="group" aria-label="Basic outlined example">



<?php
// Überprüfen, ob $trackhistory auf false steht
if ($trackhistory === false) {
  // Wenn $trackhistory auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $trackhistory nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-link text-white btn-lg' href='#' data-bs-toggle='modal' data-bs-target='#lastplayed_modal'><i class='fas fa-history'></i></button>";
}
?>
<?php
// Überprüfen, ob $sendeplan auf false steht
if ($sendeplan === false) {
  // Wenn $sendeplan auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $sendeplan nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-link text-white btn-lg' href='#' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-calendar-week'></i></button>";
}
?>
<?php
// Überprüfen, ob $stationinfo auf false steht
if ($stationinfo === false) {
  // Wenn $stationinfo auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $stationinfo nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-link text-white btn-lg'href='#' data-bs-toggle='modal' data-bs-target='#stationinfo_modal' ><i class='fas fa-info-circle'></i></button>";
}
?>
 
</div>
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto">
      <?php
// Überprüfen, ob $trackhistory auf false steht
if ($trackhistory === false) {
  // Wenn $trackhistory auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $trackhistory nicht auf false steht, wird das HTML-Element eingebunden
  echo "<li class='nav-item'>
  <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#lastplayed_modal'><i class='fas fa-history'></i> " . $ext_lang['trackhistory_navbar_title'] . "</a>
</li>";
}
?>
<?php
// Überprüfen, ob $sendeplan auf false steht
if ($sendeplan === false) {
  // Wenn $sendeplan auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $sendeplan nicht auf false steht, wird das HTML-Element eingebunden
  echo " <li class='nav-item'>
  <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-calendar-week'></i> " . $ext_lang['sendeplan_navbar_title'] . "</a></li>
</li>";
}
?>
<?php
// Überprüfen, ob $stationinfo auf false steht
if ($stationinfo === false) {
  // Wenn $stationinfo auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $stationinfo nicht auf false steht, wird das HTML-Element eingebunden
  echo " <li class='nav-item'>
  <a id='aboutsenderlink_lbl' class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#stationinfo_modal' ><i class='fas fa-info-circle'></i> " . $ext_lang['stationinfo_navbar_title'] . " <span id='lfmdisplaynamelabelcontainer'></span></a></li>
</li>";
}
?>
        
          </ul>
          <ul class="navbar-nav ms-auto">
          <?php
// Überprüfen, ob $playwith auf false steht
if ($playwith === false) {
  // Wenn $playwith auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $playwith nicht auf false steht, wird das HTML-Element eingebunden
  echo " <li><a class='nav-link' data-bs-toggle='modal' data-bs-target='#playwith_modal' href='#'><i class='far fa-play-circle'></i> " . $ext_lang['playwith_navbar_title'] . "</a></li>";
}
?>
          <li class='nav-item'>
          <li class="nav-link bg-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: yellow;"></i></a></li>
          </li>
          <li class='nav-item'>
          <li><a class='nav-link' data-bs-toggle="modal" data-bs-target="#settings_oop_modal" href="#"><i class="fas fa-cog"></i> <span class="d-md-none">Settings</span></a></li>
          </li> 
          <li class='nav-item'>
          <li><a class='nav-link' data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#"><span class="pangomfont  badge bg-dark text-light"><!--<i class="fas fa-music"></i>--> 🎶 Pan<span class="pangomfont text-danger">Play</span></span></a></li>
          </li> 
        </ul>


    </div>
  </div>
</nav>