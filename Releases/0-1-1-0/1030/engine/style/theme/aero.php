<?php
$css = <<<'CSS'
<style>
:root {
    color-scheme: light;
    --aero-ink: #13285e;
    --aero-ink-strong: #0b1e4d;
    --aero-border: rgba(57, 105, 150, 0.9);
    --aero-glass-light: rgba(244, 250, 255, 0.96);
    --aero-glass-mid: rgba(188, 217, 243, 0.95);
    --aero-glass-deep: rgba(135, 181, 220, 0.96);
}

html,
body {
    color: #fff;
    background-color: #1a1b23;
    font-family: Frutiger, 'Segoe UI', Tahoma, Arial, sans-serif !important;
}

body,
button,
input,
select,
textarea {
    letter-spacing: 0;
}

body::before {
    content: '';
    position: fixed;
    inset: 0;
    z-index: -1;
    pointer-events: none;
    background: rgba(18, 34, 52, 0.38);
    -webkit-backdrop-filter: blur(34px) saturate(82%);
    backdrop-filter: blur(34px) saturate(82%);
}

#blurlayer {
    position: fixed;
    inset: 0;
    z-index: 0;
    width: 100%;
    height: 100vh;
    pointer-events: none;
    background: rgba(18, 34, 52, 0.28);
    -webkit-backdrop-filter: blur(34px) saturate(82%);
    backdrop-filter: blur(34px) saturate(82%);
}

#topnavbar {
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, rgba(247, 252, 255, 0.97) 0%, rgba(218, 235, 249, 0.96) 48%, rgba(169, 205, 235, 0.96) 51%, rgba(208, 231, 248, 0.96) 100%) !important;
    border-bottom: 1px solid rgba(69, 115, 157, 0.92) !important;
    box-shadow: inset 0 1px 0 #fff, 0 3px 12px rgba(18, 50, 82, 0.34) !important;
    -webkit-backdrop-filter: blur(22px) saturate(135%);
    backdrop-filter: blur(22px) saturate(135%);
}

#topnavbar a,
#topnavbar button,
#topnavbar i,
#topnavbar .navbar-brand,
#topnavbar .nav-link {
    color: var(--aero-ink) !important;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.88);
}

#topnavbar .pangomfont.badge.bg-dark {
    color: #fff !important;
    background: #172133 !important;
    border: 1px solid rgba(255, 255, 255, 0.55) !important;
    text-shadow: none !important;
}

#topnavbar .pangomfont.badge.bg-dark .text-danger {
    color: #ff6677 !important;
    text-shadow: none !important;
}

#oop_player {
    position: relative;
    z-index: 1;
    background: rgba(20, 27, 39, 0.58) !important;
    border: 1px solid rgba(207, 229, 248, 0.24);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12), 0 14px 36px rgba(0, 0, 0, 0.34);
    -webkit-backdrop-filter: blur(38px) saturate(120%);
    backdrop-filter: blur(38px) saturate(120%);
}

#oop_player h1,
#oop_player h2,
#oop_player h3,
#oop_player h4,
#oop_player h5,
#oop_player p,
#oop_player span,
#oop_player small,
#oop_player a,
#oolfm_current_song,
#oolfm_currentshow,
#oolfm_current_song *,
#oolfm_currentshow * {
    color: #f7fbff !important;
    text-shadow: 0 1px 2px rgba(0, 18, 38, 0.9) !important;
}

#oolfm_currentshow,
#oolfm_songcover,
#oolfm_current_song {
    background: transparent;
}

.modal-backdrop.show {
    opacity: 0.55;
    -webkit-backdrop-filter: blur(8px);
    backdrop-filter: blur(8px);
}

.modal .modal-content {
    color: var(--aero-ink) !important;
    background: var(--aero-glass-mid) !important;
    border: 1px solid var(--aero-border) !important;
    border-radius: 8px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.95), 0 14px 42px rgba(0, 24, 52, 0.62) !important;
    overflow: hidden;
    -webkit-backdrop-filter: blur(28px) saturate(135%);
    backdrop-filter: blur(28px) saturate(135%);
}

