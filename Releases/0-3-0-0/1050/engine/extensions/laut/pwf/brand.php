<?php
declare(strict_types=1);
?>
<a class="pwf-app__brand panplay-brand" href="<?= h(panplayUrl('player')) ?>" data-panplay-route="player" aria-label="PanPlay Player">
    <img class="panplay-brand__image" data-panplay-brand-image alt="" hidden>
    <span class="panplay-brand__note" data-panplay-brand-note aria-hidden="true">♪</span>
    <span data-panplay-brand-label><?= h($station) ?></span>
</a>
