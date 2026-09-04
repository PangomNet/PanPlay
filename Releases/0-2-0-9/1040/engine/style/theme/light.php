<?php
$css = <<<'CSS'
<style>
:root { color-scheme:dark; --light-surface:rgba(25,27,32,.86); --light-strong:rgba(16,18,22,.94); --light-border:rgba(255,255,255,.2); }
html, body { color:#fff; background-color:#f3f4f7; }
body, button, input, select, textarea { letter-spacing:0; }
#blurlayer { position:fixed; inset:0; z-index:-100; background:rgba(235,239,246,.2); -webkit-backdrop-filter:blur(25px) saturate(90%); backdrop-filter:blur(25px) saturate(90%); }
#topnavbar, #playercontrolbar, #oop_player { color:#fff !important; background:var(--light-surface) !important; border-color:var(--light-border) !important; -webkit-backdrop-filter:blur(34px) saturate(100%); backdrop-filter:blur(34px) saturate(100%); }
#topnavbar *, #playercontrolbar *, #oop_player h1, #oop_player h2, #oop_player h3, #oop_player h4, #oop_player h5, #oop_player p, #oop_player span, #oop_player small, #oop_player a, #oolfm_current_song, #oolfm_currentshow, #oolfm_current_song *, #oolfm_currentshow * { color:#fff !important; }
.modal-backdrop.show { opacity:.68; -webkit-backdrop-filter:blur(10px); backdrop-filter:blur(10px); }
.modal .modal-content { color:#fff !important; background:var(--light-strong) !important; border:1px solid var(--light-border) !important; box-shadow:0 18px 52px rgba(0,0,0,.52) !important; overflow:hidden; -webkit-backdrop-filter:blur(34px) saturate(105%); backdrop-filter:blur(34px) saturate(105%); }
.modal .modal-header, .modal .modal-footer { color:#fff !important; background:rgba(8,9,12,.72) !important; border-color:var(--light-border) !important; }
.modal .modal-title, .modal .modal-header *, .modal .modal-footer * { color:#fff !important; }
.modal .modal-header button[aria-label='Close'] { color:#fff !important; opacity:1 !important; }
.modal .modal-body, .modal .card, .modal .card-header, .modal .card-body, .modal .accordion-item, .modal .accordion-button { color:#fff !important; background:rgba(31,34,40,.94) !important; border-color:var(--light-border) !important; }
.modal .modal-body p, .modal .modal-body h1, .modal .modal-body h2, .modal .modal-body h3, .modal .modal-body h4, .modal .modal-body h5, .modal .modal-body h6, .modal .modal-body label, .modal .modal-body small, .modal .modal-body span, .modal .modal-body i, .modal .modal-body .text-light, .modal .modal-body .text-white, .modal .modal-body .text-muted, .modal .list-group-item { color:#fff !important; }
.modal .list-group-item { background:rgba(255,255,255,.07) !important; border-color:rgba(255,255,255,.14) !important; }
.modal a:not(.btn):not(.badge) { color:#b9dcff !important; }
.modal .btn-outline-danger, .modal .btn-outline-secondary, .modal .nav-link { color:#f4f6f8 !important; background:rgba(255,255,255,.08) !important; border-color:rgba(255,255,255,.34) !important; }
.modal .btn-danger, .modal .btn.active, .modal .btn-check:checked + .btn, .modal .nav-link.active { color:#fff !important; background:#c53d49 !important; border-color:#ef818a !important; }
.modal .btn-danger *, .modal .btn.active *, .modal .btn-check:checked + .btn *, .modal .nav-link.active * { color:#fff !important; }
.modal .badge, .modal a.badge, .modal .badge * { color:#fff !important; }
#currentsong_lastplayed_modal_lbl_holder a { color:#fff !important; background:linear-gradient(180deg,#ad2836,#67151d) !important; }
#currentsong_lastplayed_modal_lbl_holder a * { color:#fff !important; }
.modal .form-control, .modal .form-select { color:#111 !important; background:#fff !important; border-color:#aeb4bd !important; }
#settings_oop_modal .modal-body input.form-control,
#settings_oop_modal .modal-body select.form-select { color:#111 !important; }
#about_oop_modal .modal-body { background:radial-gradient(circle at center,rgba(125,34,34,.72),rgba(55,12,16,.96)) !important; }
</style>
CSS;
echo $css;
?>
