<?php
declare(strict_types=1);

if (!isset($primaryViews['station'])) {
    return;
}
?>
<section class="panplay-view pwf-content-section" data-panplay-view-panel="station"<?= hiddenView('station', $view) ?>>
    <div class="pwf-section-heading"><h1 data-panplay-station-heading><?= h($et('stationinfo_heading', 'Senderinformation')) ?></h1></div>
    <div class="panplay-station-profile">
        <aside>
            <img data-panplay-station-image alt="" hidden>
            <div class="panplay-social-links" data-panplay-station-socials></div>
        </aside>
        <div class="panplay-station-copy">
            <h2 data-panplay-station-slogan hidden></h2>
            <p data-panplay-station-description></p>
            <div class="panplay-station-meta" data-panplay-station-meta></div>
            <div class="panplay-station-groups">
                <section data-panplay-station-group="djs" hidden>
                    <h3><?= h($et('station_djs_heading', 'DJs')) ?></h3>
                    <div class="panplay-tag-list" data-panplay-station-djs></div>
                </section>
                <section data-panplay-station-group="location" hidden>
                    <h3><?= h($et('station_location_heading', 'Standort')) ?></h3>
                    <div class="panplay-tag-list" data-panplay-station-location></div>
                </section>
                <section data-panplay-station-group="genres" hidden>
                    <h3><?= h($et('station_genres_heading', 'Genres')) ?></h3>
                    <div class="panplay-tag-list" data-panplay-station-genres></div>
                </section>
                <section data-panplay-station-group="artists" hidden>
                    <h3><?= h($et('station_top_artists_heading', 'Häufig gespielte Artists')) ?></h3>
                    <div class="panplay-tag-list" data-panplay-station-artists></div>
                </section>
            </div>
        </div>
    </div>
</section>
