<?php
$metadata = isset($baseaudioMetadata) && is_array($baseaudioMetadata)
    ? $baseaudioMetadata
    : panplayBaseaudioMetadataFallback((string) $webstream, 'not_initialized');

$escape = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};

$title = $metadata['title'] !== '' ? $metadata['title'] : (string) $webstream;
$formatParts = array_filter([$metadata['format'], $metadata['codec']], static function ($value): bool {
    return $value !== '';
});
$details = [
    $ext_lang['metadata_title_label'] => $title,
    $ext_lang['metadata_artist_label'] => $metadata['artist'],
    $ext_lang['metadata_album_label'] => $metadata['album'],
    $ext_lang['metadata_genre_label'] => $metadata['genre'],
    $ext_lang['metadata_year_label'] => $metadata['year'],
    $ext_lang['metadata_duration_label'] => $metadata['duration_label'],
    $ext_lang['metadata_format_label'] => implode(' · ', $formatParts),
    $ext_lang['metadata_bitrate_label'] => $metadata['bitrate_kbps'] !== null ? $metadata['bitrate_kbps'] . ' kbit/s' : '',
    $ext_lang['metadata_sample_rate_label'] => $metadata['sample_rate_hz'] !== null ? number_format($metadata['sample_rate_hz'] / 1000, 1, '.', '') . ' kHz' : '',
    $ext_lang['metadata_channels_label'] => $metadata['channels'] !== null ? (string) $metadata['channels'] : '',
    $ext_lang['metadata_filesize_label'] => $metadata['filesize_bytes'] !== null ? panplayBaseaudioMetadataFormatBytes((int) $metadata['filesize_bytes']) : '',
    $ext_lang['metadata_source_label'] => $metadata['source_host'],
];
?>

<div class="modal fade" id="playwith_modal" tabindex="-1" aria-labelledby="playwith_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playwith_modal_title"><i class="far fa-play-circle" aria-hidden="true"></i>&nbsp; <?= $escape($ext_lang['playwith_modal_title']) ?></h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p><?= $escape($ext_lang['playwith_modal_topdesc']) ?></p>
                <input type="text" class="form-control" value="<?= $escape($webstream) ?>" readonly>
                <a class="btn btn-dark w-100 mt-3" target="_blank" rel="noopener noreferrer" href="<?= $escape($webstream) ?>"><?= $escape($ext_lang['directstreamtobrowserdropdown']) ?></a>
                <p class="small mt-3 mb-0"><?= $escape($ext_lang['playwith_modal_gcast_topdesc1']) ?><strong><?= $escape($title) ?></strong><?= $escape($ext_lang['playwith_modal_gcast_topdesc2']) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fileinfo_modal" tabindex="-1" aria-labelledby="fileinfo_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-break" id="fileinfo_modal_title"><i class="fas fa-file-audio" aria-hidden="true"></i>&nbsp; <?= $escape($title) ?></h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <?php if (empty($metadata['analyzed'])): ?>
                    <div class="alert alert-secondary" role="status"><?= $escape($ext_lang['metadata_tags_unavailable']) ?></div>
                <?php endif; ?>
                <h6><?= $escape($ext_lang['metadata_file_details']) ?></h6>
                <dl class="row mb-0">
                    <?php foreach ($details as $label => $value): ?>
                        <?php if ($value !== ''): ?>
                            <dt class="col-sm-4"><?= $escape($label) ?></dt>
                            <dd class="col-sm-8 text-break"><?= $escape($value) ?></dd>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </dl>
                <hr>
                <label class="form-label" for="baseaudio_source_url"><?= $escape($ext_lang['metadata_source_label']) ?></label>
                <input id="baseaudio_source_url" type="text" class="form-control" value="<?= $escape($webstream) ?>" readonly>
            </div>
        </div>
    </div>
</div>
