<?php
declare(strict_types=1);

require_once __DIR__ . '/engine/runtime-bootstrap.php';

const PANPLAY_VERSION = '0.2.0.9';
const PANPLAY_BUILD = '1040';
const PANPLAY_ASSET_VERSION = '1040.1';
const PANPLAY_CHANNEL = 'Milestone 1';
const PWF_VERSION_USED = '0.1.0-alpha.6';
const PWF_COMMIT_USED = '6a11ee8';



$themes = [
    'panplay-default' => 'PanPlay Default', 'standard' => 'PWF Standard',
    'panplay-glass' => 'Liquid Glass', 'panplay-aero' => 'Aero',
    'panplay-aqua' => 'Mac OS X Aqua', 'panplay-winxp' => 'Windows XP Luna',
    'panplay-win9x' => 'Windows 9x', 'panplay-deepin' => 'Deepin',
    'panplay-cosmo' => 'Cosmo', 'panplay-light' => 'Light',
    'panplay-hc-dark' => 'High Contrast Dark', 'panplay-laut' => 'laut.fm',
];
$themeAliases = [
    'default' => 'panplay-default', 'glass' => 'panplay-glass', 'aero' => 'panplay-aero',
    'aqua' => 'panplay-aqua', 'winxp' => 'panplay-winxp', 'win9x' => 'panplay-win9x',
    'deepin' => 'panplay-deepin', 'cosmo' => 'panplay-cosmo', 'light' => 'panplay-light',
    'hcdark' => 'panplay-hc-dark', 'laut' => 'panplay-laut',
];
$allViewLabels = [
    'player' => 'Player', 'history' => 'Titelhistorie', 'schedule' => 'Sendeplan',
    'station' => 'Senderinfo', 'fileinfo' => 'Über Audioquelle', 'share' => 'Teilen',
    'nowplaying' => 'Aktueller Titel', 'playwith' => 'Player wechseln',
    'settings' => 'Einstellungen', 'about' => 'Über',
];
$languages = [
    'en' => 'English', 'en-us' => 'English (US)', 'en-uk' => 'English (UK)',
    'de' => 'Deutsch', 'de-at' => 'Deutsch (Österreich)', 'de-ch' => 'Deutsch (Schweiz)',
    'fr' => 'Français', 'it' => 'Italiano', 'da' => 'Dansk', 'es' => 'Español',
    'es-mx' => 'Español (México)', 'es-la' => 'Español (Latinoamérica)',
    'es-ar' => 'Español (Argentina)', 'nl' => 'Nederlands', 'nl-be' => 'Nederlands (België)',
    'zh-hans' => '简体中文', 'zh' => '中文', 'hi' => 'हिन्दी',
];

$requestedTheme = isset($_GET['theme']) ? strtolower(trim((string) $_GET['theme'])) : 'panplay-default';
$theme = isset($themes[$requestedTheme]) ? $requestedTheme : ($themeAliases[$requestedTheme] ?? 'panplay-default');
$mode = 'none';
$station = '';
$sourceName = 'Keine Audioquelle ausgewählt';
$streamUrl = '';
$baseaudioMetadata = [];
$runtimeLanguage = strtolower((string) ($language ?? 'de'));
$selectedLanguage = isset($_GET['hl']) && isset($languages[strtolower((string) $_GET['hl'])])
    ? strtolower((string) $_GET['hl'])
    : (isset($languages[$runtimeLanguage]) ? $runtimeLanguage : 'de');

if (isset($_GET['lfmstream'])) {
    $candidate = strtolower(trim((string) $_GET['lfmstream']));
    if (preg_match('/^[a-z0-9_-]{1,80}$/', $candidate) === 1) {
        $mode = 'laut.fm';
        $station = $candidate;
        $sourceName = $station . ' auf laut.fm';
        $streamUrl = 'https://stream.laut.fm/' . rawurlencode($station);
    }
} elseif (isset($_GET['webstream'])) {
    $candidate = str_replace(' ', '%20', trim((string) $_GET['webstream']));
    $scheme = strtolower((string) parse_url($candidate, PHP_URL_SCHEME));
    if (filter_var($candidate, FILTER_VALIDATE_URL) && in_array($scheme, ['http', 'https'], true)) {
        $mode = 'Baseaudio';
        $streamUrl = $candidate;
        $path = (string) parse_url($candidate, PHP_URL_PATH);
        $sourceName = basename($path) !== '' ? rawurldecode(basename($path)) : (string) parse_url($candidate, PHP_URL_HOST);
    }
}

