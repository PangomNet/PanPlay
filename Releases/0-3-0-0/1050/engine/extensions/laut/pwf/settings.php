<?php
declare(strict_types=1);
?>
<fieldset class="pwf-panel panplay-settings-group">
    <legend>laut.fm</legend>
    <label class="pwf-check">
        <input type="checkbox" name="nolfmw" value="y" data-panplay-disable-all<?= $hideLautWindows ? ' checked' : '' ?>>
        <span><?= h($t('settingspanel_laut_hide_all', 'Alle zusätzlichen laut.fm-Bereiche ausblenden')) ?></span>
    </label>
    <?php foreach (['schedule' => $allViewLabels['schedule'], 'stationinfo' => $allViewLabels['station'], 'playwith' => $allViewLabels['playwith'], 'trackhistory' => $allViewLabels['history'], 'currentsongmodal' => $allViewLabels['nowplaying']] as $param => $label): ?>
        <label class="pwf-check">
            <input type="checkbox" name="<?= h($param) ?>" value="y" data-panplay-feature-setting<?= panplayFlagEnabled($param) ? ' checked' : '' ?>>
            <span><?= h(sprintf($t('settings_toggle_show', '%s anzeigen'), $label)) ?></span>
        </label>
    <?php endforeach; ?>
    <label class="pwf-check">
        <input type="checkbox" name="lbn" value="y"<?= isset($_GET['lbn']) && $_GET['lbn'] === 'y' ? ' checked' : '' ?>>
        <span><?= h($et('live_by_name_checkbox_label', 'Live-Status zusätzlich aus dem Sendungsnamen ableiten')) ?></span>
    </label>
    <label class="pwf-check">
        <input type="checkbox" name="stationaccent" value="n" data-panplay-checked-value="n" data-panplay-unchecked-value="y"<?= isset($_GET['stationaccent']) && $_GET['stationaccent'] === 'n' ? ' checked' : '' ?>>
        <span><?= h($et('disable_station_accent_label', 'Automatische Akzentfarbe aus dem Senderlogo ausschalten')) ?></span>
    </label>
</fieldset>