.modal .modal-content > .modal-header:first-child {
    min-height: 58px;
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, rgba(249, 253, 255, 0.98) 0%, rgba(216, 236, 251, 0.97) 49%, rgba(159, 198, 231, 0.97) 51%, rgba(196, 224, 245, 0.97) 100%) !important;
    border-bottom: 1px solid rgba(67, 112, 154, 0.88) !important;
    box-shadow: inset 0 1px 0 #fff, 0 2px 6px rgba(45, 82, 118, 0.2);
}

.modal .modal-content > .modal-header:not(:first-child) {
    min-height: auto;
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, rgba(226, 241, 252, 0.96), rgba(177, 209, 235, 0.96)) !important;
    border-top: 0 !important;
    border-bottom: 1px solid rgba(78, 121, 162, 0.68) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.78);
}

.modal .modal-title,
.modal .modal-header a,
.modal .modal-header i,
.modal .modal-header h1,
.modal .modal-header h2,
.modal .modal-header h3,
.modal .modal-header h4,
.modal .modal-header h5 {
    color: var(--aero-ink-strong) !important;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.92);
}

.modal .modal-body {
    color: var(--aero-ink) !important;
    background: linear-gradient(135deg, var(--aero-glass-light), rgba(174, 207, 237, 0.95)) !important;
}

.modal .modal-body p,
.modal .modal-body h1,
.modal .modal-body h2,
.modal .modal-body h3,
.modal .modal-body h4,
.modal .modal-body h5,
.modal .modal-body h6,
.modal .modal-body dt,
.modal .modal-body dd,
.modal .modal-body label,
.modal .modal-body .text-light,
.modal .modal-body .text-white,
.modal .modal-body .text-muted,
.modal .modal-body .list-group,
.modal .modal-body .list-group-item,
.modal .modal-body .card,
.modal .modal-body .card-header,
.modal .modal-body .card-body {
    color: var(--aero-ink) !important;
}

.modal .modal-body a:not(.badge):not(.btn),
.modal .modal-footer a {
    color: #174f84 !important;
}

.modal .list-group-item,
.modal .card,
.modal .accordion-item,
.modal .accordion-button {
    color: var(--aero-ink) !important;
    background: rgba(248, 252, 255, 0.72) !important;
    border-color: rgba(73, 119, 162, 0.48) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.72) !important;
}

.modal .list-group-item:hover,
.modal .list-group-item:focus {
    color: var(--aero-ink-strong) !important;
    background: rgba(218, 238, 253, 0.94) !important;
}

.modal .form-control,
.modal .form-select {
    color: #10224a !important;
    background: rgba(255, 255, 255, 0.96) !important;
    border: 1px solid #6b9bc8 !important;
    box-shadow: inset 0 1px 2px rgba(23, 70, 111, 0.16) !important;
}

.modal .btn,
.modal .nav-pills .nav-link {
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, #f8fcff 0%, #d8ecfa 48%, #a7cfea 51%, #d9edf9 100%) !important;
    border: 1px solid #5b8dbb !important;
    border-radius: 5px !important;
    box-shadow: inset 0 1px 0 #fff, 0 1px 2px rgba(34, 73, 109, 0.2) !important;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.82);
}

