<?php
function getPreferredLanguage($default = 'en') {
    if (isset($_COOKIE['lang'])) {
        return $_COOKIE['lang'];
    }

    if (isset($_GET['hl'])) {
        $selected_lang = $_GET['hl'];
        if (file_exists(__DIR__ . "/lang/$selected_lang.php")) {
            return $selected_lang;
        }
    }

    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($langs as $lang) {
            $lang = strtolower(str_replace('-', '_', trim($lang)));
            if (file_exists(__DIR__ . "/lang/$lang.php")) {
                return $lang;
            }
            // Check the first two characters if specific regional file does not exist
            $lang = substr($lang, 0, 2);
            if (file_exists(__DIR__ . "/lang/$lang.php")) {
                return $lang;
            }
        }
    }

    return $default;
}

$language = getPreferredLanguage();

if (isset($_GET['hl'])) {
    $selected_lang = $_GET['hl'];
    if (file_exists(__DIR__ . "/lang/$selected_lang.php")) {
        $language = $selected_lang;
        if (isset($_GET['remember']) && $_GET['remember'] == '1') {
            setcookie('lang', $selected_lang, time() + (3600 * 24 * 30)); // 30 Tage
        }
    }
}

include(__DIR__ . "/lang/$language.php");
?>