if ($mode === 'Baseaudio' && $streamUrl !== '') {
    require_once __DIR__ . '/engine/extensions/baseaudio/cpm.php';
    panplayCpmEnforceBaseaudio($streamUrl);
    require_once __DIR__ . '/engine/extensions/baseaudio/metadata.php';
    $baseaudioMetadata = panplayBaseaudioReadMetadata($streamUrl);
    if (!empty($baseaudioMetadata['title'])) {
        $sourceName = (string) $baseaudioMetadata['title'];
    }
}

function panplayFlagEnabled(string $name, bool $default = true): bool
{
    if (!isset($_GET[$name])) {
        return $default;
    }
    return !in_array(strtolower((string) $_GET[$name]), ['n', 'no', '0', 'false'], true);
}

$hideLautWindows = isset($_GET['nolfmw']) && in_array(strtolower((string) $_GET['nolfmw']), ['y', 'j'], true);
$primaryViews = ['player' => 'Player'];
if ($mode === 'laut.fm' && !$hideLautWindows) {
    if (panplayFlagEnabled('trackhistory')) $primaryViews['history'] = 'Titelhistorie';
    if (panplayFlagEnabled('schedule')) $primaryViews['schedule'] = 'Sendeplan';
    if (panplayFlagEnabled('stationinfo')) $primaryViews['station'] = 'Senderinfo';
} elseif ($mode === 'Baseaudio') {
    $primaryViews['fileinfo'] = 'Über Audioquelle';
}
$primaryViews['share'] = 'Teilen';
$showPlayWith = $streamUrl !== '' && (!$hideLautWindows || $mode !== 'laut.fm') && panplayFlagEnabled('playwith');
$showNowPlaying = $streamUrl !== '' && (!$hideLautWindows || $mode !== 'laut.fm') && panplayFlagEnabled('currentsongmodal');
$availableViews = array_fill_keys(array_keys($primaryViews), true);
$availableViews['settings'] = true;
$availableViews['about'] = true;
if ($showPlayWith) $availableViews['playwith'] = true;
if ($showNowPlaying) $availableViews['nowplaying'] = true;
$requestedView = isset($_GET['view']) ? (string) $_GET['view'] : 'player';
$view = isset($availableViews[$requestedView]) ? $requestedView : 'player';

