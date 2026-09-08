<?php
$css = <<<'CSS'
<style>
:root { color-scheme: light; --w9-face:#c0c0c0; --w9-light:#fff; --w9-shadow:#808080; --w9-dark:#000; --w9-blue:#000080; }
html, body, button, input, select, textarea { color:#000 !important; font-family:'MS Sans Serif',Tahoma,Geneva,sans-serif !important; font-size:13px; letter-spacing:0; -webkit-font-smoothing:none; font-smooth:never; text-rendering:geometricPrecision; }
body { background-color:#008080 !important; background-size:cover; }
img, .fa, .fas, .far, .fab { image-rendering:pixelated; }
*, *::before, *::after { border-radius:0 !important; }
#blurlayer { position:fixed; inset:0; z-index:-100; background:rgba(0,128,128,.72); -webkit-backdrop-filter:none; backdrop-filter:none; }
#topnavbar, #playercontrolbar { color:#000 !important; background:var(--w9-face) !important; border-color:var(--w9-light) var(--w9-dark) var(--w9-dark) var(--w9-light) !important; box-shadow:inset 1px 1px var(--w9-light),inset -1px -1px var(--w9-shadow) !important; }
#topnavbar *, #playercontrolbar *, #muter, #muter i { color:#000 !important; text-shadow:none !important; }
#topnavbar .pangomfont.badge.bg-dark { color:#fff !important; background:var(--w9-blue) !important; border:2px inset var(--w9-light) !important; }
#topnavbar .pangomfont.badge.bg-dark .text-danger { color:#ff8080 !important; }
#oop_player { color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; box-shadow:none !important; }
#oop_player h1, #oop_player h2, #oop_player h3, #oop_player h4, #oop_player h5, #oop_player p, #oop_player span, #oop_player small, #oop_player a, #oolfm_current_song, #oolfm_currentshow { color:#000 !important; text-shadow:none !important; }
#oop_player .baseaudio-badge { color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; box-shadow:none !important; }
#oop_player .baseaudio-badge i { color:#000 !important; }
.modal-backdrop.show { opacity:.58; background:#000 !important; }
.modal .modal-content { color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; box-shadow:4px 4px 0 rgba(0,0,0,.45) !important; overflow:hidden; }
.modal .modal-content > .modal-header:first-child { min-height:34px; padding:4px 5px !important; color:#fff !important; background:var(--w9-blue) !important; border:0 !important; }
.modal .modal-content > .modal-header:not(:first-child) { color:#000 !important; background:var(--w9-face) !important; border-top:1px solid var(--w9-shadow) !important; border-bottom:1px solid var(--w9-light) !important; }
.modal .modal-content > .modal-header:first-child .modal-title, .modal .modal-content > .modal-header:first-child a, .modal .modal-content > .modal-header:first-child i, .modal .modal-content > .modal-header:first-child h1, .modal .modal-content > .modal-header:first-child h2, .modal .modal-content > .modal-header:first-child h3, .modal .modal-content > .modal-header:first-child h4, .modal .modal-content > .modal-header:first-child h5 { color:#fff !important; text-shadow:none !important; }
.modal .modal-content > .modal-header:first-child button[aria-label='Close'] { display:inline-flex; width:25px; height:23px; flex:0 0 25px; align-items:center; justify-content:center; margin:0 !important; padding:0 !important; color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; border-radius:0 !important; box-shadow:none !important; opacity:1 !important; text-shadow:none !important; }
.modal .modal-content > .modal-header:first-child button[aria-label='Close'] i { color:#000 !important; }
.modal .modal-content > .modal-header:first-child button[aria-label='Close']:active { border-style:inset !important; }
.modal .modal-body, .modal .modal-footer, .modal .card, .modal .card-header, .modal .card-body, .modal .accordion-item, .modal .accordion-button { color:#000 !important; background:var(--w9-face) !important; }
.modal .card { border:2px groove var(--w9-light) !important; box-shadow:none !important; }
.modal .card-header { border-bottom:1px solid var(--w9-shadow) !important; }
.modal .modal-body p, .modal .modal-body h1, .modal .modal-body h2, .modal .modal-body h3, .modal .modal-body h4, .modal .modal-body h5, .modal .modal-body h6, .modal .modal-body label, .modal .modal-body small, .modal .modal-body span, .modal .modal-body i, .modal .modal-body .text-light, .modal .modal-body .text-white, .modal .modal-body .text-muted, .modal .list-group-item { color:#000 !important; text-shadow:none !important; }
.modal .list-group-item { background:#fff !important; border:1px solid var(--w9-shadow) !important; }
.modal .btn, .modal .nav-link, #playpausebtn, #cast { color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; box-shadow:none !important; text-shadow:none !important; }
.modal .btn:active, .modal .btn.active, .modal .btn-check:checked + .btn, .modal .nav-link.active { color:#fff !important; background:var(--w9-blue) !important; border-style:inset !important; }
.modal .btn:active *, .modal .btn.active *, .modal .btn-check:checked + .btn *, .modal .nav-link.active * { color:#fff !important; }
.modal .badge, .modal a.badge, .modal .rounded-pill { color:#000 !important; background:var(--w9-face) !important; border:2px outset var(--w9-light) !important; box-shadow:none !important; text-shadow:none !important; }
.modal .badge *, .modal a.badge * { color:#000 !important; }
#currentsong_lastplayed_modal_lbl_holder a { color:#fff !important; background:var(--w9-blue) !important; border:2px inset var(--w9-light) !important; }
#currentsong_lastplayed_modal_lbl_holder a * { color:#fff !important; }
.modal .form-control, .modal .form-select { color:#000 !important; background:#fff !important; border:2px inset var(--w9-light) !important; box-shadow:none !important; }
.modal .alert { color:#000 !important; background:#ffffe1 !important; border:2px inset var(--w9-light) !important; }
#about_oop_modal .about-extension-credit { padding:8px; color:#fff !important; background:var(--w9-blue) !important; border:2px inset var(--w9-light) !important; }
#about_oop_modal .about-extension-credit * { color:#fff !important; }
.modal a:not(.btn):not(.badge), .modal .modal-body a:not(.btn):not(.badge) { color:#000 !important; text-decoration:none !important; }
.modal a:not(.btn):not(.badge):hover, .modal a:not(.btn):not(.badge):focus, .modal .modal-body a:not(.btn):not(.badge):hover, .modal .modal-body a:not(.btn):not(.badge):focus { color:#000080 !important; text-decoration:underline !important; }
.modal a.btn, .modal a.btn:hover, .modal a.btn:focus, .modal a.btn:active, .modal a.badge, .modal a.badge:hover, .modal a.badge:focus, .modal a.badge:active { text-decoration:none !important; }
#cast, #cast:hover, #cast:focus, #cast i { color:#000 !important; text-decoration:none !important; }
#playwith_modal #lfmlink_lautfm svg path { fill:#000 !important; }
#playwith_modal #lfmlink_tunein img { filter:grayscale(1) brightness(0) !important; }
body *::-webkit-scrollbar { width:16px; height:16px; }
body *::-webkit-scrollbar-thumb, body *::-webkit-scrollbar-button { background:var(--w9-face); border:2px outset var(--w9-light); }
body *::-webkit-scrollbar-track { background:repeating-conic-gradient(#fff 0 25%,#c0c0c0 0 50%) 0/2px 2px; }
</style>
CSS;
echo $css;
?>
