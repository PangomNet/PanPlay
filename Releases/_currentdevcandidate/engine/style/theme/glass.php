<?php
$css = <<<'CSS'
<style>
:root {
    color-scheme: dark;
    --liquid-text: #f7f9ff;
    --liquid-muted: rgba(238, 244, 255, 0.72);
    --liquid-border: rgba(255, 255, 255, 0.34);
    --liquid-highlight: rgba(255, 255, 255, 0.58);
    --liquid-surface: rgba(28, 34, 48, 0.46);
    --liquid-accent: #ff3b5f;
}

html,
body {
    color: var(--liquid-text) !important;
    background-color: #070a12;
    font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'SF Pro Text', 'Helvetica Neue', 'Segoe UI', Arial, sans-serif !important;
}

body,
button,
input,
select,
textarea {
    letter-spacing: 0;
}

a,
a:hover,
a:focus,
.nav-link,
.navbar-brand {
    color: var(--liquid-text) !important;
}

#blurlayer {
    position: fixed;
    inset: 0;
    z-index: 0;
    width: 100%;
    height: 100vh;
    pointer-events: none;
    background: rgba(12, 18, 29, 0.12);
    -webkit-backdrop-filter: blur(48px) saturate(125%);
    backdrop-filter: blur(48px) saturate(125%);
}

#topnavbar,
#playercontrolbar {
    position: fixed;
    color: var(--liquid-text) !important;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.22), rgba(158, 177, 216, 0.1) 45%, rgba(255, 255, 255, 0.16)) !important;
    border: 1px solid var(--liquid-border) !important;
    box-shadow: inset 0 1px 0 var(--liquid-highlight), inset 0 -1px 0 rgba(255, 255, 255, 0.08), 0 12px 34px rgba(0, 0, 0, 0.32) !important;
    -webkit-backdrop-filter: blur(34px) saturate(175%) contrast(108%);
    backdrop-filter: blur(34px) saturate(175%) contrast(108%);
}

#topnavbar {
    top: 10px;
    right: 12px;
    left: 12px;
    width: auto;
    border-radius: 22px;
    overflow: hidden;
}

#topnavbar::after,
#playercontrolbar::after,
.modal-content::after {
    position: absolute;
    inset: 0;
    z-index: -1;
    border-radius: inherit;
    background: linear-gradient(115deg, rgba(255, 255, 255, 0.2), transparent 32%, transparent 70%, rgba(170, 205, 255, 0.15));
    pointer-events: none;
    content: '';
}

#topnavbar a,
#topnavbar button,
#topnavbar i,
#playercontrolbar a,
#playercontrolbar button,
#playercontrolbar i {
    color: var(--liquid-text) !important;
    text-shadow: 0 1px 5px rgba(0, 0, 0, 0.55);
}

#oop_player {
    position: relative;
    z-index: 1;
    color: var(--liquid-text) !important;
    background: rgba(10, 13, 21, 0.38) !important;
    border: 1px solid rgba(255, 255, 255, 0.16);
    border-radius: 24px;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.14), 0 22px 60px rgba(0, 0, 0, 0.32);
    -webkit-backdrop-filter: blur(28px) saturate(145%);
    backdrop-filter: blur(28px) saturate(145%);
}

#oolfm_currentshow,
#oolfm_songcover,
#oolfm_current_song {
    background: transparent;
}

#playercontrolbar {
    right: 12px;
    bottom: 10px;
    left: 12px;
    width: auto;
    min-height: 62px;
    padding: 7px 12px;
    border-radius: 24px;
}

#playpausebtn,
#cast,
#playercontrolbar #muter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--liquid-text) !important;
    background: rgba(255, 255, 255, 0.15) !important;
    border: 1px solid rgba(255, 255, 255, 0.34) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.45), 0 6px 16px rgba(0, 0, 0, 0.2) !important;
    -webkit-backdrop-filter: blur(18px) saturate(170%);
    backdrop-filter: blur(18px) saturate(170%);
}

#playpausebtn {
    width: 46px;
    height: 46px;
    padding: 0 !important;
    border-radius: 50% !important;
}

#cast {
    width: 42px;
    height: 42px;
    padding: 0 !important;
    border-radius: 50% !important;
}

#playercontrolbar #muter {
    width: 34px;
    height: 34px;
    margin-right: 10px;
    border-radius: 50%;
}