.modal .btn:hover,
.modal .nav-pills .nav-link:hover {
    color: #06183f !important;
    background: linear-gradient(180deg, #fff 0%, #e8f5ff 48%, #b8dbf4 51%, #ecf8ff 100%) !important;
    border-color: #2e6fa8 !important;
}

.modal .btn-danger,
.modal .btn-check:checked + .btn-outline-danger,
.modal .btn-check:checked + .btn,
.modal .btn.active,
.modal .nav-pills .nav-link.active {
    color: #fff !important;
    background: linear-gradient(180deg, #72afe4 0%, #2e77b9 48%, #185b9a 51%, #438bc8 100%) !important;
    border-color: #174f84 !important;
    text-shadow: 0 1px 1px #0b3761;
}

.modal .btn-danger *,
.modal .btn-check:checked + .btn *,
.modal .btn.active *,
.modal .nav-pills .nav-link.active * {
    color: #fff !important;
    text-shadow: 0 1px 1px #0b3761 !important;
}

#playwith_modal #lfmlink_lautfm,
#playwith_modal #lfmlink_tunein > a,
#playwith_modal #lfmlink_radiode > a,
#playwith_modal #lfmlink_phonostar > a {
    color: #fff !important;
    background: linear-gradient(180deg, #72afe4 0%, #2e77b9 48%, #185b9a 51%, #438bc8 100%) !important;
    border-color: #174f84 !important;
    text-shadow: 0 1px 1px #0b3761 !important;
}

.modal .badge,
.modal a.badge {
    color: #fff !important;
    background: linear-gradient(180deg, #4e91cc, #1e5d94) !important;
    border: 1px solid #174f84 !important;
    border-radius: 999px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.48) !important;
    text-shadow: 0 1px 1px #0a3157;
}

.modal .modal-body .badge i,
.modal .modal-body .badge span,
.modal .modal-body a.badge i,
.modal .modal-body a.badge span {
    color: #fff !important;
    background: transparent !important;
    border: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    text-shadow: 0 1px 1px #0a3157 !important;
}

.modal .badge.bg-danger {
    color: #fff !important;
    background: linear-gradient(180deg, #e97168, #aa2018) !important;
    border-color: #82170f !important;
}

.modal .border-danger {
    border-color: #2b6da6 !important;
}

#currentsong_lastplayed_modal_lbl_holder a {
    color: var(--aero-ink-strong) !important;
    background: linear-gradient(180deg, rgba(250, 253, 255, 0.98), rgba(180, 213, 240, 0.96)) !important;
    border: 1px solid rgba(67, 112, 154, 0.7) !important;
}

#currentsong_lastplayed_modal_lbl_holder a p,
#currentsong_lastplayed_modal_lbl_holder a i,
#currentsong_lastplayed_modal_lbl_holder a small {
    color: var(--aero-ink-strong) !important;
}

#stationinfo_modal .list-group,
#stationinfo_modal .list-group-item,
#stationinfo_modal .list-group-item > div {
    color: var(--aero-ink) !important;
    background: rgba(245, 251, 255, 0.36) !important;
}

.modal .alert {
    color: #553600 !important;
    background: rgba(255, 240, 211, 0.96) !important;
    border: 1px solid #d8ad69 !important;
}

#about_oop_modal .modal-body .alert.bg-dark {
    color: #fff !important;
    background: linear-gradient(135deg, #2a3541, #1f2832) !important;
    border-color: #44586c !important;
}

#about_oop_modal .modal-body .alert p,
#about_oop_modal .modal-body .alert .text-danger {
    color: #ff8790 !important;
}

#about_oop_modal .about-extension-credit {
    padding: 11px 14px;
    color: #fff !important;
    background: linear-gradient(180deg, #4c82ae, #224f78) !important;
    border: 1px solid #173f64;
    border-radius: 5px;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.46), 0 1px 3px rgba(24, 56, 84, 0.28);
}

#about_oop_modal .about-extension-credit a,
#about_oop_modal .about-extension-credit span {
    color: #fff !important;
}

.modal .modal-footer {
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, rgba(226, 241, 252, 0.98), rgba(158, 197, 228, 0.98)) !important;
    border-top: 1px solid rgba(65, 110, 153, 0.88) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.88);
}

