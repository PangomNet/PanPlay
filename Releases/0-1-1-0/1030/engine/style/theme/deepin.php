<?php
$css = <<<'CSS'
<style>
:root { color-scheme:dark; --deepin-cyan:#45d8e6; --deepin-blue:#168fd5; --deepin-ink:#f4fbff; --deepin-surface:rgba(20,28,43,.82); --deepin-line:rgba(160,226,240,.25); }
html, body, button, input, select, textarea { font-family:'Noto Sans','Ubuntu','Segoe UI',sans-serif !important; letter-spacing:0; }
body { color:var(--deepin-ink); background-image:linear-gradient(145deg,#14273a 0%,#213f54 42%,#132638 100%) !important; background-attachment:fixed !important; }
#blurlayer { position:fixed; inset:0; z-index:0; pointer-events:none; background:rgba(5,14,25,.2); -webkit-backdrop-filter:blur(44px) saturate(92%); backdrop-filter:blur(44px) saturate(92%); }
#topnavbar { color:var(--deepin-ink) !important; background:rgba(13,23,38,.76) !important; border-bottom:1px solid var(--deepin-line) !important; box-shadow:0 5px 18px rgba(0,0,0,.26) !important; -webkit-backdrop-filter:blur(28px) saturate(135%); backdrop-filter:blur(28px) saturate(135%); }
#topnavbar * { color:var(--deepin-ink) !important; }
#oop_player { position:relative; z-index:1; color:var(--deepin-ink) !important; background:rgba(12,21,34,.7) !important; border:1px solid var(--deepin-line) !important; border-radius:10px !important; box-shadow:inset 0 1px rgba(255,255,255,.08),0 20px 48px rgba(0,0,0,.38) !important; -webkit-backdrop-filter:blur(32px); backdrop-filter:blur(32px); }
#oop_player h1, #oop_player h2, #oop_player h3, #oop_player h4, #oop_player h5, #oop_player p, #oop_player span, #oop_player small, #oop_player a, #oolfm_current_song, #oolfm_currentshow, #oolfm_current_song *, #oolfm_currentshow * { color:var(--deepin-ink) !important; text-shadow:0 1px 2px rgba(0,0,0,.72) !important; }
.modal-backdrop.show { opacity:.64; -webkit-backdrop-filter:blur(12px); backdrop-filter:blur(12px); }
.modal .modal-content { color:var(--deepin-ink) !important; background:var(--deepin-surface) !important; border:1px solid var(--deepin-line) !important; border-radius:10px !important; box-shadow:inset 0 1px rgba(255,255,255,.08),0 22px 62px rgba(0,0,0,.58) !important; overflow:hidden; -webkit-backdrop-filter:blur(35px) saturate(130%); backdrop-filter:blur(35px) saturate(130%); }
.modal .modal-header { color:var(--deepin-ink) !important; background:rgba(36,52,72,.72) !important; border-color:var(--deepin-line) !important; }
.modal .modal-title, .modal .modal-header *, .modal .modal-footer * { color:var(--deepin-ink) !important; }
.modal .modal-header button[aria-label='Close'] { display:inline-flex; width:30px; min-width:30px; max-width:30px; height:30px; min-height:30px; max-height:30px; flex:0 0 30px; align-items:center; justify-content:center; box-sizing:border-box; padding:0 !important; line-height:1 !important; color:#fff !important; background:rgba(255,255,255,.08) !important; border:1px solid rgba(255,255,255,.18) !important; border-radius:50% !important; opacity:1 !important; }
.modal .modal-header button[aria-label='Close']:hover { background:#e84d5b !important; border-color:#ff8992 !important; }
.modal .modal-body, .modal .modal-footer { color:var(--deepin-ink) !important; background:rgba(14,23,36,.76) !important; border-color:var(--deepin-line) !important; }
.modal .card, .modal .card-header, .modal .card-body, .modal .list-group-item, .modal .accordion-item, .modal .accordion-button { color:var(--deepin-ink) !important; background:rgba(255,255,255,.055) !important; border-color:var(--deepin-line) !important; }
.modal .modal-body p, .modal .modal-body h1, .modal .modal-body h2, .modal .modal-body h3, .modal .modal-body h4, .modal .modal-body h5, .modal .modal-body h6, .modal .modal-body label, .modal .modal-body small, .modal .modal-body span, .modal .modal-body i, .modal .text-light, .modal .text-white, .modal .text-muted { color:var(--deepin-ink) !important; }
.modal a:not(.btn):not(.badge) { color:#8eeaf2 !important; }
.modal .btn, .modal .nav-link { color:var(--deepin-ink) !important; background:rgba(255,255,255,.08) !important; border:1px solid rgba(178,228,239,.26) !important; border-radius:6px !important; box-shadow:none !important; }
.modal .btn:hover { background:rgba(69,216,230,.18) !important; border-color:rgba(69,216,230,.7) !important; }
.modal .btn-danger, .modal .btn.active, .modal .btn-check:checked + .btn, .modal .nav-link.active { color:#061721 !important; background:linear-gradient(180deg,#6ee7ef,#28b9d6) !important; border-color:#84f1f7 !important; }
.modal .btn-danger *, .modal .btn.active *, .modal .btn-check:checked + .btn *, .modal .nav-link.active * { color:#061721 !important; }
.modal .badge, .modal a.badge { color:#061721 !important; background:var(--deepin-cyan) !important; border:1px solid #96f5f8 !important; border-radius:999px !important; }
.modal .modal-body .badge,
.modal .modal-body a.badge,
.modal .modal-body .badge span,
.modal .modal-body .badge i,
.modal .modal-body a.badge span,
.modal .modal-body a.badge i { color:#061721 !important; }
#about_oop_modal .about-extension-credit-value, #about_oop_modal .about-extension-credit-value a, #about_oop_modal .about-extension-credit-value span { color:#8eeaf2 !important; text-shadow:none !important; }
#about_oop_modal .about-extension-credit-value.badge, #about_oop_modal .about-extension-credit-value.badge a, #about_oop_modal .about-extension-credit-value.badge span { color:#061721 !important; }
#about_oop_modal .alert.bg-dark { color:#fff !important; background:#202a36 !important; }
#about_oop_modal .alert.bg-dark p { color:#f3f8fb !important; }
#about_oop_modal .alert.bg-dark .text-danger { color:#ff7a86 !important; }
#currentsong_lastplayed_modal_lbl_holder a { color:#fff !important; background:linear-gradient(135deg,#147aab,#1f506f) !important; border:1px solid #46cadb !important; }
#currentsong_lastplayed_modal_lbl_holder a * { color:#fff !important; }
.modal .form-control, .modal .form-select { color:#fff !important; background:rgba(4,12,21,.72) !important; border:1px solid rgba(69,216,230,.44) !important; }
#playercontrolbar { color:var(--deepin-ink) !important; background:rgba(13,23,37,.86) !important; border-top:1px solid var(--deepin-line) !important; box-shadow:0 -5px 20px rgba(0,0,0,.26) !important; -webkit-backdrop-filter:blur(28px); backdrop-filter:blur(28px); }
#playercontrolbar *, #muter, #muter i { color:var(--deepin-ink) !important; }
#playpausebtn, #cast { display:inline-flex !important; align-items:center; justify-content:center; box-sizing:border-box; padding:0 !important; line-height:1 !important; color:#071821 !important; background:linear-gradient(180deg,#69e8ef,#26b8d4) !important; border:1px solid #91f4f7 !important; border-radius:50% !important; box-shadow:0 2px 10px rgba(34,192,214,.34) !important; }
#playpausebtn { width:52px; min-width:52px; max-width:52px; height:52px; min-height:52px; max-height:52px; }
#cast { width:44px; min-width:44px; max-width:44px; height:44px; min-height:44px; max-height:44px; }
#cast i { float:none !important; margin:0 !important; }
#playpausebtn *, #cast * { color:#071821 !important; }
#cast, #cast:hover, #cast:focus, #cast:active, #cast i { text-decoration:none !important; }
</style>
CSS;
echo $css;
?>
