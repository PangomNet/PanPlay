<?php
declare(strict_types=1);

if (!isset($primaryViews['history'])) {
    return;
}
?>
<section class="panplay-view pwf-content-section" data-panplay-view-panel="history"<?= hiddenView('history', $view) ?>>
    <div class="pwf-section-heading"><h1><?= h($allViewLabels['history']) ?></h1></div>
    <div class="panplay-data-list" data-panplay-history>
        <div class="pwf-empty-state">
            <h2><?= h($et('empty_state_title', 'Noch keine Daten')) ?></h2>
            <p><?= h($et('history_loading_desc', 'Die Titelhistorie wird geladen.')) ?></p>
        </div>
    </div>
</section>
