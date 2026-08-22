<?php
$css = <<<'CSS'
<style>
:root { color-scheme:light; --xp-blue:#0a50c6; --xp-blue-dark:#073a9c; --xp-face:#ece9d8; --xp-ink:#1b1b1b; --xp-green:#3c8b25; }
html, body, button, input, select, textarea { font-family:Tahoma,'Segoe UI',sans-serif !important; letter-spacing:0; }
body { color:var(--xp-ink); background-image:linear-gradient(180deg,#5ba9eb 0%,#91c8ef 56%,#72a943 57%,#4e7f2e 100%) !important; background-attachment:fixed !important; }
#blurlayer { position:fixed; inset:0; z-index:0; pointer-events:none; background:rgba(33,68,101,.13); -webkit-backdrop-filter:blur(46px) saturate(86%); backdrop-filter:blur(46px) saturate(86%); }
#topnavbar { color:#fff !important; background:linear-gradient(180deg,#3f8cf3 0%,#1766d8 45%,#0646b3 52%,#1f6dda 100%) !important; border-bottom:2px solid #083484 !important; box-shadow:inset 0 1px rgba(255,255,255,.55),0 3px 8px rgba(0,36,95,.4) !important; }
#topnavbar * { color:#fff !important; text-shadow:1px 1px #123b86; }
#oop_player { position:relative; z-index:1; color:#fff !important; background:rgba(17,46,83,.72) !important; border:2px solid #1853a3 !important; border-radius:8px !important; box-shadow:inset 0 1px rgba(255,255,255,.3),0 10px 30px rgba(0,31,72,.38) !important; }
#oop_player h1, #oop_player h2, #oop_player h3, #oop_player h4, #oop_player h5, #oop_player p, #oop_player span, #oop_player small, #oop_player a, #oolfm_current_song, #oolfm_currentshow, #oolfm_current_song *, #oolfm_currentshow * { color:#fff !important; text-shadow:1px 1px #183858 !important; }
.modal-backdrop.show { opacity:.55; }
.modal .modal-content { color:var(--xp-ink) !important; background:var(--xp-face) !important; border:3px solid var(--xp-blue) !important; border-radius:8px 8px 4px 4px !important; box-shadow:inset 0 0 0 1px #6fa7f5,5px 8px 22px rgba(0,0,0,.48) !important; overflow:hidden; }
.modal .modal-content > .modal-header:first-child { min-height:46px; color:#fff !important; background:linear-gradient(180deg,#4b91f4 0%,#1261d4 45%,#0745b0 55%,#1b69d9 100%) !important; border-bottom:2px solid #0a398b !important; }
.modal .modal-content > .modal-header:not(:first-child) { color:#1c3260 !important; background:linear-gradient(180deg,#f8f6e9,#dedbc8) !important; border-color:#b4af95 !important; }
.modal .modal-content > .modal-header:first-child .modal-title, .modal .modal-content > .modal-header:first-child a, .modal .modal-content > .modal-header:first-child i, .modal .modal-content > .modal-header:first-child h1, .modal .modal-content > .modal-header:first-child h2, .modal .modal-content > .modal-header:first-child h3, .modal .modal-content > .modal-header:first-child h4, .modal .modal-content > .modal-header:first-child h5 { color:#fff !important; text-shadow:1px 1px #123980; }
.modal .modal-header button[aria-label='Close'] { display:inline-flex; width:29px; height:26px; flex:0 0 29px; align-items:center; justify-content:center; padding:0 !important; color:#fff !important; background:linear-gradient(135deg,#ef8d76,#d83e24 55%,#a91d12) !important; border:1px solid #fff !important; border-radius:4px !important; box-shadow:inset 0 0 0 1px #9e2618 !important; opacity:1 !important; text-shadow:1px 1px #78140d; }
.modal .modal-body, .modal .modal-footer { color:var(--xp-ink) !important; background:var(--xp-face) !important; border-color:#c1bda7 !important; }
.modal .card, .modal .card-header, .modal .card-body, .modal .list-group-item, .modal .accordion-item, .modal .accordion-button { color:var(--xp-ink) !important; background:#f7f5e8 !important; border-color:#b5b09a !important; }
.modal .modal-body p, .modal .modal-body h1, .modal .modal-body h2, .modal .modal-body h3, .modal .modal-body h4, .modal .modal-body h5, .modal .modal-body h6, .modal .modal-body label, .modal .modal-body small, .modal .modal-body span, .modal .modal-body i, .modal .text-light, .modal .text-white, .modal .text-muted { color:var(--xp-ink) !important; text-shadow:none !important; }
.modal a:not(.btn):not(.badge) { color:#003399 !important; }
.modal .btn, .modal .nav-link { color:#111 !important; background:linear-gradient(180deg,#fff,#f2f0e4) !important; border:1px solid #7f9db9 !important; border-radius:3px !important; box-shadow:inset 0 0 0 1px #fff !important; }
.modal .btn:hover { border-color:#f0a91b !important; }
.modal .btn-danger, .modal .btn.active, .modal .btn-check:checked + .btn, .modal .nav-link.active { color:#fff !important; background:linear-gradient(180deg,#4e9af5,#0751c4) !important; border-color:#083c99 !important; text-shadow:1px 1px #12377a; }
.modal .btn-danger *, .modal .btn.active *, .modal .btn-check:checked + .btn *, .modal .nav-link.active * { color:#fff !important; }
.modal .badge, .modal a.badge { color:#fff !important; background:linear-gradient(180deg,#51a73c,#28751b) !important; border:1px solid #1f5f13 !important; border-radius:3px !important; }
.modal .badge * { color:#fff !important; }
.modal .modal-body .badge, .modal .modal-body a.badge, .modal .modal-body .badge span, .modal .modal-body .badge i, .modal .modal-body a.badge span, .modal .modal-body a.badge i { color:#fff !important; }
#about_oop_modal .about-extension-credit-value, #about_oop_modal .about-extension-credit-value a, #about_oop_modal .about-extension-credit-value span { color:#003399 !important; text-shadow:none !important; }
#about_oop_modal .about-extension-credit-value.badge, #about_oop_modal .about-extension-credit-value.badge a, #about_oop_modal .about-extension-credit-value.badge span { color:#fff !important; text-shadow:1px 1px #174f10 !important; }
#about_oop_modal .about-extension-credit img { filter:brightness(0) saturate(100%); opacity:.8; }
#about_oop_modal .alert.bg-dark { color:#fff !important; background:#27313d !important; }
#about_oop_modal .alert.bg-dark p { color:#f5f7fa !important; }
#about_oop_modal .alert.bg-dark .text-danger { color:#ff6f78 !important; }
.modal .alert.bg-dark { color:#fff !important; background:#27313d !important; border:1px solid #556b80 !important; }
.modal .alert.bg-dark, .modal .alert.bg-dark p, .modal .alert.bg-dark span, .modal .alert.bg-dark div, .modal .alert.bg-dark i { color:#fff !important; text-shadow:none !important; }
#playwith_modal #lfmlink_lautfm, #playwith_modal #lfmlink_tunein > a, #playwith_modal #lfmlink_radiode > a, #playwith_modal #lfmlink_phonostar > a { color:#fff !important; background:linear-gradient(180deg,#3f75bc,#174c9e) !important; border-color:#103a80 !important; }
#currentsong_lastplayed_modal_lbl_holder a { color:#fff !important; background:linear-gradient(180deg,#4d96eb,#0b52bd) !important; border:1px solid #073a92 !important; }
#currentsong_lastplayed_modal_lbl_holder a * { color:#fff !important; }
.modal .form-control, .modal .form-select { color:#000 !important; background:#fff !important; border:1px solid #7f9db9 !important; }
#playercontrolbar { color:#fff !important; background:linear-gradient(180deg,#2e80e9,#0955c5 52%,#0646ad) !important; border-top:2px solid #4c98ef !important; box-shadow:inset 0 1px rgba(255,255,255,.45) !important; }
#playercontrolbar *, #muter, #muter i { color:#fff !important; }
#playpausebtn { display:inline-flex !important; width:66px; min-width:66px; height:42px; min-height:42px; align-items:center; justify-content:center; box-sizing:border-box; margin-left:-12px; padding:0 12px 0 17px !important; line-height:1 !important; color:#fff !important; background:linear-gradient(180deg,#75c65f,#2b8b1b 55%,#1d6f11) !important; border:2px outset #8dd377 !important; border-radius:0 21px 21px 0 !important; }
#cast { display:inline-flex !important; width:48px; min-width:48px; height:34px; min-height:34px; align-items:center; justify-content:center; box-sizing:border-box; padding:0 !important; color:#fff !important; background:linear-gradient(180deg,#4b96ef,#0750bd) !important; border:1px solid #fff !important; border-radius:4px !important; }
#cast i { float:none !important; margin:0 !important; }
#playpausebtn *, #cast * { color:#fff !important; }
#cast, #cast:hover, #cast:focus, #cast:active, #cast i { text-decoration:none !important; }
</style>
CSS;
echo $css;
?>