function panplayUrl(string $targetView): string
{
    $query = $_GET;
    $query['view'] = $targetView;
    return '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
}
function selectedView(string $candidate, string $current): string { return $candidate === $current ? ' aria-current="page"' : ''; }
function hiddenView(string $candidate, string $current): string { return $candidate === $current ? '' : ' hidden'; }
function h(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function metadataText(array $metadata, string $key): string
{
    $value = $metadata[$key] ?? '';
    return is_scalar($value) ? trim((string) $value) : '';
}
function metadataRow(string $label, array $metadata, string $key, string $suffix = ''): void
{
    $value = metadataText($metadata, $key);
    if ($value !== '') echo '<div><dt>' . h($label) . '</dt><dd>' . h($value . $suffix) . '</dd></div>';
}

$baseTitle = metadataText($baseaudioMetadata, 'title') ?: $sourceName;
$baseArtist = metadataText($baseaudioMetadata, 'artist');
$baseArtwork = metadataText($baseaudioMetadata, 'artwork_data_uri');
$clientConfig = [
    'labels' => $allViewLabels,
    'mode' => $mode,
    'station' => $station,
    'streamUrl' => $streamUrl,
    'sourceName' => $sourceName,
    'baseaudio' => $baseaudioMetadata,
];
$clientConfigJson = json_encode($clientConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<!doctype html>
<html lang="<?= h((string) $language) ?>" data-pwf-theme="<?= h($theme) ?>" data-pwf-color-scheme="dark" data-pwf-contrast="standard" data-pwf-motion="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>PanPlay <?= PANPLAY_VERSION ?> Fennel</title>
    <link rel="icon" type="image/png" href="rscs/favicons/favicon.png">
    <link rel="stylesheet" href="rscs/pwf/pwf.css">
    <link id="panplay-theme-stylesheet" rel="stylesheet" href="rscs/pwf/themes/<?= h($theme) ?>.css">
    <link rel="stylesheet" href="rscs/css/pangom.css">
    <link rel="stylesheet" href="rscs/css/panplay-alpha.css?v=<?= PANPLAY_ASSET_VERSION ?>">
</head>
<body class="pwf-app" data-pwf-accent="teal" data-pwf-layout-mode="wide" data-panplay-view="<?= h($view) ?>" data-panplay-mode="<?= h($mode) ?>" data-panplay-station="<?= h($station) ?>" data-panplay-source="<?= h($sourceName) ?>" data-panplay-stream="<?= h($streamUrl) ?>">
<a class="pwf-skip-link" href="#main">Zum Inhalt springen</a>
<header class="pwf-app__header"><div class="pwf-app__header-inner">
    <div class="pwf-app__header-primary">
        <?php if ($mode !== 'none'): ?>
            <a class="pwf-app__brand panplay-brand" href="<?= h(panplayUrl('player')) ?>" data-panplay-route="player" aria-label="PanPlay Player">
                <?php if ($mode === 'laut.fm'): ?>
                    <img class="panplay-brand__image" data-panplay-brand-image alt="" hidden>
                    <span class="panplay-brand__note" data-panplay-brand-note aria-hidden="true">♪</span>
                    <span data-panplay-brand-label><?= h($station) ?></span>
                <?php else: ?>
                    <span class="panplay-brand__note" aria-hidden="true">♪</span>
                <?php endif; ?>
            </a>
        <?php endif; ?>
        <nav class="pwf-app__tabs" aria-label="PanPlay Bereiche">
            <?php foreach ($primaryViews as $id => $label): ?><a class="pwf-app__tab" href="<?= h(panplayUrl($id)) ?>" data-panplay-route="<?= h($id) ?>"<?= selectedView($id, $view) ?>><?= h($label) ?></a><?php endforeach; ?>
        </nav>
        <details class="pwf-app__mobile-pages"><summary><span class="pwf-app__mobile-current" data-panplay-mobile-label><?= h($allViewLabels[$view]) ?></span><span class="pwf-app__mobile-disclosure" aria-hidden="true"></span></summary><nav class="pwf-app__mobile-menu" aria-label="PanPlay Bereiche mobil">
            <?php foreach ($primaryViews as $id => $label): ?><a href="<?= h(panplayUrl($id)) ?>" data-panplay-route="<?= h($id) ?>"><?= h($label) ?></a><?php endforeach; ?>
        </nav></details>
    </div>
    <nav class="pwf-app__actions" aria-label="Werkzeuge">
        <?php if ($showPlayWith): ?><a class="pwf-app__action" href="<?= h(panplayUrl('playwith')) ?>" data-panplay-route="playwith" title="Player wechseln" aria-label="Player wechseln"><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h10v2H4v12h10v2H2V4h2Zm12 4 6 4-6 4v-3h-6v-2h6V8Z" fill="currentColor" stroke="none"/></svg></a><?php endif; ?>
        <a class="pwf-app__action" href="<?= h(panplayUrl('settings')) ?>" data-panplay-route="settings" title="Einstellungen" aria-label="Einstellungen"><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m9.8 2 .5 2.2c.5.2 1 .4 1.4.8l2-1 2.3 2.3-1 2c.3.4.6.9.7 1.4l2.3.5v3.2l-2.3.5c-.1.5-.4 1-.7 1.4l1 2-2.3 2.3-2-1c-.4.3-.9.6-1.4.7L9.8 22H6.6l-.5-2.3a7 7 0 0 1-1.4-.7l-2 1-2.3-2.3 1-2a7 7 0 0 1-.7-1.4L-1.6 13.8v-3.2l2.3-.5c.1-.5.4-1 .7-1.4l-1-2 2.3-2.3 2 1c.4-.3.9-.6 1.4-.7L6.6 2h3.2ZM8.2 8.4a3.8 3.8 0 1 0 0 7.6 3.8 3.8 0 0 0 0-7.6Z" transform="translate(4 -0.2) scale(.92)" fill="currentColor" stroke="none"/></svg></a>
        <a class="pwf-app__action panplay-about-action" href="<?= h(panplayUrl('about')) ?>" data-panplay-route="about" title="Über PanPlay" aria-label="Über PanPlay"><span aria-hidden="true">♪ Pan<span>Play</span></span></a>
    </nav>
</div></header>

<main class="pwf-app__main" id="main">
    <div class="panplay-stage-background" data-panplay-background aria-hidden="true"></div>
    <div class="pwf-app__stage"><div class="pwf-app__content">
        <section class="panplay-view panplay-player-view" data-panplay-view-panel="player"<?= hiddenView('player', $view) ?>>
            <div class="panplay-player-scroll"><div class="panplay-player-box">
                <button class="panplay-current-show" type="button" data-panplay-current-show hidden></button>
                <div class="panplay-now-playing__art" data-panplay-art><img data-panplay-cover alt=""<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>><span data-panplay-cover-fallback<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span></div>
                <div class="panplay-now-playing__copy"><h1 data-panplay-title><?= h($mode === 'Baseaudio' ? $baseTitle : $sourceName) ?></h1><p data-panplay-artist><?= h($mode === 'Baseaudio' ? ($baseArtist ?: 'Baseaudio') : ($streamUrl === '' ? 'Öffne PanPlay mit einer Audioquelle.' : 'Audioquelle wird vorbereitet.')) ?></p><span class="panplay-visually-hidden" data-panplay-playback-status aria-live="polite">Bereit</span></div>
                <div class="panplay-rich-grid" data-panplay-rich-grid hidden><article class="pwf-info-card panplay-rich-card" data-panplay-station-summary-card hidden><div><h2>Über den Sender</h2><p data-panplay-station-summary></p></div></article><article class="pwf-info-card panplay-rich-card" data-panplay-rich-card hidden><div><h2>Vom Sender</h2><div class="pwf-markdown" data-panplay-rich-content></div></div></article></div>
            </div></div>
        </section>

        <?php if (isset($primaryViews['history'])): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="history"<?= hiddenView('history', $view) ?>><div class="pwf-section-heading"><h1>Titelhistorie</h1></div><div class="panplay-data-list" data-panplay-history><div class="pwf-empty-state"><h2>Noch keine Daten</h2><p>Die Titelhistorie wird geladen.</p></div></div></section><?php endif; ?>
        <?php if (isset($primaryViews['schedule'])): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="schedule"<?= hiddenView('schedule', $view) ?>><div class="pwf-section-heading"><h1>Sendeplan</h1></div><div class="panplay-schedule" data-panplay-schedule><div class="pwf-empty-state"><h2>Noch keine Daten</h2><p>Der Wochenplan wird geladen.</p></div></div></section><?php endif; ?>
        <?php if (isset($primaryViews['station'])): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="station"<?= hiddenView('station', $view) ?>><div class="pwf-section-heading"><h1 data-panplay-station-heading>Senderinformation</h1></div><div class="panplay-station-profile"><aside><img data-panplay-station-image alt="" hidden><div class="panplay-social-links" data-panplay-station-socials></div></aside><div class="panplay-station-copy"><h2 data-panplay-station-slogan hidden></h2><p data-panplay-station-description></p><div class="panplay-station-meta" data-panplay-station-meta></div><div class="panplay-station-groups"><section data-panplay-station-group="djs" hidden><h3>DJs</h3><div class="panplay-tag-list" data-panplay-station-djs></div></section><section data-panplay-station-group="location" hidden><h3>Standort</h3><div class="panplay-tag-list" data-panplay-station-location></div></section><section data-panplay-station-group="genres" hidden><h3>Genres</h3><div class="panplay-tag-list" data-panplay-station-genres></div></section><section data-panplay-station-group="artists" hidden><h3>Häufig gespielte Artists</h3><div class="panplay-tag-list" data-panplay-station-artists></div></section></div></div></div></section><?php endif; ?>

        <?php if ($mode === 'Baseaudio'): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="fileinfo"<?= hiddenView('fileinfo', $view) ?>><div class="pwf-section-heading"><h1>Über Audioquelle</h1></div><div class="panplay-file-profile"><div class="panplay-file-art"><img alt="Cover von <?= h($baseTitle) ?>"<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>><span<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span></div><dl class="panplay-facts"><?php metadataRow('Titel', $baseaudioMetadata, 'title'); metadataRow('Interpret', $baseaudioMetadata, 'artist'); metadataRow('Album', $baseaudioMetadata, 'album'); metadataRow('Genre', $baseaudioMetadata, 'genre'); metadataRow('Jahr', $baseaudioMetadata, 'year'); metadataRow('Dauer', $baseaudioMetadata, 'duration_label'); metadataRow('Format', $baseaudioMetadata, 'format'); metadataRow('Codec', $baseaudioMetadata, 'codec'); metadataRow('Bitrate', $baseaudioMetadata, 'bitrate_kbps', ' kbit/s'); metadataRow('Abtastrate', $baseaudioMetadata, 'sample_rate_hz', ' Hz'); metadataRow('Kanäle', $baseaudioMetadata, 'channels'); metadataRow('Dateigröße', $baseaudioMetadata, 'filesize_bytes', ' Bytes'); ?><div><dt>Quelle</dt><dd><a href="<?= h($streamUrl) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) parse_url($streamUrl, PHP_URL_HOST)) ?></a></dd></div></dl></div></section><?php endif; ?>

        <?php if ($showNowPlaying): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="nowplaying"<?= hiddenView('nowplaying', $view) ?>><div class="pwf-section-heading"><h1>Aktueller Titel</h1></div><div class="panplay-current-detail"><div class="panplay-file-art"><img data-panplay-current-art alt="" hidden><span data-panplay-current-art-fallback aria-hidden="true">♪</span></div><div><h2 data-panplay-current-title><?= h($mode === 'Baseaudio' ? $baseTitle : $sourceName) ?></h2><p class="panplay-current-artist" data-panplay-current-artist><?= h($baseArtist ?: $mode) ?></p><dl class="panplay-facts" data-panplay-current-facts></dl><div class="panplay-link-row"><a class="pwf-button" data-panplay-current-lastfm target="_blank" rel="noopener noreferrer" hidden>Auf Last.fm suchen</a></div></div></div></section><?php endif; ?>

        <section class="panplay-view pwf-content-section" data-panplay-view-panel="share"<?= hiddenView('share', $view) ?>><div class="pwf-section-heading"><h1>Teilen</h1></div><div class="panplay-share-grid"><section class="pwf-panel"><h2>Diesen Player teilen</h2><p>Teile diese PanPlay-Seite mit der ausgewählten Audioquelle.</p><div class="panplay-share-actions" data-panplay-share-actions="page"></div></section><section class="pwf-panel" data-panplay-track-share><h2>Aktuellen Titel teilen</h2><p data-panplay-share-track-label><?= h($mode === 'Baseaudio' ? trim($baseArtist . ' - ' . $baseTitle, ' -') : 'Titelinformationen werden geladen.') ?></p><div class="panplay-share-actions" data-panplay-share-actions="track"></div></section></div></section>

        <?php if ($showPlayWith): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="playwith"<?= hiddenView('playwith', $view) ?>><div class="pwf-section-heading"><h1>Player wechseln</h1></div><p>Öffne diese Audioquelle in einem anderen Dienst oder Abspielprogramm.</p><div class="panplay-service-grid" data-panplay-service-links><a class="pwf-button" href="<?= h($streamUrl) ?>" target="_blank" rel="noopener noreferrer">Direkte Stream-URL</a></div></section><?php endif; ?>

        <section class="panplay-view pwf-content-section" data-panplay-view-panel="settings"<?= hiddenView('settings', $view) ?>><div class="pwf-section-heading"><h1>Einstellungen</h1></div><form class="panplay-settings-panel" data-panplay-settings-form>
            <fieldset class="pwf-panel panplay-settings-group"><legend>Sprache und Theme</legend><label class="pwf-field"><span class="pwf-label">Sprache</span><select class="pwf-select" name="hl"><?php foreach ($languages as $id => $name): ?><option value="<?= h($id) ?>"<?= $id === $selectedLanguage ? ' selected' : '' ?>><?= h($name) ?></option><?php endforeach; ?></select></label><label class="pwf-field"><span class="pwf-label">Theme</span><select class="pwf-select" name="theme" data-panplay-theme-select><?php foreach ($themes as $id => $name): ?><option value="<?= h($id) ?>"<?= $id === $theme ? ' selected' : '' ?>><?= h($name) ?></option><?php endforeach; ?></select></label></fieldset>
            <?php if ($mode === 'laut.fm'): ?><fieldset class="pwf-panel panplay-settings-group"><legend>laut.fm</legend><label class="pwf-check"><input type="checkbox" name="nolfmw" value="y" data-panplay-disable-all<?= $hideLautWindows ? ' checked' : '' ?>><span>Alle zusätzlichen laut.fm-Bereiche ausblenden</span></label><?php foreach (['schedule' => 'Sendeplan', 'stationinfo' => 'Senderinfo', 'playwith' => 'Player wechseln', 'trackhistory' => 'Titelhistorie', 'currentsongmodal' => 'Aktueller Titel'] as $param => $label): ?><label class="pwf-check"><input type="checkbox" name="<?= h($param) ?>" value="y" data-panplay-feature-setting<?= panplayFlagEnabled($param) ? ' checked' : '' ?>><span><?= h($label) ?> anzeigen</span></label><?php endforeach; ?><label class="pwf-check"><input type="checkbox" name="lbn" value="y"<?= isset($_GET['lbn']) && $_GET['lbn'] === 'y' ? ' checked' : '' ?>><span>Live-Status zusätzlich aus dem Sendungsnamen ableiten</span></label><label class="pwf-check"><input type="checkbox" name="stationaccent" value="n" data-panplay-checked-value="n" data-panplay-unchecked-value="y"<?= isset($_GET['stationaccent']) && $_GET['stationaccent'] === 'n' ? ' checked' : '' ?>><span>Automatische Akzentfarbe aus dem Senderlogo ausschalten</span></label></fieldset><?php elseif ($mode === 'Baseaudio'): ?><fieldset class="pwf-panel panplay-settings-group"><legend>Audioquelle</legend><label class="pwf-field"><span class="pwf-label">Direkte Audio-URL</span><input class="pwf-input" type="url" name="webstream" value="<?= h($streamUrl) ?>"></label></fieldset><div class="pwf-status pwf-status--info"><strong>CPM:</strong> <?= !empty($cfg_panplay_cpm) ? 'aktiv' : 'inaktiv' ?><?= !empty($cfg_panplay_cpm_by_cdn) ? ', zentrale Liste aktiv' : '' ?>. Diese Einstellung wird vom Serverbetreiber verwaltet.</div><?php endif; ?><div class="panplay-settings-actions"><button class="pwf-button pwf-button--primary" type="submit">Anwenden</button></div>
        </form></section>

        <section class="panplay-view pwf-content-section panplay-about-view" data-panplay-view-panel="about"<?= hiddenView('about', $view) ?>><div class="panplay-about-brand"><div class="panplay-logo">♪ Pan<span>Play</span></div><p>Der HTML5-Audioplayer</p></div><?php if (!empty($is_prerelase)): ?><div class="pwf-status pwf-status--warning panplay-about-warning"><strong>Instabile Vorabversion:</strong> Dieser Build dient der Entwicklung und ist nicht für den produktiven Einsatz bestimmt.</div><?php endif; ?><dl class="panplay-facts"><div><dt>Version</dt><dd><?= h((string) $pro_version) ?> <?= h((string) $pro_version_name) ?> · <?= PANPLAY_CHANNEL ?> [Build <?= h((string) $pro_buildversion) ?>]</dd></div><div><dt>Stand</dt><dd><?= h((string) $pro_releasedate) ?></dd></div><div><dt>Lizenziert an</dt><dd><a href="<?= h((string) $pro_eula_vendor_link) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) $pro_eula_vendor) ?></a><small><?= h((string) ($_SERVER['HTTP_HOST'] ?? 'localhost')) ?></small></dd></div><div><dt>Lizenz</dt><dd><a href="<?= h((string) $pro_license_url) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) $pro_license) ?></a></dd></div><div><dt>Erweiterung</dt><dd><?= h($mode === 'laut.fm' ? 'laut.fm' : ($mode === 'Baseaudio' ? 'Baseaudio' : 'Keine')) ?></dd></div><div><dt>Pangom Web Framework</dt><dd><?= PWF_VERSION_USED ?> · Commit <?= PWF_COMMIT_USED ?></dd></div></dl><nav class="panplay-about-links" aria-label="Dokumentation und Rechtliches"><a href="https://play.pangom.net/documentation/?ver=<?= h((string) $pro_version) ?>" target="_blank" rel="noopener noreferrer">Dokumentation</a><a href="<?= h((string) $privacy_url) ?>" target="_blank" rel="noopener noreferrer">Datenschutz</a><a href="<?= h((string) $impress_url) ?>" target="_blank" rel="noopener noreferrer">Impressum</a><a href="<?= h((string) $pro_eula_link) ?>" target="_blank" rel="noopener noreferrer">Nutzungsbedingungen</a></nav></section>
    </div></div>
