<?php

$streamValue = panplaySettingsParamValue('webstream');
$body = '<p class="card-text fs-6"><small>' .
    htmlspecialchars(panplaySettingsText('settingspanel_baseaudio_desc', 'Change the direct audio URL used by baseaudio. Applying this reloads the player with a new webstream URL parameter.'), ENT_QUOTES, 'UTF-8') .
    '</small></p>';

$body .= '<div class="input-group">';
$body .= '<input class="form-control bg-dark text-white border-danger" type="url" name="webstream" value="' . $streamValue . '" placeholder="https://example.com/audio.mp3">';
$body .= '</div>';

panplaySettingsCard(
    htmlspecialchars(panplaySettingsText('settingspanel_extension_title', 'Extension settings'), ENT_QUOTES, 'UTF-8'),
    'fas fa-plug',
    $body
);

?>
