<?php
$metadata = isset($baseaudioMetadata) && is_array($baseaudioMetadata)
    ? $baseaudioMetadata
    : panplayBaseaudioMetadataFallback((string) $webstream, 'not_initialized');

$escape = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};

$title = $metadata['title'] !== '' ? $metadata['title'] : (string) $webstream;
$artist = (string) $metadata['artist'];
$album = (string) $metadata['album'];
$coverUrl = $metadata['artwork_data_uri'] !== ''
    ? $metadata['artwork_data_uri']
    : 'engine/extensions/baseaudio/placeholder-cover.png';
$backgroundUrl = $metadata['artwork_data_uri'] !== ''
    ? $metadata['artwork_data_uri']
    : 'engine/extensions/baseaudio/bg.png';

$badges = [];
if ($metadata['format'] !== '') {
    $badges[] = ['icon' => 'fa-file-audio', 'value' => $metadata['format'], 'label' => $ext_lang['metadata_format_label']];
}
if ($metadata['duration_label'] !== '') {
    $badges[] = ['icon' => 'fa-clock', 'value' => $metadata['duration_label'], 'label' => $ext_lang['metadata_duration_label']];
}
if ($metadata['bitrate_kbps'] !== null) {
    $badges[] = ['icon' => 'fa-wave-square', 'value' => $metadata['bitrate_kbps'] . ' kbit/s', 'label' => $ext_lang['metadata_bitrate_label']];
}
?>
<style>
body {
    background-image: url('<?= $escape($backgroundUrl) ?>');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

#oop_player.baseaudio-player-shell {
    width: min(760px, 92vw);
    max-height: calc(100vh - 150px);
    overflow-x: hidden;
    overflow-y: auto;
}

.baseaudio-stage {
    text-align: center;
}

.baseaudio-cover-button {
    position: relative;
    display: inline-block;
    max-width: 100%;
    padding: 0;
    border: 0;
    border-radius: 8px;
    overflow: hidden;
    line-height: 0;
    background: #090909;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.38);
    cursor: pointer;
}

.baseaudio-cover {
    display: block;
    width: min(46vh, 480px, 76vw);
    height: min(46vh, 480px, 76vw);
    object-fit: cover;
}

.baseaudio-cover-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: rgba(0, 0, 0, 0.48);
    opacity: 0;
    transition: opacity 0.2s ease;
}

.baseaudio-cover-button:hover .baseaudio-cover-overlay,
.baseaudio-cover-button:focus-visible .baseaudio-cover-overlay {
    opacity: 1;
}

.baseaudio-cover-overlay i {
    font-size: 3.5rem;
    filter: drop-shadow(0 2px 8px #000);
}

.baseaudio-copy {
    margin: 14px auto 0;
    max-width: 680px;
    color: #fff;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.85);
}

.baseaudio-title {
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    border: 0;
    background: transparent;
    color: inherit;
    font: inherit;
    cursor: pointer;
}

.baseaudio-title h1 {
    margin: 0;
    font-size: clamp(1.25rem, 2.5vw, 2rem);
    line-height: 1.25;
    white-space: normal !important;
    overflow-wrap: anywhere;
    transform: none !important;
    animation: none !important;
}

.baseaudio-artist,
.baseaudio-album,
.baseaudio-source {
    margin: 5px 0 0;
    overflow-wrap: anywhere;
}

.baseaudio-album,
.baseaudio-source {
    font-size: 0.88rem;
    opacity: 0.78;
}

.baseaudio-badges {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 7px;
    margin-top: 12px;
}

.baseaudio-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 9px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 5px;
    background: rgba(0, 0, 0, 0.38);
    color: #fff;
    font-size: 0.78rem;
}

@media (hover: none) {
    .baseaudio-cover-overlay {
        opacity: 0.18;
    }
}

@media (max-height: 700px) {
    .baseaudio-cover {
        width: min(34vh, 300px, 68vw);
        height: min(34vh, 300px, 68vw);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var player = document.getElementById('oop_player');
    if (player) {
        player.classList.add('baseaudio-player-shell');
    }
});
</script>

<div id="ooweb_songcover" class="baseaudio-stage">
    <button class="baseaudio-cover-button" type="button" onclick="playPause()" aria-label="<?= $escape($title) ?>">
        <img id="songcover" class="baseaudio-cover" src="<?= $escape($coverUrl) ?>" alt="<?= $escape($title) ?>">
        <span class="baseaudio-cover-overlay" aria-hidden="true">
            <i id="pp-overlay-icon" class="fas fa-play"></i>
        </span>
    </button>

    <div class="baseaudio-copy">
        <button id="currentsong_lbl" class="baseaudio-title" type="button" data-bs-toggle="modal" data-bs-target="#fileinfo_modal">
            <h1 id="currentsong_lbl_holder" title="<?= $escape($title) ?>"><?= $escape($title) ?></h1>
        </button>
        <?php if ($artist !== ''): ?>
            <p id="currentartist_lbl" class="baseaudio-artist"><?= $escape($artist) ?></p>
        <?php endif; ?>
        <?php if ($album !== ''): ?>
            <p id="currentalbum_lbl" class="baseaudio-album"><?= $escape($album) ?></p>
        <?php endif; ?>
        <?php if ($metadata['source_host'] !== ''): ?>
            <p class="baseaudio-source"><i class="fas fa-link" aria-hidden="true"></i>&nbsp; <?= $escape($metadata['source_host']) ?></p>
        <?php endif; ?>

        <?php if ($badges !== []): ?>
            <div class="baseaudio-badges" aria-label="<?= $escape($ext_lang['metadata_file_details']) ?>">
                <?php foreach ($badges as $badge): ?>
                    <span class="baseaudio-badge" title="<?= $escape($badge['label']) ?>">
                        <i class="fas <?= $escape($badge['icon']) ?>" aria-hidden="true"></i>
                        <?= $escape($badge['value']) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
