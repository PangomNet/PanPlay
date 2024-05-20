<nav id="topnavbar" class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
       <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">
     <oop_div id="oolfm_stationimg">
   <?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn lfmstream einen Wert hat, wird der Code ausgeführt
if (!empty($lfmstream)):
?>
<div id="api_lfm_station_img">Loading...</div>
<script type="text/html" id="station_img_template" charset="utf-8">
<% if (this.image) { %>
<%= "<img src='" + this.image + "' alt='Station Image'>" %>
<% } else { %>
<%= "<img id ='current_station_img' src='https://api.laut.fm/station/" + "<?php echo $lfmstream; ?>" + "/images/station' alt='Placeholder Image' width='30'>" %>
<% } %>
</script>
<script type="text/html" id="station_img__about_template" charset="utf-8">
<% if (this.image) { %>
<%= "<img src='" + this.image + "' alt='Station Image'>" %>
<% } else { %>
<%= "<img id ='current_station_img_about' class='rounded' alt='$lfmstream' src='https://api.laut.fm/station/" + "<?php echo $lfmstream; ?>" + "/images/station' width='100%' max-width='350px'>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
try {
    laut.fm.station('<?php echo $lfmstream; ?>').info({container:'api_lfm_station_img', template:'station_img_template'}, true);
} catch(error) {
    errorHandler(error.message);
}
</script>
<script type="text/javascript" charset="utf-8">
try {
    laut.fm.station('<?php echo $lfmstream; ?>').info({container:'stationlogoholder', template:'station_img__about_template'}, true);
} catch(error) {
    errorHandler(error.message);
}
</script>

<?php endif; ?>
    </oop_div>
    </a>
    <a class="navbar-brand d-none d-sm-block" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">  <oop_div class="" id="oolfm_stationname">
<?php
    $lfmstream = $_GET['lfmstream'];
    echo '<div id="api_lfm_display_name">Loading...</div>';
    echo '<script type="text/html" id="display_name_template" charset="utf-8">';
    echo '<%= "" + this.display_name %>';
    echo '</script>';
    echo '<script type="text/html" id="display_name_template2" charset="utf-8">';
    echo '<%= "<i class=\'fas fa-info-circle\'></i> Über \'" + this.display_name  + "\'" %>';
    echo '</script>';
    echo '<script type="text/html" id="display_name_template3" charset="utf-8">';
    echo '<%= "<i class=\'fas fa-info-circle\'></i> Über \'" + this.display_name  + "\'" %>';
    echo '</script>';
    echo '<script type="text/html" id="display_name_template4" charset="utf-8">';
    echo '<%= this.display_name   %>';
    echo '</script>';
    echo '<script type="text/html" id="display_name_template5" charset="utf-8">';
    echo '<%= this.display_name   %>';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'api_lfm_display_name\', template:\'display_name_template\'}, true);';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'aboutsenderlink_lbl\', template:\'display_name_template2\'}, true);';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'aboutModaltitleLabel\', template:\'display_name_template3\'}, true);';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'thisstationname_about_lbl\', template:\'display_name_template4\'}, true);';
    echo '</script>';
    echo '<script type="text/javascript" charset="utf-8">';
    echo 'laut.fm.station(\'' . $lfmstream . '\')';
    echo '.info({container:\'mviewstationname\', template:\'display_name_template5\'}, true);';
    echo '</script>';
?>
</oop_div> </a>

<?php
// Annahme: Die Variablen $stationinfo, $trackhistory und $sendeplan sind bereits als boolean gesetzt

// Überprüfen, ob alle Variablen auf false stehen und ob es sich um die mobile Ansicht handelt
if ($stationinfo === false && $trackhistory === false && $sendeplan === false) {
    // Wenn alle Bedingungen erfüllt sind, wird das <a>-Element eingefügt

   echo " <a id='mviewstationname' class='navbar-brand d-block d-lg-none' href='#'></a> ";

}
?>


<div class="d-block d-sm-none btn-group btn-lg" role="group" aria-label="Basic outlined example">



<?php
// Überprüfen, ob $trackhistory auf false steht
if ($trackhistory === false) {
  // Wenn $trackhistory auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $trackhistory nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-dark btn-lg' href='#' data-bs-toggle='modal' data-bs-target='#lastplayed_modal'><i class='fas fa-history'></i></button>";
}
?>
<?php
// Überprüfen, ob $sendeplan auf false steht
if ($sendeplan === false) {
  // Wenn $sendeplan auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $sendeplan nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-dark btn-lg' href='#' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-calendar-week'></i></button>";
}
?>
<?php
// Überprüfen, ob $stationinfo auf false steht
if ($stationinfo === false) {
  // Wenn $stationinfo auf false steht, wird das HTML-Element nicht eingebunden
} else {
  // Wenn $stationinfo nicht auf false steht, wird das HTML-Element eingebunden
  echo "<button type='button' class='btn btn-dark btn-lg'href='#' data-bs-toggle='modal' data-bs-target='#stationinfo_modal' ><i class='fas fa-info-circle'></i></button>";
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
  <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#lastplayed_modal'><i class='fas fa-history'></i> Titelhistorie</a>
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
  <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#sendeplan_modal'><i class='fas fa-calendar-week'></i> Sendeplan</a></li>
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
  <a id='aboutsenderlink_lbl' class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#stationinfo_modal' ><i class='fas fa-info-circle'></i> Über ''</a></li>
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
  echo " <li><a class='nav-link' data-bs-toggle='modal' data-bs-target='#playwith_modal' href='#'><i class='far fa-play-circle'></i> Player wechseln</a></li>";
}
?>
          <li class='nav-item'>
          <li class="nav-link alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>
          </li>
          <li class='nav-item'>
          <li><a class='nav-link' data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#"><span class="badge bg-info text-dark"><i class="fas fa-question-circle"></i> oOPlayer</span></a></li>
          </li> 
        </ul>


    </div>
  </div>
</nav>