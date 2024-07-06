<?php
// Funktion zur Bestimmung der verfügbaren Sprachen basierend auf den Sprachdateien im 'lang/'-Verzeichnis
function getAvailableLanguages() {
    $available_languages = [];
    $lang_files = glob(__DIR__ . '/lang/*.php');
    foreach ($lang_files as $file) {
        $lang_code = basename($file, '.php');
        // Extrahiere die Sprache aus dem Dateinamen
        $lang_parts = explode('-', $lang_code);
        $lang_name = ucfirst($lang_parts[0]); // Den ersten Teil des Dateinamens als Sprachname verwenden
        $available_languages[$lang_code] = $lang_name;
    }
    return $available_languages;
}

// Verfügbare Sprachen abrufen
$available_languages = getAvailableLanguages();

$available_languages = [
    'en' => '<span class="badge bg-danger">EN</span> English (Intl.)',
    'de' => '<span class="badge bg-danger">DE</span> German / Deutsch', // Der Anzeigetext in der Dropdown-Liste ist "German"
    'fr' => '<span class="badge bg-danger">FR</span> French / Francias',
    'it' => '<span class="badge bg-danger">IT</span> Italian / Italiano',
    'dk' => '<span class="badge bg-danger">DK</span> Danish / Dansk (Experimental!)',
    'es' => '<span class="badge bg-danger">ES</span> Spanish / Espanol'
];

// Filtern Sie verfügbare Sprachen basierend auf vorhandenen Sprachdateien
$available_languages = array_filter($available_languages, function($lang_code) {
    return file_exists(__DIR__ . "/lang/$lang_code.php");
}, ARRAY_FILTER_USE_KEY);


// Aktuelle URL mit allen vorhandenen Parametern
$current_url = strtok($_SERVER["REQUEST_URI"], '?');

// Den Sprachumschalter-Code mit dem Parameter 'hl' für die Sprache und Beibehaltung der anderen Parameter erstellen
$language_settings_code = <<<HTML
<div class="card text-white bg-dark">
  <div class="card-header">
    <b><i class="fas fa-language"></i>&nbsp;  {$lang["settingspanel_lang_title"]} </b>
  </div>
  <div class="card-body">
  <p class="card-text fs-6"><small>{$lang["settingspanel_lang_desc"]}</small></p>
<p><small>{$lang['current_language']}</small></p>
<form method="get" action="" class="dropdown">
    <input type="hidden" name="hl" value="{$language}">
    <ul class="list-group">
HTML;

foreach($available_languages as $lang_code => $lang_name) {
    // Erstellen Sie den Link mit allen vorhandenen Parametern und dem neuen 'hl'-Parameter
    $params = $_GET;
    $params['hl'] = $lang_code;
    $query_string = http_build_query($params);
    $lang_link = strtok($_SERVER["REQUEST_URI"], '?') . '?' . $query_string;
    $language_settings_code .= <<<HTML
        <a class="list-group-item list-group-item-action bg-dark" href="{$lang_link}">
            {$lang_name}
        </a>
HTML;
}

$language_settings_code .= <<<HTML
    </ul><br>
    <small><i> {$lang["settingspanel_lang_ext_desc"]}</i></small>

</form>
</div>
</div>
HTML;

echo $language_settings_code;

?>