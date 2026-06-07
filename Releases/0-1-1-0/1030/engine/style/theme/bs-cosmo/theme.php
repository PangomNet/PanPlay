<?php
                 $backgroundColor = '#192d44';
                 $textColor = 'white';
                 $baropacity = '212, 208, 200, 1';
                 $blurfactor = '';
                 $markColor = '#001e39';


$css = "
<style>
 
 body, figcaption, nav, .btn-close, .accordion, .accordion-item, .accordion-button, .dropdown-menu{
     background-color: $backgroundColor;
     color: $textColor !important;
     backdrop-filter: blur($blurfactor);
     background-size: cover;

 }




 .btn, .dropdown-menu, .modal-content, nav, input, div {
     border-radius: 0 0 0 0 !important;
   }
   .dropdown-menu, .alert, .card, .modal-content {
     border: 1px outset;
   }
   
   .dropdown-item:hover, .dropdown-item:focus {
     color: white !important;
    }
    .dropdown-item.active, .dropdown-item:active {
      color: #fff;
      text-decoration: none;
  }



 
 .btn {
     border: 1px outset;
   padding: 3px 15px 3px 15px important;
   &:active {
     border: 1px inset;
   }
 }
 
 .btn:hover,
 .btn:focus {
   outline: 0 important;
 }
 
 .btn:active {
   border-right: 1px solid #fff important;
   border-bottom: 1px solid #fff important;
   border-left: 1px solid #848484 important;
   border-top: 1px solid #848484 important; 

 }




 a {
     color: $textColor !important;

 }
 a:hover, a:focus {
     color: white !important;

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
     background-color: $backgroundColor;
 }


 


 .loader-body {

     background: black !important;
 }
 
 .loader {
     width: 10px;
     height: 10px;
     content: ' . . . . . ';
 }


#about_oop_modal .modal-content {
         background: radial-gradient(rgba(87,23,23,0.35) 0%,rgb(161,0,0) 100%);}

         #settings_oop_modal .modal-header {
         background: linear-gradient(135deg, rgb(143, 143, 143) 0%, rgb(0 0 0) 27%, rgb(217, 0, 0) 57%, rgb(1, 1, 1) 84%, rgb(107, 0, 62) 100%);}







</style>";
               
               
               
               
               
               
               
echo $css;

?>