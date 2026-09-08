<?php
declare(strict_types=1);
?>
<div class="panplay-rich-grid" data-panplay-rich-grid hidden>
    <article class="pwf-info-card panplay-rich-card" data-panplay-station-summary-card hidden>
        <div>
            <h2><?= h($et('station_summary_heading', 'Über den Sender')) ?></h2>
            <p data-panplay-station-summary></p>
        </div>
    </article>
    <article class="pwf-info-card panplay-rich-card" data-panplay-rich-card hidden>
        <div>
            <h2><?= h($et('station_rich_content_heading', 'Vom Sender')) ?></h2>
            <div class="pwf-markdown" data-panplay-rich-content></div>
        </div>
    </article>
</div>
