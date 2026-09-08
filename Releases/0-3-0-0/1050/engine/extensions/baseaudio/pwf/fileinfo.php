<?php
declare(strict_types=1);
?>
<section class="panplay-view pwf-content-section" data-panplay-view-panel="fileinfo"<?= hiddenView('fileinfo', $view) ?>>
    <div class="pwf-section-heading"><h1><?= h($allViewLabels['fileinfo']) ?></h1></div>
    <div class="panplay-file-profile">
        <div class="panplay-file-art">
            <img alt="<?= h($et('cover_alt_prefix', 'Cover von') . ' ' . $baseTitle) ?>"<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>>
            <span<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span>
        </div>
        <dl class="panplay-facts">
            <?php
            metadataRow($et('metadata_title_label', 'Titel'), $baseaudioMetadata, 'title');
            metadataRow($et('metadata_artist_label', 'Interpret'), $baseaudioMetadata, 'artist');
            metadataRow($et('metadata_album_label', 'Album'), $baseaudioMetadata, 'album');
            metadataRow($et('metadata_genre_label', 'Genre'), $baseaudioMetadata, 'genre');
            metadataRow($et('metadata_year_label', 'Jahr'), $baseaudioMetadata, 'year');
            metadataRow($et('metadata_duration_label', 'Dauer'), $baseaudioMetadata, 'duration_label');
            metadataRow($et('metadata_format_label', 'Format'), $baseaudioMetadata, 'format');
            metadataRow($et('metadata_codec_label', 'Codec'), $baseaudioMetadata, 'codec');
            metadataRow($et('metadata_bitrate_label', 'Bitrate'), $baseaudioMetadata, 'bitrate_kbps', ' kbit/s');
            metadataRow($et('metadata_sample_rate_label', 'Abtastrate'), $baseaudioMetadata, 'sample_rate_hz', ' Hz');
            metadataRow($et('metadata_channels_label', 'Kanäle'), $baseaudioMetadata, 'channels');
            metadataRow($et('metadata_filesize_label', 'Dateigröße'), $baseaudioMetadata, 'filesize_bytes', ' Bytes');
            ?>
            <div>
                <dt><?= h($et('metadata_source_label', 'Quelle')) ?></dt>
                <dd><a href="<?= h($streamUrl) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) parse_url($streamUrl, PHP_URL_HOST)) ?></a></dd>
            </div>
        </dl>
    </div>
</section>
