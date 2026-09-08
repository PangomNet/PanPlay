<?php
declare(strict_types=1);

if (!isset($primaryViews['schedule'])) {
    return;
}
?>
<section class="panplay-view pwf-content-section" data-panplay-view-panel="schedule"<?= hiddenView('schedule', $view) ?>>
    <div class="pwf-section-heading"><h1><?= h($allViewLabels['schedule']) ?></h1></div>
    <div class="panplay-schedule" data-panplay-schedule>
        <div class="pwf-empty-state">
            <h2><?= h($et('empty_state_title', 'Noch keine Daten')) ?></h2>
            <p><?= h($et('schedule_loading_desc', 'Der Wochenplan wird geladen.')) ?></p>
        </div>
    </div>
</section>
