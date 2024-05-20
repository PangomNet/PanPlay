<?php

$baropacity = '0,1,2,1';
// Überprüfen, ob die Parameter bcolor und tcolor vorhanden sind und gültige Hexcodes sind
if (isset($_GET['bcolor']) && preg_match('/^[a-f0-9]{6}$/i', $_GET['bcolor'])) {
    $backgroundColor = '#' . $_GET['bcolor'];
}

if (isset($_GET['tcolor']) && preg_match('/^[a-f0-9]{6}$/i', $_GET['tcolor'])) {
    $textColor = '#' . $_GET['tcolor'];
}

if (isset($_GET['baropacity']) && preg_match('/^[a-f0-9]{6}$/i', $_GET['baropacity'])) {
    $baropacity = '' . $_GET['baropacity'];
}
$markColor = '#2d5454';
$blurfactor = '50';


echo "<style>

body, html, nav, figcaption, .btn-close, .accordion, .accordion-item, .accordion-button, .dropdown-menu{
    background-color: $backgroundColor;
    color: $textColor !important;
    backdrop-filter: blur($blurfactor);
    background-size: cover;

}
.dropdown-item:hover, .dropdown-item:focus {
   /* color: #1e2125; */
   background-color:$markColor !important;
  }
  .dropdown-item.active, .dropdown-item:active {
    color: #fff;
    text-decoration: none;
    background-color:$markColor !important;
}
a {
    color: $textColor !important;

}
a:hover, a:focus {
    color: $textColor !important;

}
:root {
    --bs-primary: #138c74;
    --bs-success: #138c74;
    --bs-pink: #138c74;
}
.btn-success {
    color: #fff;
    background-color: #138c74;
    border-color: #138c74;
}

#topnavbar, #playercontrolbar, .modal-content, .modal-footer, .modal-header, #oop_player{
    background-color:rgba($baropacity) !important;
    backdrop-filter: blur(100px);
}

#oolfm_currentshow, #oolfm_songcover, #oolfm_current_song { 
    rgb(255 255 255 / 0%)
}


#blurlayer {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -100;
    width: 100%;
    height: 100vh;
    backdrop-filter: blur(25px);
}

.loader-body {

    background: black !important;
}
</style>";


?>