<?php
declare(strict_types=1);

if ($hideLautWindows) {
    return [];
}

$views = [];
if (panplayFlagEnabled('trackhistory')) {
    $views['history'] = $allViewLabels['history'];
}
if (panplayFlagEnabled('schedule')) {
    $views['schedule'] = $allViewLabels['schedule'];
}
if (panplayFlagEnabled('stationinfo')) {
    $views['station'] = $allViewLabels['station'];
}

return $views;
