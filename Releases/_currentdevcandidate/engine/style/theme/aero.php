<?php
 $backgroundColor = '#1a1b23';
 $textColor = 'white';
 $markColor = 'rgba(59, 59, 59, 0.63)';
 $baropacity = '59, 59, 59, 0.63';
 $blurfactor = '50px';
 $markColor = '#2d5454';
         


 $css = <<<HTML

 HTML;







 echo $css;
         echo "<style>

         :root {
            color-scheme: dark;
          }

          .bg-success {rgb(55 59 75) !important;}
          
          .modal-header {border-bottom: 0px;}
 
          body, html, nav, .btn-close, .accordion, .accordion-item, .accordion-button, .dropdown-menu {
            background-color: $backgroundColor;
            color: $textColor !important;
            backdrop-filter: blur($blurfactor);
            -webkit-backdrop-filter: blur($blurfactor); /* Für Safari */
            background-size: cover;
        }

        figcaption
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
             color: #13285e !important;
     
         }
         a:hover, a:focus {
             color: #13285e !important;
     
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
                         -webkit-backdrop-filter: blur(100px);
             backdrop-filter: blur(100px)
         }

         
         #topnavbar, #playercontrolbar{
                           background: linear-gradient(180deg, rgb(228, 239, 249) 0%, 0%, rgb(228, 239, 249) 0%, 0%, rgb(228, 239, 249) 0%, 0%, rgb(228, 239, 249) 0%, 0%, rgb(228, 239, 249) 0%, 2%, rgb(228, 239, 249) 4%, 8%, rgb(228, 239, 249) 12%, 18%, rgb(217, 230, 244) 24%, 50%, rgb(217, 230, 244) 76%, 78%, rgb(217, 230, 244) 80%, 82%, rgb(217, 230, 244) 84%, 86%, rgb(217, 230, 244) 88%, 90%, rgb(217, 230, 244) 92%, 94%, rgb(217, 230, 244) 96%, 98%, rgb(216, 229, 242) 100%);#
                           color: #13285e;
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
             -webkit-backdrop-filter: blur(25px); /* Für Safari */
             backdrop-filter: blur(25px);

         }

         #about_oop_modal .modal-body  {
            background: #242425;
            background: -webkit-linear-gradient(310deg, #242425 0%, #dc3545 100%);
            background: -o-linear-gradient(310deg, #242425 0%, #dc3545 100%);
            background: linear-gradient(140deg, #242425 0%, #dc3545 100%);
          } 


         #currentsong_lastplayed_modal_lbl_holder a{
    background: linear-gradient(90deg, rgb(232, 243, 254) 0%, 16.9728%, rgb(180, 215, 248) 33.9456%, 56.4198%, rgb(184, 217, 250) 68.1852%, 84.0926%, rgb(213, 234, 254) 100%);
}
  

.modal-content {
    background: linear-gradient(45deg, rgba(176, 197, 216, 0.63) 0%, 6.4291%, rgba(133, 174, 218, 0.83) 12.8582%, 18.6627%, rgb(139, 180, 224) 24.4673%, 33.3578%, rgb(128, 172, 217) 42.2483%, 47.0242%, rgb(138, 181, 224) 51.8001%, 55.6943%, rgb(128, 171, 214) 59.9559%, 65.687%, rgb(125, 168, 211) 71.4181%, 79.3167%, rgb(136, 178, 220) 87.2153%, 93.6076%, rgb(155, 190, 228) 100%); }

.btn-outline-danger {
    background: radial-gradient(circle at -60% 50%, #0007 5% 10%, #0000 50%), radial-gradient(circle at 160% 50%, #0007 5% 10%, #0000 50%), linear-gradient(#e0a197e5, #cf796a 25% 50%, #d54f36 50%);
    box-shadow: inset 0 0 0 1px #fffa;
border: none;
color: white;
    }


    .text-light, .modal-title, h5, .list-group{
    /* --bs-text-opacity: 1; */
    color: #13285e !important;
}

.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color: #13285e;
}

.nav-link {
  display: block;
  padding: 0.5rem 1rem;
  color: #13285e; 
  text-decoration: none;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}
@media (prefers-reduced-motion: reduce) {
  .nav-link {
    transition: none;
  }
}

#about_oop_modal .modal-content {
         background: radial-gradient(rgba(87,23,23,0.35) 0%,rgb(161,0,0) 100%);}

         #settings_oop_modal .modal-header {
         background: linear-gradient(135deg, rgb(143, 143, 143) 0%, rgb(0 0 0) 27%, rgb(217, 0, 0) 57%, rgb(1, 1, 1) 84%, rgb(107, 0, 62) 100%);}
        
     </style>";
?>