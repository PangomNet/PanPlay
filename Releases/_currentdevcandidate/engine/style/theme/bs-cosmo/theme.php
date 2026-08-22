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
     backdrop-filter: none;
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
   padding: 3px 15px !important;
 }
 
 .btn:hover,
 .btn:focus {
   outline: 0 !important;
 }
 
 .btn:active {
   border-right: 1px solid #fff !important;
   border-bottom: 1px solid #fff !important;
   border-left: 1px solid #848484 !important;
   border-top: 1px solid #848484 !important;

 }




 a {
     color: $textColor !important;

 }
 a:hover, a:focus {
     color: white !important;

 }
 #topnavbar .pangomfont.badge.bg-dark {
     color: #fff !important;
     background: #10253d !important;
     border: 1px solid #7fb6ea !important;
 }
 #topnavbar .pangomfont.badge.bg-dark .text-danger {
     color: #ff6c7c !important;
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
     background: rgb(255 255 255 / 0%);
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

 #sendeplan_modal .panplay-schedule-entry {
     color: #f5f8fb !important;
     background-color: #203a55 !important;
     border-color: #557896 !important;
 }
 #sendeplan_modal .panplay-schedule-entry p,
 #sendeplan_modal .panplay-schedule-entry small,
 #sendeplan_modal .panplay-schedule-entry span[role='button'],
 #sendeplan_modal .panplay-schedule-description,
 #sendeplan_modal .panplay-schedule-entry span[role='button']:hover,
 #sendeplan_modal .panplay-schedule-entry span[role='button']:active {
     color: #f5f8fb !important;
 }

 .modal .modal-content > .modal-header:first-child button[aria-label='Close'] {
     display: inline-flex;
     width: 38px;
     height: 30px;
     align-items: center;
     justify-content: center;
     padding: 0 !important;
     border-radius: 0 !important;
     box-shadow: none !important;
     opacity: 1 !important;
 }

 #settings_oop_modal .btn-danger,
 #settings_oop_modal .btn-outline-danger {
     border-radius: 0 !important;
     border: 1px solid #1967be !important;
     box-shadow: none !important;
 }

 #settings_oop_modal .btn-outline-danger {
     color: #1967be !important;
     background: #fff !important;
 }

 #settings_oop_modal .btn-danger,
 #settings_oop_modal .btn-check:checked + .btn-outline-danger {
     color: #fff !important;
     background: #2780e3 !important;
 }

 #settings_oop_modal .badge.bg-danger {
     color: #fff !important;
     background-color: #1967be !important;
     border-radius: 0 !important;
 }







</style>";
               
               
               
               
               
               
               
echo $css;

?>
