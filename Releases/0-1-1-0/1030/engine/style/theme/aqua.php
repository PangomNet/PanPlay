<?php
$css = <<<'CSS'
<style>
:root { color-scheme:light; --aqua-ink:#1f2936; --aqua-blue:#1476d4; --aqua-line:#8192a5; --aqua-silver:#e8ebef; }
html, body, button, input, select, textarea { font-family:'Lucida Grande','Lucida Sans Unicode',Verdana,sans-serif !important; letter-spacing:0; }
body { color:var(--aqua-ink); background-image:linear-gradient(180deg,#6fa9dc 0%,#b8d7ee 55%,#7da9ca 100%) !important; background-attachment:fixed !important; }
#blurlayer { position:fixed; inset:0; z-index:0; pointer-events:none; background:linear-gradient(90deg,rgba(255,255,255,.07) 50%,rgba(0,0,0,.025) 50%); background-size:4px 4px; -webkit-backdrop-filter:blur(48px) saturate(88%); backdrop-filter:blur(48px) saturate(88%); }
#topnavbar { color:#1c2631 !important; background:linear-gradient(180deg,#fafafa 0%,#d7dbe0 48%,#b5bbc3 52%,#e7eaed 100%) !important; border-bottom:1px solid #66717d !important; box-shadow:inset 0 1px #fff,0 2px 7px rgba(31,47,64,.36) !important; }
#topnavbar * { color:#1c2631 !important; text-shadow:0 1px #fff; }
#oop_player { position:relative; z-index:1; color:#fff !important; background:rgba(28,43,58,.72) !important; border:1px solid rgba(255,255,255,.55) !important; border-radius:14px !important; box-shadow:inset 0 1px rgba(255,255,255,.34),0 14px 36px rgba(20,38,56,.38) !important; }
#oop_player h1, #oop_player h2, #oop_player h3, #oop_player h4, #oop_player h5, #oop_player p, #oop_player span, #oop_player small, #oop_player a, #oolfm_current_song, #oolfm_currentshow, #oolfm_current_song *, #oolfm_currentshow * { color:#fff !important; text-shadow:0 1px 2px #15283a !important; }
.modal-backdrop.show { opacity:.58; -webkit-backdrop-filter:blur(9px); backdrop-filter:blur(9px); }
.modal .modal-content { color:var(--aqua-ink) !important; background:var(--aqua-silver) !important; border:1px solid #596878 !important; border-radius:13px !important; box-shadow:inset 0 1px #fff,0 18px 45px rgba(24,40,58,.58) !important; overflow:hidden; }
.modal .modal-content > .modal-header:first-child { min-height:48px; color:#273544 !important; background:linear-gradient(180deg,#f7f8f9 0%,#d9dde2 48%,#b9c0c8 52%,#e5e8eb 100%) !important; border-bottom:1px solid #7a8794 !important; box-shadow:inset 0 1px #fff; }
.modal .modal-content > .modal-header:not(:first-child) { color:var(--aqua-ink) !important; background:linear-gradient(180deg,#f3f5f7,#d5dbe1) !important; border-color:#98a3ad !important; }
.modal .modal-title, .modal .modal-header *, .modal .modal-footer * { color:var(--aqua-ink) !important; text-shadow:0 1px #fff; }
.modal .modal-header button[aria-label='Close'] { display:inline-flex; width:24px; min-width:24px; max-width:24px; height:24px; min-height:24px; max-height:24px; flex:0 0 24px; align-items:center; justify-content:center; box-sizing:border-box; padding:0 !important; line-height:1 !important; color:#6b0a0a !important; background:linear-gradient(180deg,#ff9b91,#df3f34) !important; border:1px solid #8e1d16 !important; border-radius:50% !important; box-shadow:inset 0 1px rgba(255,255,255,.8),0 1px 2px rgba(0,0,0,.25) !important; opacity:1 !important; }
.modal .modal-body { color:var(--aqua-ink) !important; background:repeating-linear-gradient(0deg,#eef0f2 0,#eef0f2 2px,#e7eaed 2px,#e7eaed 4px) !important; }
.modal .modal-footer { background:linear-gradient(180deg,#e9ecef,#c6ccd3) !important; border-top:1px solid #8d99a5 !important; }
.modal .card, .modal .card-header, .modal .card-body, .modal .list-group-item, .modal .accordion-item, .modal .accordion-button { color:var(--aqua-ink) !important; background:rgba(255,255,255,.68) !important; border-color:#a4afb9 !important; }
.modal .modal-body p, .modal .modal-body h1, .modal .modal-body h2, .modal .modal-body h3, .modal .modal-body h4, .modal .modal-body h5, .modal .modal-body h6, .modal .modal-body label, .modal .modal-body small, .modal .modal-body span, .modal .modal-body i, .modal .text-light, .modal .text-white, .modal .text-muted { color:var(--aqua-ink) !important; }
.modal a:not(.btn):not(.badge) { color:#064e9b !important; }
.modal .btn, .modal .nav-link { color:#172334 !important; background:linear-gradient(180deg,#fff 0%,#e5e8ec 48%,#c0c7cf 52%,#f2f4f6 100%) !important; border:1px solid #748290 !important; border-radius:999px !important; box-shadow:inset 0 1px #fff,0 1px 2px rgba(0,0,0,.17) !important; }
.modal .btn-danger, .modal .btn.active, .modal .btn-check:checked + .btn, .modal .nav-link.active { color:#fff !important; background:linear-gradient(180deg,#69bcff 0%,#1887ed 47%,#0664c2 52%,#3da4f5 100%) !important; border-color:#064f9b !important; text-shadow:0 1px #06498d !important; }
.modal .btn-danger *, .modal .btn.active *, .modal .btn-check:checked + .btn *, .modal .nav-link.active * { color:#fff !important; }
.modal .badge, .modal a.badge { color:#fff !important; background:linear-gradient(180deg,#67b8f8,#096ac5) !important; border:1px solid #07549d !important; border-radius:999px !important; }
.modal .modal-body .badge,
.modal .modal-body a.badge,
.modal .modal-body .badge span,
.modal .modal-body .badge i,
.modal .modal-body a.badge span,
.modal .modal-body a.badge i { color:#fff !important; }
#about_oop_modal .about-extension-credit-value, #about_oop_modal .about-extension-credit-value a, #about_oop_modal .about-extension-credit-value span { color:#064e9b !important; text-shadow:none !important; }
#about_oop_modal .about-extension-credit-value.badge, #about_oop_modal .about-extension-credit-value.badge a, #about_oop_modal .about-extension-credit-value.badge span { color:#fff !important; text-shadow:0 1px #07509a !important; }
#about_oop_modal .about-extension-credit img { filter:brightness(0) saturate(100%); opacity:.78; }
#about_oop_modal .alert.bg-dark { color:#fff !important; background:#232932 !important; }
#about_oop_modal .alert.bg-dark p { color:#f6f7f9 !important; }
#about_oop_modal .alert.bg-dark .text-danger { color:#ff6875 !important; }
.modal .alert.bg-dark { color:#fff !important; background:#253345 !important; border:1px solid #536b84 !important; }
.modal .alert.bg-dark, .modal .alert.bg-dark p, .modal .alert.bg-dark span, .modal .alert.bg-dark div, .modal .alert.bg-dark i { color:#fff !important; text-shadow:none !important; }
#playwith_modal #lfmlink_lautfm, #playwith_modal #lfmlink_tunein > a, #playwith_modal #lfmlink_radiode > a, #playwith_modal #lfmlink_phonostar > a { color:#fff !important; background:linear-gradient(180deg,#657d98,#344b65) !important; border-color:#40566e !important; }
#currentsong_lastplayed_modal_lbl_holder a { color:#fff !important; background:linear-gradient(180deg,#58aef1,#0962b4) !important; border:1px solid #064b8a !important; }
#currentsong_lastplayed_modal_lbl_holder a * { color:#fff !important; }
.modal .form-control, .modal .form-select { color:#111 !important; background:#fff !important; border:1px solid #7c8995 !important; box-shadow:inset 0 1px 3px rgba(0,0,0,.2) !important; }
#playercontrolbar { color:#202a34 !important; background:linear-gradient(180deg,#eef1f4,#aeb7c0 48%,#7f8b97 52%,#ced3d8) !important; border-top:1px solid #606d79 !important; box-shadow:inset 0 1px #fff !important; }
#playercontrolbar *, #muter, #muter i { color:#202a34 !important; }
#playpausebtn, #cast { display:inline-flex !important; align-items:center; justify-content:center; box-sizing:border-box; padding:0 !important; line-height:1 !important; color:#fff !important; background:linear-gradient(180deg,#71c2ff,#0968c6) !important; border:1px solid #064b91 !important; border-radius:50% !important; box-shadow:inset 0 1px rgba(255,255,255,.8),0 1px 3px rgba(0,0,0,.35) !important; }
#playpausebtn { width:52px; min-width:52px; max-width:52px; height:52px; min-height:52px; max-height:52px; }
#cast { width:44px; min-width:44px; max-width:44px; height:44px; min-height:44px; max-height:44px; }
#cast i { float:none !important; margin:0 !important; }
#playpausebtn *, #cast * { color:#fff !important; }
#cast, #cast:hover, #cast:focus, #cast:active, #cast i { text-decoration:none !important; }
</style>
CSS;
echo $css;
?>
