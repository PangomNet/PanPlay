<?php
declare(strict_types=1);
?>
<fieldset class="pwf-panel panplay-settings-group">
    <legend><?= h($et('settings_source_legend', 'Audioquelle')) ?></legend>
    <label class="pwf-field">
        <span class="pwf-label"><?= h($et('direct_audio_url_label', 'Direkte Audio-URL')) ?></span>
        <input class="pwf-input" type="url" name="webstream" value="<?= h($streamUrl) ?>">
    </label>
</fieldset>
<div class="pwf-status pwf-status--info">
    <strong><?= h($et('cpm_info_title', 'CPM')) ?>:</strong>
    <?= h(!empty($cfg_panplay_cpm) ? $et('cpm_info_enabled', 'aktiv') : $et('cpm_info_disabled', 'inaktiv')) ?><?= !empty($cfg_panplay_cpm_by_cdn) ? h($et('settings_cpm_cdn_suffix', ', zentrale Liste aktiv')) : '' ?>.
    <?= h($et('settings_cpm_managed_note', 'Diese Einstellung wird vom Serverbetreiber verwaltet.')) ?>
</div>
