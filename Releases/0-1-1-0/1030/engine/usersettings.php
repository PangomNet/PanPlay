<?php

function panplaySettingsText($key, $fallback)
{
    global $lang;
    return isset($lang[$key]) ? $lang[$key] : $fallback;
}

function panplaySettingsCurrentParam($key, $default = '')
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function panplaySettingsParamValue($key, $default = '')
{
    return htmlspecialchars(panplaySettingsCurrentParam($key, $default), ENT_QUOTES, 'UTF-8');
}

function panplaySettingsCard($title, $icon, $body)
{
    echo '<div class="card text-white bg-dark mb-3">';
    echo '<div class="card-header"><b><i class="' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . '"></i>&nbsp; ' . $title . '</b></div>';
    echo '<div class="card-body">' . $body . '</div>';
    echo '</div>';
}

function panplaySettingsOptionLink($label, $url, $active = false)
{
    $class = $active ? 'btn-danger' : 'btn-outline-danger';
    return '<a class="btn ' . $class . ' btn-sm me-2 mb-2" href="' . $url . '">' . $label . '</a>';
}

function panplaySettingsRadio($name, $value, $label, $active = false, $disabled = false)
{
    $id = 'panplay-setting-' . preg_replace('/[^a-z0-9_-]/i', '-', $name . '-' . $value);
    $inputClass = 'btn-check';
    $labelClass = $disabled ? 'btn-outline-secondary disabled' : ($active ? 'btn-danger' : 'btn-outline-danger');
    return '<input type="radio" class="' . $inputClass . '" name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '" id="' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"' . ($active ? ' checked' : '') . ($disabled ? ' disabled' : '') . '>' .
        '<label class="btn ' . $labelClass . ' btn-sm me-2 mb-2" for="' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '">' . $label . '</label>';
}

function panplaySettingsBoolLabel($enabled)
{
    return $enabled
        ? panplaySettingsText('settingspanel_on', 'On')
        : panplaySettingsText('settingspanel_off', 'Off');
}

function panplaySettingsHiddenInputs($exclude)
{
    foreach ($_GET as $key => $value) {
        if (in_array($key, $exclude, true) || is_array($value)) {
            continue;
        }
        echo '<input type="hidden" name="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '">';
    }
    echo '<input type="hidden" name="settings" value="open">';
}

$handledSettingsParams = [
    'settings',
    'hl',
    'theme',
    'webstream',
    'schedule',
    'stationinfo',
    'playwith',
    'trackhistory',
    'currentsongmodal',
    'lbn',
    'nolfmw',
];
panplaySettingsHiddenInputs($handledSettingsParams);

$available_languages = [
    'en' => '<span class="badge bg-danger">EN</span> English (Intl.)',
    'de' => '<span class="badge bg-danger">DE</span> German / Deutsch',
    'fr' => '<span class="badge bg-danger">FR</span> French / Francais',
    'it' => '<span class="badge bg-danger">IT</span> Italian / Italiano',
    'da' => '<span class="badge bg-danger">DA</span> Danish / Dansk',
    'es' => '<span class="badge bg-danger">ES</span> Spanish / Espanol',
    'nl' => '<span class="badge bg-danger">NL</span> Dutch / Nederlands',
    'zh-hans' => '<span class="badge bg-danger">ZH-HANS</span> Chinese (simplified)',
    'hi' => '<span class="badge bg-danger">HI</span> Hindi',
];

$available_languages = array_filter($available_languages, function ($lang_code) {
    return file_exists(__DIR__ . "/lang/$lang_code.php");
}, ARRAY_FILTER_USE_KEY);

$languageBody = '<p class="card-text fs-6"><small>' .
    htmlspecialchars($lang['settingspanel_lang_desc'], ENT_QUOTES, 'UTF-8') .
    '<br><i class="fas fa-info"></i> <i>' .
    htmlspecialchars($lang['settingspanel_lang_ext_desc'], ENT_QUOTES, 'UTF-8') .
    '</i></small></p>';

foreach ($available_languages as $lang_code => $lang_name) {
    $languageBody .= panplaySettingsRadio(
        'hl',
        $lang_code,
        $lang_name,
        $language === $lang_code
    );
}

panplaySettingsCard(
    htmlspecialchars($lang['settingspanel_lang_title'], ENT_QUOTES, 'UTF-8'),
    'fas fa-language',
    $languageBody
);

$themes = [
    '' => 'Default',
    'light' => 'Light',
    'glass' => 'Glass',
    'aero' => 'Aero',
    'laut' => 'Laut',
    'hc-dark' => 'High Contrast Dark',
    'win9x' => 'Windows 9x',
    'bs-cosmo' => 'Bootstrap Cosmo',
];

$currentTheme = panplaySettingsCurrentParam('theme', '');
$themeBody = '<p class="card-text fs-6"><small>' .
    htmlspecialchars(panplaySettingsText('settingspanel_theme_desc', 'Choose a visual theme for this player URL. This only changes the generated URL parameter and does not change server configuration.'), ENT_QUOTES, 'UTF-8') .
    '</small></p>';

foreach ($themes as $themeCode => $themeName) {
    $themeBody .= panplaySettingsRadio(
        'theme',
        $themeCode,
        htmlspecialchars($themeName, ENT_QUOTES, 'UTF-8'),
        $currentTheme === $themeCode
    );
}

panplaySettingsCard(
    htmlspecialchars(panplaySettingsText('settingspanel_theme_title', 'Theme'), ENT_QUOTES, 'UTF-8'),
    'fas fa-palette',
    $themeBody
);

$extensionOptionsPath = 'engine/extensions/' . $playermode . '/ext-options.php';
if (file_exists($extensionOptionsPath)) {
    require($extensionOptionsPath);
}

?>
