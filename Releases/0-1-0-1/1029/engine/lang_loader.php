<?php
function normalizeLanguageCode($langCode) {
    return strtolower(str_replace('_', '-', trim((string)$langCode)));
}

function languageFileExists($langCode) {
    return file_exists(__DIR__ . "/lang/$langCode.php");
}

function getPreferredLanguage($default = 'en', $autoDetect = true) {
    $default = normalizeLanguageCode($default);
    if (!languageFileExists($default)) {
        $default = substr($default, 0, 2);
    }
    if (!languageFileExists($default)) {
        $default = 'en';
    }

    if (isset($_COOKIE['lang'])) {
        $cookieLang = normalizeLanguageCode($_COOKIE['lang']);
        if (languageFileExists($cookieLang)) {
            return $cookieLang;
        }
    }

    if (isset($_GET['hl'])) {
        $selected_lang = normalizeLanguageCode($_GET['hl']);
        if (languageFileExists($selected_lang)) {
            return $selected_lang;
        }
    }

    if ($autoDetect && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($langs as $lang) {
            $lang = normalizeLanguageCode(explode(';', trim($lang))[0]);
            if (languageFileExists($lang)) {
                return $lang;
            }
            // Check the first two characters if specific regional file does not exist
            $lang = substr($lang, 0, 2);
            if (languageFileExists($lang)) {
                return $lang;
            }
        }
    }

    return $default;
}

$language = getPreferredLanguage($cfg_default_lang ?? 'en', empty($cfg_auto_lang_override));

if (isset($_GET['hl'])) {
    $selected_lang = normalizeLanguageCode($_GET['hl']);
    if (languageFileExists($selected_lang)) {
        $language = $selected_lang;
        if (isset($_GET['remember']) && $_GET['remember'] == '1') {
            setcookie('lang', $selected_lang, time() + (3600 * 24 * 30)); // 30 Tage
        }
    }
}

include(__DIR__ . "/lang/$language.php");
?>
