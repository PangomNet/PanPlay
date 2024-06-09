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
             backdrop-filter: blur(100px)
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

         #about_oop_modal .modal-dialog .modal-content .modal-body {
            background: #242425;
            background: -webkit-linear-gradient(310deg, #242425 0%, #dc3545 100%);
            background: -o-linear-gradient(310deg, #242425 0%, #dc3545 100%);
            background: linear-gradient(140deg, #242425 0%, #dc3545 100%);
          } 

        
     </style>";
?>