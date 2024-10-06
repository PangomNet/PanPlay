<?php
  $backgroundColor = '#ffffff';
  $textColor = '000000';
  $baropacity = '59, 59, 59, 0.63';
  $blurfactor = '50px';
  $markColor = '#001e39';




$css = "
<style>

body, html, figcaption, nav, .btn-close, .accordion, .accordion-item, .accordion-button, .dropdown-menu{
    background-color: $backgroundColor;
    color: $textColor;
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
</style>";







  echo $css;
?>