.modal .modal-content > .modal-header:first-child button[aria-label='Close'] {
    display: inline-flex;
    width: 42px;
    height: 30px;
    flex: 0 0 42px;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
    color: #fff !important;
    background: linear-gradient(180deg, #f5a49b 0%, #d7564a 45%, #a91f16 52%, #e35f52 100%) !important;
    border: 1px solid #7d160f !important;
    border-radius: 5px !important;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.52), 0 1px 2px rgba(33, 48, 63, 0.5) !important;
    text-shadow: 0 1px 1px #6d0904;
}

.modal .modal-content > .modal-header:first-child button[aria-label='Close'] i {
    color: #fff !important;
    text-shadow: 0 1px 1px #6d0904;
}

.modal .modal-content > .modal-header:first-child button[aria-label='Close']:hover {
    background: linear-gradient(180deg, #ffc0b8 0%, #ee6d61 45%, #c42b20 52%, #f1776c 100%) !important;
}

#playercontrolbar {
    min-height: 64px;
    padding: 7px 10px;
    color: var(--aero-ink) !important;
    background: linear-gradient(180deg, rgba(245, 251, 255, 0.98) 0%, rgba(205, 229, 247, 0.97) 46%, rgba(145, 187, 221, 0.97) 50%, rgba(190, 219, 240, 0.98) 100%) !important;
    border-top: 1px solid rgba(58, 103, 145, 0.96) !important;
    box-shadow: inset 0 1px 0 #fff, 0 -4px 18px rgba(13, 46, 77, 0.34) !important;
    -webkit-backdrop-filter: blur(22px) saturate(135%);
    backdrop-filter: blur(22px) saturate(135%);
}

#playpausebtn,
#cast {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff !important;
    background: linear-gradient(180deg, #6da8db 0%, #2b6da8 47%, #124a7e 51%, #397fb9 100%) !important;
    border: 1px solid #123f68 !important;
    border-radius: 50% !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.72), 0 2px 5px rgba(23, 55, 83, 0.45) !important;
    text-shadow: 0 1px 1px #092b4b;
}

#playpausebtn {
    width: 48px;
    height: 48px;
    padding: 0 !important;
}

#cast {
    width: 42px;
    height: 42px;
    padding: 0 !important;
}

#playpausebtn i,
#cast i {
    color: #fff !important;
}

#muter,
#muter i {
    color: var(--aero-ink) !important;
    text-shadow: 0 1px 0 #fff;
}

#playercontrolbar .form-range::-webkit-slider-runnable-track {
    height: 7px;
    background: linear-gradient(180deg, #759abc, #d9ebf8) !important;
    border: 1px solid #557b9d;
    border-radius: 999px;
    box-shadow: inset 0 1px 2px rgba(30, 65, 96, 0.4);
}

#playercontrolbar .form-range::-webkit-slider-thumb {
    width: 18px;
    height: 18px;
    margin-top: -6px;
    background: linear-gradient(180deg, #f8fcff, #4f8fc4 52%, #d5ebfa) !important;
    border: 1px solid #2d608b;
    border-radius: 50%;
    box-shadow: inset 0 1px 0 #fff, 0 1px 3px rgba(22, 55, 84, 0.5);
}

#playercontrolbar .form-range::-moz-range-track {
    height: 7px;
    background: linear-gradient(180deg, #759abc, #d9ebf8) !important;
    border: 1px solid #557b9d;
    border-radius: 999px;
}

#playercontrolbar .form-range::-moz-range-thumb {
    width: 18px;
    height: 18px;
    background: linear-gradient(180deg, #f8fcff, #4f8fc4 52%, #d5ebfa) !important;
    border: 1px solid #2d608b;
    border-radius: 50%;
}

@media (max-width: 767.98px) {
    .modal .modal-content {
        border-radius: 0 !important;
    }

    #playercontrolbar {
        min-height: 58px;
        padding: 5px 7px;
    }

    #playpausebtn {
        width: 43px;
        height: 43px;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        transition: none !important;
    }
}
</style>
CSS;

echo $css;
?>
