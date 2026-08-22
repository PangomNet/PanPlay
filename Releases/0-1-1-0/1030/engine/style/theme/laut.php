<?php
 $backgroundColor = '#373b4b';
 $textColor = 'white';
 $markColor = 'rgba(59, 59, 59, 0.63)';
 $baropacity = '55, 59, 75, 1';
 $blurfactor = '50px';
 $markColor = '#2d5454';
         


 $css = <<<HTML

 HTML;







 echo $css;
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
 
         #topnavbar, .modal-content, .modal-footer, .modal-header, #oop_player{
             background-color:rgba($baropacity) !important;
         }
        
         #playercontrolbar {background: #1d2133;}
 
         #oolfm_currentshow, #oolfm_songcover, #oolfm_current_song { 
             background: rgb(255 255 255 / 0%);
         }
 
         .nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
  color: #fff;
  background-color: #138c74;
}
  .nav-link {
  display: block;
  padding: 0.5rem 1rem;
  color: #138c74; 
  text-decoration: none;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}
 
.text, html, body, button, input, select, textarea, a, nav, p, span, h1, h2, h3, h4, h5 {
    font-family: 'Arial Narrow', 'Roboto Condensed', 'Helvetica Neue Condensed', 'Segoe UI', Arial, sans-serif !important;
}

.pangomfont {
    font-family: 'Rondalo', 'Segoe UI', Arial, sans-serif !important;
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

     
.modal-content {
           border-radius: 9px;}


#about_oop_modal .modal-content {
         background: radial-gradient(rgba(87,23,23,0.35) 0%,rgb(161,0,0) 100%);}

         #settings_oop_modal .modal-header {
         background: linear-gradient(135deg, rgb(143, 143, 143) 0%, rgb(0 0 0) 27%, rgb(217, 0, 0) 57%, rgb(1, 1, 1) 84%, rgb(107, 0, 62) 100%);}

         #sendeplan_modal .panplay-schedule-entry {
           color: #f4f5f8 !important;
           background-color: #2b2f40 !important;
           border-color: #5a6075 !important;
         }
         #sendeplan_modal .panplay-schedule-entry p,
         #sendeplan_modal .panplay-schedule-entry small,
         #sendeplan_modal .panplay-schedule-entry span[role='button'],
         #sendeplan_modal .panplay-schedule-description,
         #sendeplan_modal .panplay-schedule-entry span[role='button']:hover,
         #sendeplan_modal .panplay-schedule-entry span[role='button']:active {
           color: #f4f5f8 !important;
         }

        
     </style>";
?>
