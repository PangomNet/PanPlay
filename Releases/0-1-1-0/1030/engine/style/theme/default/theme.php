<?php
 $backgroundColor = '#1a1b23';
 $textColor = 'white';
 $markColor = 'rgba(59, 59, 59, 0.63)';
 $baropacity = '59, 59, 59, 0.63';
 $blurfactor = '50px';
 $markColor = '#2d5454';
         



         echo "<style>

         :root {
            color-scheme: dark;
          }

          .bg-success {background-color: rgb(55 59 75) !important;}
          
          .modal-header {border-bottom: 0px;}
 
          body, html, nav, .btn-close, .accordion, .accordion-item, .accordion-button, .dropdown-menu {
            background-color: $backgroundColor;
            color: $textColor !important;
            backdrop-filter: blur($blurfactor);
            -webkit-backdrop-filter: blur($blurfactor); /* Für Safari */
            background-size: cover;
        }

        figcaption {
            background-color: #ffffff00;
            color: $textColor !important;
            backdrop-filter: blur($blurfactor);
            background-size: cover;      
        }
    
        .blockquote-footer {
            color: $textColor !important;
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
            background-color: #13868c !important;
            border-color: #13868c !important; 
         }
 
         #topnavbar, #playercontrolbar, .modal-content, .modal-footer, .modal-header, #oop_player{
             background-color:rgba($baropacity) !important;
             -webkit-backdrop-filter: blur(100px);
             backdrop-filter: blur(100px);
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
             -webkit-backdrop-filter: blur(25px); /* Für Safari */
             backdrop-filter: blur(25px);

         }
#about_oop_modal .modal-content {
         background: radial-gradient(rgba(87,23,23,0.35) 0%,rgb(161,0,0) 100%);}

         #settings_oop_modal .modal-header, #about_oop_modal .modal-header {
         background: linear-gradient(135deg, rgb(143, 143, 143) 0%, rgb(0 0 0) 27%, rgb(217, 0, 0) 57%, rgb(1, 1, 1) 84%, rgb(107, 0, 62) 100%);}

         #sendeplan_modal .panplay-schedule-entry {
             color: #fff !important;
             background: transparent !important;
             border-color: rgba(255, 255, 255, 0.2) !important;
         }

         #sendeplan_modal .panplay-schedule-entry p,
         #sendeplan_modal .panplay-schedule-entry small,
         #sendeplan_modal .panplay-schedule-entry span[role='button'],
         #sendeplan_modal .panplay-schedule-description {
             color: #fff !important;
         }

         #sendeplan_modal .panplay-current-schedule-entry {
             background: radial-gradient(circle at center, rgba(255, 255, 255, 0.13) 0%, rgba(255, 255, 255, 0.035) 58%, rgba(255, 255, 255, 0) 100%) !important;
             box-shadow: inset 0 0 14px rgba(255, 255, 255, 0.08), 0 2px 10px rgba(0, 0, 0, 0.18);
         }

  


        
     </style>";
?>