</main>

<div class="pwf-app__framework-divider panplay-live-strip" data-panplay-live-strip hidden><span><strong>LIVE</strong><span data-panplay-live-label></span></span></div>
<footer class="pwf-app__footer panplay-transport"><div class="pwf-app__footer-inner">
    <button class="panplay-transport__meta" type="button" data-panplay-open-current<?= !$showNowPlaying ? ' disabled' : '' ?>><span class="panplay-transport__art"><img data-panplay-transport-art alt=""<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>><span data-panplay-transport-art-fallback<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span></span><span><strong data-panplay-transport-title><?= h($mode === 'Baseaudio' ? $baseTitle : $sourceName) ?></strong><small data-panplay-transport-artist><?= h($mode === 'Baseaudio' ? ($baseArtist ?: 'Baseaudio') : $mode) ?></small></span></button>
    <div class="panplay-transport__controls"><button class="panplay-transport__button" type="button" data-panplay-play aria-label="Wiedergabe starten"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-play viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-pause viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M7 5h4v14H7zm6 0h4v14h-4z" fill="currentColor" stroke="none"/></svg></button><button class="panplay-transport__button" type="button" data-panplay-cast aria-label="Auf Google Cast-Gerät wiedergeben" title="Google Cast" hidden><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 18v3h3a3 3 0 0 0-3-3Zm0-4v2a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7Zm0-4v2a9 9 0 0 1 9 9h2A11 11 0 0 0 2 10Zm3-7a3 3 0 0 0-3 3v2h2V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-4v2h4a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Z" fill="currentColor" stroke="none"/></svg></button></div>
    <div class="panplay-transport__volume"><button class="panplay-transport__volume-button" type="button" data-panplay-mute aria-label="Stummschalten"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-volume viewBox="0 0 24 24" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4Zm11.5.1v5.8a4 4 0 0 0 0-5.8Zm0-3.3v2.1a6 6 0 0 1 0 8.2v2.1a8 8 0 0 0 0-12.4Z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-muted viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M4 9v6h4l5 4V5L8 9H4Zm12.2 1.4L18.6 8 20 9.4 17.6 12l2.4 2.6-1.4 1.4-2.4-2.4-2.4 2.4-1.4-1.4 2.4-2.6-2.4-2.6L13.8 8Z" fill="currentColor" stroke="none"/></svg></button><label class="panplay-visually-hidden" for="panplay-volume">Lautstärke</label><input id="panplay-volume" class="pwf-range" type="range" min="0" max="1" step="0.05" value="0.5" data-panplay-volume<?= $streamUrl === '' ? ' disabled' : '' ?>></div>
    <audio id="panplay-audio" preload="none"<?= $streamUrl !== '' ? ' src="' . h($streamUrl) . '"' : '' ?>></audio>
</div></footer>
<script id="panplay-bootstrap" type="application/json"><?= $clientConfigJson ?: '{}' ?></script>
<?php if ($streamUrl !== ''): ?><script src="engine/castlibloader.php" defer></script><?php endif; ?>
<script type="module" src="rscs/javascript/panplay-alpha.js?v=<?= PANPLAY_ASSET_VERSION ?>"></script>
</body></html>