#playpausebtn:hover,
#cast:hover,
#playercontrolbar #muter:hover,
.modal .btn:hover {
    background: rgba(255, 255, 255, 0.26) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.65), 0 8px 22px rgba(0, 0, 0, 0.25) !important;
}

.modal-backdrop.show {
    opacity: 0.58;
    -webkit-backdrop-filter: blur(10px) saturate(120%);
    backdrop-filter: blur(10px) saturate(120%);
}

.modal .modal-content {
    position: relative;
    color: var(--liquid-text) !important;
    background: linear-gradient(145deg, rgba(45, 53, 72, 0.58), rgba(12, 16, 27, 0.68)) !important;
    border: 1px solid rgba(255, 255, 255, 0.38) !important;
    border-radius: 28px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.55), inset 0 -1px 0 rgba(255, 255, 255, 0.08), 0 28px 70px rgba(0, 0, 0, 0.58) !important;
    overflow: hidden;
    isolation: isolate;
    -webkit-backdrop-filter: blur(42px) saturate(175%) contrast(106%);
    backdrop-filter: blur(42px) saturate(175%) contrast(106%);
}

.modal .modal-header,
.modal .modal-footer {
    color: var(--liquid-text) !important;
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.18) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.28);
    -webkit-backdrop-filter: blur(24px) saturate(170%);
    backdrop-filter: blur(24px) saturate(170%);
}

.modal .modal-header {
    min-height: 64px;
    padding: 12px 16px;
}

.modal .modal-content > .modal-header:not(:first-child) {
    min-height: auto;
    background: rgba(255, 255, 255, 0.07) !important;
}

.modal .modal-title,
.modal .modal-header a,
.modal .modal-header i,
.modal .modal-footer a,
.modal .modal-footer button {
    color: var(--liquid-text) !important;
}

.modal .modal-body {
    color: var(--liquid-text) !important;
    background: rgba(9, 12, 20, 0.22) !important;
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
.modal .modal-body .text-white {
    color: var(--liquid-text) !important;
}

.modal .modal-body small,
.modal .modal-body .text-muted {
    color: var(--liquid-muted) !important;
}

.modal .card,
.modal .list-group-item,
.modal .alert,
.modal .form-control,
.modal .accordion-item,
.modal .accordion-button {
    color: var(--liquid-text) !important;
    background: rgba(255, 255, 255, 0.09) !important;
    border-color: rgba(255, 255, 255, 0.18) !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12) !important;
}

.modal .form-control::placeholder {
    color: rgba(238, 244, 255, 0.52);
}

.modal .btn,
.modal .badge,
.modal .nav-pills .nav-link {
    color: var(--liquid-text) !important;
    background: rgba(255, 255, 255, 0.12) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    border-radius: 999px !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.32) !important;
}

.modal .btn-danger,
.modal .btn-check:checked + .btn-outline-danger,
.modal .nav-pills .nav-link.active,
.modal .badge.bg-danger {
    color: #fff !important;
    background: linear-gradient(135deg, #ff4b6b, #c91f49) !important;
    border-color: rgba(255, 180, 195, 0.62) !important;
}

.modal .modal-header button[aria-label='Close'] {
    display: inline-flex;
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
    color: #fff !important;
    background: rgba(255, 255, 255, 0.14) !important;
    border: 1px solid rgba(255, 255, 255, 0.38) !important;
    border-radius: 50% !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.45), 0 5px 14px rgba(0, 0, 0, 0.22) !important;
}

#about_oop_modal .modal-body .alert.bg-dark {
    background: rgba(11, 15, 24, 0.62) !important;
}

#about_oop_modal .modal-body .text-danger,
#about_oop_modal .modal-body .alert .text-danger {
    color: #ff7089 !important;
}

#currentsong_lastplayed_modal_lbl_holder a {
    color: var(--liquid-text) !important;
    background: rgba(255, 255, 255, 0.11) !important;
    border-color: rgba(255, 255, 255, 0.22) !important;
}

@supports not ((-webkit-backdrop-filter: blur(1px)) or (backdrop-filter: blur(1px))) {
    #topnavbar,
    #playercontrolbar,
    .modal .modal-content {
        background: rgba(24, 29, 42, 0.96) !important;
    }
}

@media (max-width: 767.98px) {
    #topnavbar {
        top: 6px;
        right: 6px;
        left: 6px;
        border-radius: 18px;
    }

    #playercontrolbar {
        right: 6px;
        bottom: 6px;
        left: 6px;
        border-radius: 20px;
    }

    .modal .modal-content {
        border-radius: 0 !important;
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
