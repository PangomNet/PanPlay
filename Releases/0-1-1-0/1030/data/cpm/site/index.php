<?php
declare(strict_types=1);

header('Content-Type: text/html; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self'; style-src 'self'; img-src 'self' data:; object-src 'none'; base-uri 'self'; frame-ancestors 'none'; form-action 'self'");

$languageAliases = [
    'da' => 'da',
    'de' => 'de',
    'de-at' => 'de',
    'de-ch' => 'de',
    'en' => 'en',
    'en-us' => 'en',
    'en-uk' => 'en',
    'es' => 'es',
    'es-ar' => 'es',
    'es-la' => 'es',
    'es-mx' => 'es',
    'fr' => 'fr',
    'hi' => 'hi',
    'it' => 'it',
    'nl' => 'nl',
    'nl-be' => 'nl',
    'zh' => 'zh-hans',
    'zh-hans' => 'zh-hans',
    'zh-cn' => 'zh-hans',
    'zh-sg' => 'zh-hans',
];

$languageLabels = [
    'en' => 'English',
    'de' => 'Deutsch',
    'fr' => 'Français',
    'it' => 'Italiano',
    'da' => 'Dansk',
    'es' => 'Español',
    'nl' => 'Nederlands',
    'zh-hans' => '简体中文',
    'hi' => 'हिन्दी',
];

function cpmSiteNormalizeLanguage(string $language): string
{
    return strtolower(str_replace('_', '-', trim($language)));
}

function cpmSiteDetectLanguage(array $aliases): string
{
    $requested = isset($_GET['hl']) && is_string($_GET['hl'])
        ? cpmSiteNormalizeLanguage($_GET['hl'])
        : '';

    if ($requested !== '' && isset($aliases[$requested])) {
        return $aliases[$requested];
    }

    $accepted = isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
        ? explode(',', (string) $_SERVER['HTTP_ACCEPT_LANGUAGE'])
        : [];

    foreach ($accepted as $entry) {
        $candidate = cpmSiteNormalizeLanguage(explode(';', $entry, 2)[0]);
        if (isset($aliases[$candidate])) {
            return $aliases[$candidate];
        }

        $base = explode('-', $candidate, 2)[0];
        if (isset($aliases[$base])) {
            return $aliases[$base];
        }
    }

    return 'en';
}

function cpmSiteEscape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$language = cpmSiteDetectLanguage($languageAliases);
$languageFile = __DIR__ . '/lang/' . $language . '.php';
$cpmSite = [];

if (is_file($languageFile)) {
    require $languageFile;
}

if (!isset($cpmSite['meta_title'])) {
    require __DIR__ . '/lang/en.php';
    $language = 'en';
}

$text = static function (string $key) use ($cpmSite): string {
    return isset($cpmSite[$key]) ? (string) $cpmSite[$key] : $key;
};
?>
<!doctype html>
<html lang="<?= cpmSiteEscape($language) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="description" content="<?= cpmSiteEscape($text('meta_description')) ?>">
    <title><?= cpmSiteEscape($text('meta_title')) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
    <div class="shell header-inner">
        <a class="brand" href="https://play.pangom.net/" aria-label="PanPlay">
            <span class="brand-icon" aria-hidden="true">♪</span>
            <span>PanPlay</span>
        </a>
        <form class="language-form" method="get" action="">
            <label for="language"><?= cpmSiteEscape($text('language_label')) ?></label>
            <select id="language" name="hl">
                <?php foreach ($languageLabels as $code => $label): ?>
                    <option value="<?= cpmSiteEscape($code) ?>" <?= $code === $language ? 'selected' : '' ?>><?= cpmSiteEscape($label) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit"><?= cpmSiteEscape($text('language_apply')) ?></button>
        </form>
    </div>
</header>

<main>
    <section class="intro-band">
        <div class="shell intro-layout">
            <div>
                <p class="eyebrow"><?= cpmSiteEscape($text('status_label')) ?></p>
                <h1><?= cpmSiteEscape($text('title')) ?></h1>
                <p class="lead"><?= cpmSiteEscape($text('lead')) ?></p>
            </div>
            <aside class="status-panel" aria-label="<?= cpmSiteEscape($text('current_title')) ?>">
                <span class="status-dot" aria-hidden="true"></span>
                <div>
                    <strong><?= cpmSiteEscape($text('current_title')) ?></strong>
                    <p><?= cpmSiteEscape($text('current_body')) ?></p>
                </div>
            </aside>
        </div>
    </section>

    <section class="content-band">
        <div class="shell two-column">
            <article>
                <h2><?= cpmSiteEscape($text('what_title')) ?></h2>
                <p><?= cpmSiteEscape($text('what_body')) ?></p>
            </article>
            <article>
                <h2><?= cpmSiteEscape($text('geography_title')) ?></h2>
                <p><?= cpmSiteEscape($text('geography_body')) ?></p>
            </article>
        </div>
    </section>

    <section class="content-band alternate">
        <div class="shell two-column">
            <article>
                <h2><?= cpmSiteEscape($text('why_title')) ?></h2>
                <p><?= cpmSiteEscape($text('why_body')) ?></p>
            </article>
            <article>
                <h2><?= cpmSiteEscape($text('effect_title')) ?></h2>
                <p><?= cpmSiteEscape($text('effect_body')) ?></p>
            </article>
        </div>
    </section>

    <section class="content-band">
        <div class="shell">
            <h2><?= cpmSiteEscape($text('flow_title')) ?></h2>
            <ol class="flow-list">
                <?php for ($step = 1; $step <= 5; $step++): ?>
                    <li><span><?= $step ?></span><p><?= cpmSiteEscape($text('flow_' . $step)) ?></p></li>
                <?php endfor; ?>
            </ol>
        </div>
    </section>

    <section class="content-band">
        <div class="shell">
            <h2><?= cpmSiteEscape($text('lists_title')) ?></h2>
            <div class="three-column">
                <article>
                    <h3><?= cpmSiteEscape($text('local_title')) ?></h3>
                    <p><?= cpmSiteEscape($text('local_body')) ?></p>
                </article>
                <article>
                    <h3><?= cpmSiteEscape($text('central_title')) ?></h3>
                    <p><?= cpmSiteEscape($text('central_body')) ?></p>
                </article>
                <article>
                    <h3><?= cpmSiteEscape($text('exceptions_title')) ?></h3>
                    <p><?= cpmSiteEscape($text('exceptions_body')) ?></p>
                </article>
            </div>
        </div>
    </section>

    <section class="content-band rules-band">
        <div class="shell rules-layout">
            <div>
                <h2><?= cpmSiteEscape($text('rules_title')) ?></h2>
                <p><?= cpmSiteEscape($text('rules_intro')) ?></p>
            </div>
            <pre><code>! <?= cpmSiteEscape($text('rule_comment')) ?>
||example.com^
https://example.com/audio/file.mp3
*keyword*
@@||example.com/allowed-file.mp3
!@import https://example.com/list.txt</code></pre>
        </div>
    </section>

    <section class="content-band">
        <div class="shell two-column">
            <article>
                <h2><?= cpmSiteEscape($text('privacy_title')) ?></h2>
                <p><?= cpmSiteEscape($text('privacy_body')) ?></p>
            </article>
            <article>
                <h2><?= cpmSiteEscape($text('operator_title')) ?></h2>
                <p><?= cpmSiteEscape($text('operator_body')) ?></p>
            </article>
            <article>
                <h2><?= cpmSiteEscape($text('complaints_title')) ?></h2>
                <p><?= cpmSiteEscape($text('complaints_body')) ?></p>
                <a class="text-link" href="https://play.pangom.net/?page_id=92"><?= cpmSiteEscape($text('contact_link')) ?></a>
            </article>
            <article>
                <h2><?= cpmSiteEscape($text('limits_title')) ?></h2>
                <p><?= cpmSiteEscape($text('limits_body')) ?></p>
            </article>
        </div>
    </section>

    <section class="resource-band">
        <div class="shell">
            <h2><?= cpmSiteEscape($text('resources_title')) ?></h2>
            <div class="resource-links">
                <a href="filterlist.txt"><strong><?= cpmSiteEscape($text('filterlist_link')) ?></strong><span>play.pangom.net/cpm/filterlist.txt</span></a>
                <a href="https://github.com/hagezi/dns-blocklists"><strong><?= cpmSiteEscape($text('source_link')) ?></strong><span>HaGeZi DNS Blocklists · GPL-3.0</span></a>
                <a href="https://github.com/PangomNet/PanPlay"><strong><?= cpmSiteEscape($text('repository_link')) ?></strong><span>github.com/PangomNet/PanPlay</span></a>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="shell footer-inner">
        <p><?= cpmSiteEscape($text('footer_note')) ?></p>
        <a href="https://play.pangom.net/">PanPlay</a>
    </div>
</footer>
</body>
</html>
