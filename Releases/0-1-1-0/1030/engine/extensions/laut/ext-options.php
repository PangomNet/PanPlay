<?php

function panplayLautToggle($param, $label, $default = 'y', $globalOverride = false, $controlledByGlobal = true)
{
    $current = panplaySettingsCurrentParam($param, $default);
    $enabled = $globalOverride ? false : $current !== 'n';
    $toggleClass = $controlledByGlobal ? 'panplay-laut-module-toggle' : 'panplay-laut-independent-toggle';

    return '<div class="d-flex flex-wrap align-items-center justify-content-between border-top border-secondary py-2">' .
        '<span>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>' .
        '<span class="' . $toggleClass . '">' .
        panplaySettingsRadio($param, 'y', htmlspecialchars(panplaySettingsBoolLabel(true), ENT_QUOTES, 'UTF-8'), $enabled, $globalOverride) .
        panplaySettingsRadio($param, 'n', htmlspecialchars(panplaySettingsBoolLabel(false), ENT_QUOTES, 'UTF-8'), !$enabled, $globalOverride) .
        '</span>' .
        '</div>';
}

$body = '<p class="card-text fs-6"><small>' .
    htmlspecialchars(panplaySettingsText('settingspanel_laut_desc', 'Change laut.fm display options for this player URL. Applying a setting reloads the player with the matching URL parameter.'), ENT_QUOTES, 'UTF-8') .
    '</small></p>';

$allFeaturesDisabled = isset($_GET['nolfmw']) && ($_GET['nolfmw'] === 'y' || $_GET['nolfmw'] === 'j');

$body .= '<div class="border-top border-secondary py-2">';
$body .= '<span class="d-block mb-2">' . htmlspecialchars(panplaySettingsText('settingspanel_laut_feature_windows', 'laut.fm feature windows'), ENT_QUOTES, 'UTF-8') . '</span>';
$body .= panplaySettingsRadio('nolfmw', 'n', htmlspecialchars(panplaySettingsText('settingspanel_laut_use_selected', 'Use selected options'), ENT_QUOTES, 'UTF-8'), !$allFeaturesDisabled);
$body .= panplaySettingsRadio('nolfmw', 'y', htmlspecialchars(panplaySettingsText('settingspanel_laut_hide_all', 'Hide all'), ENT_QUOTES, 'UTF-8'), $allFeaturesDisabled);
$body .= '<button type="button" id="panplay-laut-default-windows" class="btn btn-outline-light btn-sm me-2 mb-2">' . htmlspecialchars(panplaySettingsText('settingspanel_laut_default_windows', 'Default: show all windows'), ENT_QUOTES, 'UTF-8') . '</button>';
$body .= '</div>';

if ($allFeaturesDisabled) {
    $body .= '<p class="small text-warning mb-0"><i class="fas fa-info-circle"></i> ' . htmlspecialchars(panplaySettingsText('settingspanel_laut_global_override_note', 'All laut.fm feature windows are currently disabled by the global nolfmw switch. Individual window settings are ignored until this switch is changed back.'), ENT_QUOTES, 'UTF-8') . '</p>';
}

$body .= panplayLautToggle('schedule', panplaySettingsText('settingspanel_laut_schedule', 'Schedule'), 'y', $allFeaturesDisabled);
$body .= panplayLautToggle('stationinfo', panplaySettingsText('settingspanel_laut_stationinfo', 'Station info'), 'y', $allFeaturesDisabled);
$body .= panplayLautToggle('playwith', panplaySettingsText('settingspanel_laut_playwith', 'Switch player'), 'y', $allFeaturesDisabled);
$body .= panplayLautToggle('trackhistory', panplaySettingsText('settingspanel_laut_trackhistory', 'Track history'), 'y', $allFeaturesDisabled);
$body .= panplayLautToggle('currentsongmodal', panplaySettingsText('settingspanel_laut_currentsongmodal', 'Current song window'), 'y', $allFeaturesDisabled);

$body .= '<div class="border-top border-secondary pt-3 mt-2">';
$body .= '<span class="d-block mb-2">' . htmlspecialchars(panplaySettingsText('settingspanel_laut_playback_behavior', 'Playback behavior'), ENT_QUOTES, 'UTF-8') . '</span>';
$body .= panplayLautToggle('lbn', panplaySettingsText('settingspanel_laut_lbn', 'Live by show name'), 'n', false, false);
$body .= '</div>';

panplaySettingsCard(
    htmlspecialchars(panplaySettingsText('settingspanel_extension_title', 'Extension settings'), ENT_QUOTES, 'UTF-8'),
    'fas fa-broadcast-tower',
    $body
);

?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var globalRadios = document.querySelectorAll('input[name="nolfmw"]');
    var moduleInputs = document.querySelectorAll('.panplay-laut-module-toggle input');
    var moduleLabels = document.querySelectorAll('.panplay-laut-module-toggle label');
    var defaultButton = document.getElementById('panplay-laut-default-windows');

    function refreshLautModuleState() {
        var globalOff = document.querySelector('input[name="nolfmw"][value="y"]');
        var disabled = globalOff && globalOff.checked;
        moduleInputs.forEach(function (input) { input.disabled = disabled; });
        moduleLabels.forEach(function (label) { label.classList.toggle('disabled', disabled); });
    }

    globalRadios.forEach(function (radio) {
        radio.addEventListener('change', refreshLautModuleState);
    });

    if (defaultButton) {
        defaultButton.addEventListener('click', function () {
            var useSelected = document.querySelector('input[name="nolfmw"][value="n"]');
            if (useSelected) {
                useSelected.checked = true;
            }
            moduleInputs.forEach(function (input) {
                if (input.value === 'y') {
                    input.checked = true;
                }
            });
            refreshLautModuleState();
        });
    }

    refreshLautModuleState();
});
</script>
