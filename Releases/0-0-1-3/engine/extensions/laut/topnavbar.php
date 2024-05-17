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
<%= "<img src='https://api.laut.fm/station/" + "<?php echo $lfmstream; ?>" + "/images/station' alt='Placeholder Image' width='30'>" %>
<% } %>
</script>
<script type="text/javascript" charset="utf-8">
try {
    laut.fm.station('<?php echo $lfmstream; ?>').info({container:'api_lfm_station_img', template:'station_img_template'}, true);
} catch(error) {
    errorHandler(error.message);
}
</script>

<?php endif; ?>
    </oop_div>
    </a>
    <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" href="#">  <oop_div class="d-none d-sm-block" id="oolfm_stationname">
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
?>
</oop_div>
<div class="d-block d-sm-none btn-group" role="group" aria-label="Basic outlined example">
<button type="button" class="btn btn-dark" href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal"><i class="fas fa-history"></i></button>
  <button type="button" class="btn btn-dark" href="#" data-bs-toggle="modal" data-bs-target="#sendeplan_modal"><i class="fas fa-calendar-week"></i></button>
 <button type="button" class="btn btn-dark"href="#" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" ><i class="fas fa-question-circle"></i></button>
</div>
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal"><i class="fas fa-history"></i> Titelhistorie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#sendeplan_modal"><i class="fas fa-calendar-week"></i> Sendeplan</a></li>
        </li>
        <li class="nav-item">
            <a id="aboutsenderlink_lbl" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#stationinfo_modal" >Über ''</a></li>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-chevron-circle-down"></i> mehr </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown10">
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#playwith_modal" href="#"><i class="far fa-play-circle"></i> Andere Player</a></li>
            <li class="alert-danger" style="display:none;" id="openerrorlog_nav"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#openerrorlog" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#about_oop_modal" href="#"><i class="fas fa-question-circle"></i> Über <span class="badge bg-dark">oO</span>Player </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>