<?php
                 $backgroundColor = '#d4d0c8';
                 $textColor = 'black';
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


 h1 { font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } h3 { font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px; } p, btn, nav, html, .modal-title, body { border-radius: 0px; font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px; } blockquote { font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; } pre { font-family: Tahoma, Verdana, Segoe, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5714px; }

 .btn, .dropdown-menu, .modal-content, nav, input, div {
     border-radius: 0 0 0 0 !important;
   }
   .dropdown-menu, .alert, .card, .modal-content {
     border: 1px outset;
   }
   
   .dropdown-item:hover, .dropdown-item:focus {
     color: white !important;
     background-color: #001e39 !important;
    }
    .dropdown-item.active, .dropdown-item:active {
      color: #fff;
      text-decoration: none;
     background-color: #001e39 !important;
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

 #playpausebtn {
     background-color: #d4d0c8 !important;
     margin: 3px;
     border: 1px outset;
     &:active {
         border: 1px inset;
       }
 }
 #playpausebtn > i {
     color: black !important;
 }


 a {
     color: $textColor !important;

 }
 a:hover, a:focus {
     color: blue !important;

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
     background-color: #3a6ea5;
 }

 .navbar-dark .navbar-toggler {
     color: black;
     border: 1px outset;
     &:active {
       border: 1px inset;
     }
   }

   body *::-webkit-scrollbar {
     width: 16px;
     height: 16px;
     background: none;
   }
   
   body *::-webkit-scrollbar-thumb, body *::-webkit-scrollbar-button {
     width: 16px;
     height: 16px;
     background: silver;
     box-shadow: inset 1px 1px #dfdfdf, inset -1px -1px gray;
     border: 1px solid;
     border-color: silver #000 #000 silver;
   }
   
   body *::-webkit-scrollbar-track {
     image-rendering: optimizeSpeed;
     image-rendering: pixelated;
     image-rendering: optimize-contrast;
     background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgLTAuNSAyIDIiIHNoYXBlLXJlbmRlcmluZz0iY3Jpc3BFZGdlcyI+CjxtZXRhZGF0YT5NYWRlIHdpdGggUGl4ZWxzIHRvIFN2ZyBodHRwczovL2NvZGVwZW4uaW8vc2hzaGF3L3Blbi9YYnh2Tmo8L21ldGFkYXRhPgo8cGF0aCBzdHJva2U9IiNjMGMwYzAiIGQ9Ik0wIDBoMU0xIDFoMSIgLz4KPC9zdmc+');
     background-position: 0 0;
     background-repeat: repeat;
     background-size: 2px;
   }
   
   body *::-webkit-scrollbar-button {
     background-repeat: no-repeat;
     background-size: 16px;
   }
   
   body *::-webkit-scrollbar-button:single-button:vertical:decrement {
     background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgLTAuNSAxNiAxNiIgc2hhcGUtcmVuZGVyaW5nPSJjcmlzcEVkZ2VzIj4KPG1ldGFkYXRhPk1hZGUgd2l0aCBQaXhlbHMgdG8gU3ZnIGh0dHBzOi8vY29kZXBlbi5pby9zaHNoYXcvcGVuL1hieHZOajwvbWV0YWRhdGE+CjxwYXRoIHN0cm9rZT0iIzAwMDAwMCIgZD0iTTcgNWgxTTYgNmgzTTUgN2g1TTQgOGg3IiAvPgo8L3N2Zz4=');
   }
   
   body *::-webkit-scrollbar-button:single-button:vertical:increment {
     background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgLTAuNSAxNiAxNiIgc2hhcGUtcmVuZGVyaW5nPSJjcmlzcEVkZ2VzIj4KPG1ldGFkYXRhPk1hZGUgd2l0aCBQaXhlbHMgdG8gU3ZnIGh0dHBzOi8vY29kZXBlbi5pby9zaHNoYXcvcGVuL1hieHZOajwvbWV0YWRhdGE+CjxwYXRoIHN0cm9rZT0iIzAwMDAwMCIgZD0iTTQgNWg3TTUgNmg1TTYgN2gzTTcgOGgxIiAvPgo8L3N2Zz4=');
   }
   
   body *::-webkit-scrollbar-button:single-button:horizontal:decrement {
     background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgLTAuNSAxNiAxNiIgc2hhcGUtcmVuZGVyaW5nPSJjcmlzcEVkZ2VzIj4KPG1ldGFkYXRhPk1hZGUgd2l0aCBQaXhlbHMgdG8gU3ZnIGh0dHBzOi8vY29kZXBlbi5pby9zaHNoYXcvcGVuL1hieHZOajwvbWV0YWRhdGE+CjxwYXRoIHN0cm9rZT0iIzAwMDAwMCIgZD0iTTggM2gxTTcgNGgyTTYgNWgzTTUgNmg0TTYgN2gzTTcgOGgyTTggOWgxIiAvPgo8L3N2Zz4=');
   }
   
   body *::-webkit-scrollbar-button:single-button:horizontal:increment {
     background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgLTAuNSAxNiAxNiIgc2hhcGUtcmVuZGVyaW5nPSJjcmlzcEVkZ2VzIj4KPG1ldGFkYXRhPk1hZGUgd2l0aCBQaXhlbHMgdG8gU3ZnIGh0dHBzOi8vY29kZXBlbi5pby9zaHNoYXcvcGVuL1hieHZOajwvbWV0YWRhdGE+CjxwYXRoIHN0cm9rZT0iIzAwMDAwMCIgZD0iTTYgM2gxTTYgNGgyTTYgNWgzTTYgNmg0TTYgN2gzTTYgOGgyTTYgOWgxIiAvPgo8L3N2Zz4=');
   }
   
   body *::-webkit-scrollbar-corner {
     background: silver;
   }
   
   /* dakedres was here ;3 */ oO Thankyou for making this ;)


   .btn-check:checked + .btn-outline-success, .btn-check:active + .btn-outline-success, .btn-outline-success:active, .btn-outline-success.active, .btn-outline-success.dropdown-toggle.show {
     color: #fff !important;
     background-color: #00133b !important;
     border-color: #000000 !important;
     border: 1px inset !important;
 }


 .loader-body {

     background: black !important;
 }
 
 .loader {
     width: 10px;
     height: 10px;
     content: ' . . . . . ';
 }
</style>";
               
               
               
               
               
               
               
echo $css;

?>