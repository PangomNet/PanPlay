<?php

// Aktuelle URL mit allen vorhandenen Parametern
$current_url = strtok($_SERVER["REQUEST_URI"], '?');

// Den Sprachumschalter-Code mit dem Parameter 'hl' für die Sprache und Beibehaltung der anderen Parameter erstellen
$language_settings_code = <<<HTML
<br>
<div class="card text-white bg-dark">
  <div class="card-header">
    <b><i class="fas fa-language"></i>&nbsp;  {$lang["settingspanel_lang_title"]} </b>
  </div>
  <div class="card-body">
  <p class="card-text fs-6"><small>{$lang["settingspanel_lang_desc"]}</small></p>

<form method="get" action="" class="dropdown">
    <input type="hidden" name="hl" value="{$language}">
    <div class="dropdown">
  <a class="btn btn-outline-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
  {$lang['current_language']}
  </a>
    <ul class="dropdown-menu bg-dark">
HTML;




$language_settings_code .= <<<HTML
    </ul>
    </div><br>
    <small><i> {$lang["settingspanel_lang_ext_desc"]}</i></small>

</form>
</div>
</div>

<br>
<small>ℹ Unfortunately, there is nothing here yet. But well done, to find the ''laut' extension settings for PanPlay.</small>
HTML;
?>