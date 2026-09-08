<?php
declare(strict_types=1);

require_once __DIR__ . '/engine/runtime-bootstrap.php';
require_once __DIR__ . '/engine/extensions/pwf-slot-loader.php';

const PANPLAY_ASSET_VERSION = '1050.7';
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
$languages = [
    'en' => 'English', 'en-us' => 'English (US)', 'en-uk' => 'English (UK)',
    'de' => 'Deutsch', 'de-at' => 'Deutsch (Österreich)', 'de-ch' => 'Deutsch (Schweiz)',
    'fr' => 'Français', 'it' => 'Italiano', 'da' => 'Dansk', 'es' => 'Español',
    'es-mx' => 'Español (México)', 'es-la' => 'Español (Latinoamérica)',
    'es-ar' => 'Español (Argentina)', 'nl' => 'Nederlands', 'nl-be' => 'Nederlands (België)',
    'zh-hans' => '简体中文', 'zh' => '中文', 'hi' => 'हिन्दी',
];

// Same fallback-closure convention already used in engine/runtime-bootstrap.php's
// bluescreen() and engine/extensions/baseaudio/cpm.php: read a key if translated,
// otherwise keep today's German prototype text until that key is filled in for
// every language. This is what lets this rollout happen "Stück für Stück" —
// languages without the new keys yet fall back safely instead of showing nothing.
$t = static function (string $key, string $fallback) use ($lang) {
    return isset($lang[$key]) ? $lang[$key] : $fallback;
};

$requestedTheme = isset($_GET['theme']) ? strtolower(trim((string) $_GET['theme'])) : 'panplay-default';
$theme = isset($themes[$requestedTheme]) ? $requestedTheme : ($themeAliases[$requestedTheme] ?? 'panplay-default');
$mode = 'none';
$station = '';
$sourceName = $t('shell_no_source', 'Keine Audioquelle ausgewählt');
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

// --- Language: core $lang comes from engine/lang_loader.php (already loaded by
// engine/runtime-bootstrap.php at the top of this file). Every extension keeps
// its own language files (PanPlay's established decentralized i18n model, see
// engine/extensions/laut/extension.init.php for how the legacy interface does
// this) — so the PWF shell loads the active extension's own $ext_lang here too,
// instead of duplicating extension-specific strings into the core files.
$ext_lang = [];
$extLangFolder = panplayExtensionFolder($mode);
if ($extLangFolder !== null) {
    $extLangCandidate = __DIR__ . '/engine/extensions/' . $extLangFolder . '/lang/' . $language . '.php';
    if (!is_file($extLangCandidate)) {
        $extLangCandidate = __DIR__ . '/engine/extensions/' . $extLangFolder . '/lang/de.php';
    }
    if (is_file($extLangCandidate)) {
        require $extLangCandidate;
    }
}
$et = static function (string $key, string $fallback) use ($ext_lang) {
    return isset($ext_lang[$key]) ? $ext_lang[$key] : $fallback;
};
if ($mode === 'laut.fm' && $station !== '') {
    $sourceName = $station . ' ' . $et('station_source_suffix', 'auf laut.fm');
}
$allViewLabels = [
    'player' => 'Player',
    'history' => $et('trackhistory_navbar_title', 'Titelhistorie'),
    'schedule' => trim($et('sendeplan_navbar_title', 'Sendeplan')),
    'station' => $et('stationinfo_tab_title', 'Senderinfo'),
    'fileinfo' => trim($et('stationinfo_navbar_title', 'Über Audioquelle')),
    'share' => $t('share_heading', 'Teilen'),
    'nowplaying' => $t('settingspanel_laut_currentsongmodal', 'Aktueller Titel'),
    'playwith' => $et('playwith_navbar_title', 'Player wechseln'),
    'settings' => $t('settingspanel_modal_title', 'Einstellungen'),
    'about' => $t('about', 'Über'),
];

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
$primaryViews = ['player' => $allViewLabels['player']];
$extensionViews = panplayLoadPwfSlot($mode, 'navigation', compact('allViewLabels', 'hideLautWindows'), []);
if (is_array($extensionViews)) {
    foreach ($extensionViews as $id => $label) {
        if (is_string($id) && is_string($label)) {
            $primaryViews[$id] = $label;
        }
    }
}
$primaryViews['share'] = $allViewLabels['share'];
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
// Strings panplay-alpha.js needs at runtime (playback status, share panel, current-
// song facts). JS has no direct access to $lang/$ext_lang, so these are handed
// through the same bootstrap JSON the "labels" key already uses for view names.
$clientI18n = [
    'playingStatus' => $t('playback_playing_status', 'Wiedergabe läuft'),
    'pausedStatus' => $t('playback_paused_status', 'Pausiert'),
    'connectingStatus' => $t('playback_connecting_status', 'Verbindung wird aufgebaut'),
    'errorStatus' => $t('playback_error_status', 'Audioquelle nicht erreichbar'),
    'startFailedStatus' => $t('playback_start_failed_status', 'Wiedergabe konnte nicht gestartet werden'),
    'shareNativeButton' => $t('share_native_button', 'Teilen'),
    'sharePageIntentText' => $t('share_page_intent_text', 'Diesen Player mit PanPlay öffnen.'),
    'shareTrackIntentPrefix' => $t('share_track_intent_prefix', 'Ich höre gerade'),
    'shareTrackIntentSuffix' => $t('share_track_intent_suffix', 'mit PanPlay.'),
    'lastfmSearchLinkLabel' => $et('current_song_lastfm_link', 'Auf Last.fm suchen'),
    'factAlbumLabel' => $t('fact_album_label', 'Album'),
    'factGenreLabel' => $t('fact_genre_label', 'Genre'),
    'factDurationLabel' => $t('fact_duration_label', 'Dauer'),
    'factYearLabel' => $t('fact_year_label', 'Jahr'),
    'factFormatLabel' => $t('fact_format_label', 'Format'),
    'factCodecLabel' => $t('fact_codec_label', 'Codec'),
    'factStartedLabel' => $t('fact_started_label', 'Gestartet'),
    'factEndsLabel' => $t('fact_ends_label', 'Endet'),
    'pauseActionLabel' => $t('pause_action_label', 'Wiedergabe pausieren'),
    'playActionLabel' => $t('play_action_label', 'Wiedergabe starten'),
    'unmuteActionLabel' => $t('unmute_action_label', 'Ton einschalten'),
    'muteActionLabel' => $t('mute_action_label', 'Stummschalten'),
    'stationDescriptionFallback' => $et('station_description_fallback', 'Für diesen Sender ist keine Beschreibung hinterlegt.'),
    'stationDataUnavailableStatus' => $et('station_data_unavailable_status', 'Senderdaten derzeit nicht erreichbar'),
    'stationFormatPrefix' => $et('station_format_prefix', 'Format'),
    'stationListenersSuffix' => $et('station_listeners_suffix', 'Hörer'),
    'stationRankPrefix' => $et('station_rank_prefix', 'Rang'),
    'artworkAltPrefix' => $t('artwork_alt_prefix', 'Bild zu'),
];
$extensionModule = panplayLoadPwfSlot($mode, 'client', [], '');
$clientConfig = [
    'labels' => $allViewLabels,
    'i18n' => $clientI18n,
    'mode' => $mode,
    'station' => $station,
    'streamUrl' => $streamUrl,
    'sourceName' => $sourceName,
    'baseaudio' => $baseaudioMetadata,
    'extensionModule' => is_string($extensionModule) ? $extensionModule : '',
];
$clientConfigJson = json_encode($clientConfig, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<!doctype html>
<html lang="<?= h((string) $language) ?>" data-pwf-theme="<?= h($theme) ?>" data-pwf-color-scheme="dark" data-pwf-contrast="standard" data-pwf-motion="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>PanPlay <?= h((string) $pro_version) ?> <?= h((string) $pro_version_name) ?></title>
    <link rel="icon" type="image/png" href="rscs/favicons/favicon.png">
    <link rel="stylesheet" href="rscs/pwf/pwf.css">
    <link id="panplay-theme-stylesheet" rel="stylesheet" href="rscs/pwf/themes/<?= h($theme) ?>.css">
    <link rel="stylesheet" href="rscs/css/pangom.css">
    <link rel="stylesheet" href="rscs/css/panplay-alpha.css?v=<?= PANPLAY_ASSET_VERSION ?>">
</head>
<body class="pwf-app" data-pwf-accent="teal" data-pwf-layout-mode="wide" data-panplay-view="<?= h($view) ?>" data-panplay-mode="<?= h($mode) ?>" data-panplay-station="<?= h($station) ?>" data-panplay-source="<?= h($sourceName) ?>" data-panplay-stream="<?= h($streamUrl) ?>">
<a class="pwf-skip-link" href="#main"><?= h($t('shell_skip_to_content', 'Zum Inhalt springen')) ?></a>
<header class="pwf-app__header"><div class="pwf-app__header-inner">
    <div class="pwf-app__header-primary">
        <?php panplayLoadPwfSlot($mode, 'brand', compact('station')); ?>
        <nav class="pwf-app__tabs" aria-label="<?= h($t('shell_areas_label', 'PanPlay Bereiche')) ?>">
            <?php foreach ($primaryViews as $id => $label): ?><a class="pwf-app__tab" href="<?= h(panplayUrl($id)) ?>" data-panplay-route="<?= h($id) ?>"<?= selectedView($id, $view) ?>><?= h($label) ?></a><?php endforeach; ?>
        </nav>
        <details class="pwf-app__mobile-pages"><summary><span class="pwf-app__mobile-current" data-panplay-mobile-label><?= h($view === 'player' ? ($mode === 'laut.fm' ? $station : ($mode === 'Baseaudio' ? $baseTitle : $allViewLabels['player'])) : $allViewLabels[$view]) ?></span><span class="pwf-app__mobile-disclosure" aria-hidden="true"></span></summary><nav class="pwf-app__mobile-menu" aria-label="<?= h($t('shell_areas_mobile_label', 'PanPlay Bereiche mobil')) ?>">
            <?php foreach ($primaryViews as $id => $label): ?><a href="<?= h(panplayUrl($id)) ?>" data-panplay-route="<?= h($id) ?>"><?= h($label) ?></a><?php endforeach; ?>
            <hr class="panplay-mobile-menu-divider">
            <?php if ($showPlayWith): ?><a href="<?= h(panplayUrl('playwith')) ?>" data-panplay-route="playwith"><?= h($allViewLabels['playwith']) ?></a><?php endif; ?>
            <a href="<?= h(panplayUrl('settings')) ?>" data-panplay-route="settings"><?= h($allViewLabels['settings']) ?></a>
            <a href="<?= h(panplayUrl('about')) ?>" data-panplay-route="about"><?= h($t('about', 'Über') . ' PanPlay') ?></a>
        </nav></details>
    </div>
    <nav class="pwf-app__actions" aria-label="<?= h($t('shell_tools_label', 'Werkzeuge')) ?>">
        <?php if ($showPlayWith): ?><a class="pwf-app__action" href="<?= h(panplayUrl('playwith')) ?>" data-panplay-route="playwith" title="<?= h($allViewLabels['playwith']) ?>" aria-label="<?= h($allViewLabels['playwith']) ?>"><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h10v2H4v12h10v2H2V4h2Zm12 4 6 4-6 4v-3h-6v-2h6V8Z" fill="currentColor" stroke="none"/></svg></a><?php endif; ?>
        <a class="pwf-app__action" href="<?= h(panplayUrl('settings')) ?>" data-panplay-route="settings" title="<?= h($allViewLabels['settings']) ?>" aria-label="<?= h($allViewLabels['settings']) ?>"><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m9.8 2 .5 2.2c.5.2 1 .4 1.4.8l2-1 2.3 2.3-1 2c.3.4.6.9.7 1.4l2.3.5v3.2l-2.3.5c-.1.5-.4 1-.7 1.4l1 2-2.3 2.3-2-1c-.4.3-.9.6-1.4.7L9.8 22H6.6l-.5-2.3a7 7 0 0 1-1.4-.7l-2 1-2.3-2.3 1-2a7 7 0 0 1-.7-1.4L-1.6 13.8v-3.2l2.3-.5c.1-.5.4-1 .7-1.4l-1-2 2.3-2.3 2 1c.4-.3.9-.6 1.4-.7L6.6 2h3.2ZM8.2 8.4a3.8 3.8 0 1 0 0 7.6 3.8 3.8 0 0 0 0-7.6Z" transform="translate(4 -0.2) scale(.92)" fill="currentColor" stroke="none"/></svg></a>
        <a class="pwf-app__action panplay-about-action" href="<?= h(panplayUrl('about')) ?>" data-panplay-route="about" title="<?= h($t('about', 'Über') . ' PanPlay') ?>" aria-label="<?= h($t('about', 'Über') . ' PanPlay') ?>"><span aria-hidden="true">♪ Pan<span>Play</span></span></a>
    </nav>
</div></header>

<main class="pwf-app__main" id="main">
    <div class="panplay-stage-background" data-panplay-background aria-hidden="true"></div>
    <div class="pwf-app__stage"><div class="pwf-app__content">
        <section class="panplay-view panplay-player-view" data-panplay-view-panel="player"<?= hiddenView('player', $view) ?>>
            <div class="panplay-player-scroll"><div class="panplay-player-box">
                <?php panplayLoadPwfSlot($mode, 'player-before'); ?>
                <div class="panplay-now-playing__art" data-panplay-art><img data-panplay-cover alt=""<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>><span data-panplay-cover-fallback<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span></div>
                <div class="panplay-now-playing__copy"><h1 data-panplay-title><?= h($mode === 'Baseaudio' ? $baseTitle : $sourceName) ?></h1><p data-panplay-artist><?= h($mode === 'Baseaudio' ? ($baseArtist ?: 'Baseaudio') : ($streamUrl === '' ? $t('shell_open_with_source', 'Öffne PanPlay mit einer Audioquelle.') : $t('shell_preparing_source', 'Audioquelle wird vorbereitet.'))) ?></p><span class="panplay-visually-hidden" data-panplay-playback-status aria-live="polite"><?= h($t('shell_ready_status', 'Bereit')) ?></span></div>
                <?php panplayLoadPwfSlot($mode, 'player-after', compact('et')); ?>
            </div></div>
        </section>

        <?php panplayLoadPwfSlot($mode, 'history', compact('primaryViews', 'view', 'allViewLabels', 'et')); ?>
        <?php panplayLoadPwfSlot($mode, 'schedule', compact('primaryViews', 'view', 'allViewLabels', 'et')); ?>
        <?php panplayLoadPwfSlot($mode, 'station', compact('primaryViews', 'view', 'et')); ?>

        <?php panplayLoadPwfSlot($mode, 'fileinfo', compact('view', 'allViewLabels', 'et', 'baseTitle', 'baseArtwork', 'baseaudioMetadata', 'streamUrl')); ?>

        <?php if ($showNowPlaying): ?><section class="panplay-view pwf-content-section panplay-current-view" data-panplay-view-panel="nowplaying"<?= hiddenView('nowplaying', $view) ?>><button class="panplay-current-view__close" type="button" data-panplay-close-current aria-label="<?= h($t('close', 'Schließen')) ?>"><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m7 10 5 5 5-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button><div class="pwf-section-heading"><h1><?= h($allViewLabels['nowplaying']) ?></h1></div><div class="panplay-current-detail"><div class="panplay-file-art"><img data-panplay-current-art alt="" hidden><span data-panplay-current-art-fallback aria-hidden="true">♪</span></div><div><h2 data-panplay-current-title><?= h($mode === 'Baseaudio' ? $baseTitle : $sourceName) ?></h2><p class="panplay-current-artist" data-panplay-current-artist><?= h($baseArtist ?: $mode) ?></p><dl class="panplay-facts" data-panplay-current-facts></dl><div class="panplay-link-row"><a class="pwf-button" data-panplay-current-lastfm target="_blank" rel="noopener noreferrer" hidden><?= h($et('current_song_lastfm_link', 'Auf Last.fm suchen')) ?></a></div></div></div></section><?php endif; ?>

        <section class="panplay-view pwf-content-section" data-panplay-view-panel="share"<?= hiddenView('share', $view) ?>><div class="pwf-section-heading"><h1><?= h($allViewLabels['share']) ?></h1></div><div class="panplay-share-grid"><section class="pwf-panel"><h2><?= h($t('share_page_heading', 'Diesen Player teilen')) ?></h2><p><?= h($t('share_page_desc', 'Teile diese PanPlay-Seite mit der ausgewählten Audioquelle.')) ?></p><div class="panplay-share-actions" data-panplay-share-actions="page"></div></section><section class="pwf-panel" data-panplay-track-share><h2><?= h($t('share_track_heading', 'Aktuellen Titel teilen')) ?></h2><p data-panplay-share-track-label><?= h($mode === 'Baseaudio' ? trim($baseArtist . ' - ' . $baseTitle, ' -') : $t('share_track_loading', 'Titelinformationen werden geladen.')) ?></p><div class="panplay-share-actions" data-panplay-share-actions="track"></div></section></div></section>

        <?php if ($showPlayWith): ?><section class="panplay-view pwf-content-section" data-panplay-view-panel="playwith"<?= hiddenView('playwith', $view) ?>><div class="pwf-section-heading"><h1><?= h($allViewLabels['playwith']) ?></h1></div><p><?= h($t('switch_player_desc', 'Öffne diese Audioquelle in einem anderen Dienst oder Abspielprogramm.')) ?></p><div class="panplay-service-grid" data-panplay-service-links><a class="pwf-button" href="<?= h($streamUrl) ?>" target="_blank" rel="noopener noreferrer"><?= h($t('direct_stream_url_label', 'Direkte Stream-URL')) ?></a></div></section><?php endif; ?>

        <section class="panplay-view pwf-content-section" data-panplay-view-panel="settings"<?= hiddenView('settings', $view) ?>><div class="pwf-section-heading"><h1><?= h($allViewLabels['settings']) ?></h1></div><form class="panplay-settings-panel" data-panplay-settings-form>
            <fieldset class="pwf-panel panplay-settings-group"><legend><?= h($t('settings_lang_theme_legend', 'Sprache und Theme')) ?></legend><label class="pwf-field"><span class="pwf-label"><?= h($t('settingspanel_lang_title', 'Sprache')) ?></span><select class="pwf-select" name="hl"><?php foreach ($languages as $id => $name): ?><option value="<?= h($id) ?>"<?= $id === $selectedLanguage ? ' selected' : '' ?>><?= h($name) ?></option><?php endforeach; ?></select></label><label class="pwf-field"><span class="pwf-label"><?= h($t('settingspanel_theme_title', 'Theme')) ?></span><select class="pwf-select" name="theme" data-panplay-theme-select><?php foreach ($themes as $id => $name): ?><option value="<?= h($id) ?>"<?= $id === $theme ? ' selected' : '' ?>><?= h($name) ?></option><?php endforeach; ?></select></label></fieldset>
            <?php panplayLoadPwfSlot($mode, 'settings', compact('t', 'et', 'streamUrl', 'allViewLabels', 'hideLautWindows', 'cfg_panplay_cpm', 'cfg_panplay_cpm_by_cdn')); ?>
            <div class="panplay-settings-actions"><button class="pwf-button pwf-button--primary" type="submit"><?= h($t('apply', 'Anwenden')) ?></button></div>
        </form></section>

        <section class="panplay-view pwf-content-section panplay-about-view" data-panplay-view-panel="about"<?= hiddenView('about', $view) ?>><div class="panplay-about-brand"><div class="panplay-logo">♪ Pan<span>Play</span></div><p><?= h($t('shell_tagline', 'Der HTML5-Audioplayer')) ?></p></div><?php if (!empty($is_prerelase)): ?><div class="pwf-status pwf-status--warning panplay-about-warning"><strong><?= h($t('about_prerelease_warning_title', 'Instabile Vorabversion')) ?>:</strong> <?= h($t('about_warning_desc', 'Dieser Build dient der Entwicklung und ist nicht für den produktiven Einsatz bestimmt.')) ?></div><?php endif; ?><dl class="panplay-facts"><div><dt><?= h($t('about_version_label', 'Version')) ?></dt><dd><?= h((string) $pro_version) ?> <?= h((string) $pro_version_name) ?> · <?= PANPLAY_CHANNEL ?> [Build <?= h((string) $pro_buildversion) ?>]</dd></div><div><dt><?= h($t('about_stand_label', 'Stand')) ?></dt><dd><?= h((string) $pro_releasedate) ?></dd></div><div><dt><?= h($t('about_license_owner_is', 'Lizenziert an')) ?></dt><dd><a href="<?= h((string) $pro_eula_vendor_link) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) $pro_eula_vendor) ?></a><small><?= h((string) ($_SERVER['HTTP_HOST'] ?? 'localhost')) ?></small></dd></div><div><dt><?= h($t('about_license_label', 'Lizenz')) ?></dt><dd><a href="<?= h((string) $pro_license_url) ?>" target="_blank" rel="noopener noreferrer"><?= h((string) $pro_license) ?></a></dd></div><div><dt><?= h($t('about_extension_label', 'Erweiterung')) ?></dt><dd><?= h($mode === 'laut.fm' ? 'laut.fm' : ($mode === 'Baseaudio' ? 'Baseaudio' : $t('about_extension_none', 'Keine'))) ?></dd></div><div><dt>Pangom Web Framework</dt><dd><?= PWF_VERSION_USED ?> · Commit <?= PWF_COMMIT_USED ?></dd></div></dl><nav class="panplay-about-links" aria-label="<?= h($t('about_legal_nav_label', 'Dokumentation und Rechtliches')) ?>"><a href="https://play.pangom.net/documentation/?ver=<?= h((string) $pro_version) ?>" target="_blank" rel="noopener noreferrer"><?= h($t('about_documentation_p2', 'Dokumentation')) ?></a><a href="<?= h((string) $privacy_url) ?>" target="_blank" rel="noopener noreferrer"><?= h($t('about_legal_p2', 'Datenschutz')) ?></a><a href="<?= h((string) $impress_url) ?>" target="_blank" rel="noopener noreferrer"><?= h($t('about_legal_p4', 'Impressum')) ?></a><a href="<?= h((string) $pro_eula_link) ?>" target="_blank" rel="noopener noreferrer"><?= h($t('about_legal_p6', 'Nutzungsbedingungen')) ?></a></nav></section>
    </div></div>
</main>

<?php panplayLoadPwfSlot($mode, 'live-strip'); ?>
<footer class="pwf-app__footer panplay-transport"><div class="pwf-app__footer-inner">
    <button class="panplay-transport__meta" type="button" data-panplay-open-current<?= !$showNowPlaying ? ' disabled' : '' ?>><span class="panplay-transport__art"><img data-panplay-transport-art alt=""<?= $baseArtwork === '' ? ' hidden' : ' src="' . h($baseArtwork) . '"' ?>><span data-panplay-transport-art-fallback<?= $baseArtwork !== '' ? ' hidden' : '' ?> aria-hidden="true">♪</span></span><span><strong data-panplay-transport-title><?= h($mode === 'Baseaudio' ? $baseTitle : ($station ?: $sourceName)) ?></strong><small data-panplay-transport-artist><?= h($mode === 'Baseaudio' ? ($baseArtist ?: 'Baseaudio') : 'laut.fm') ?></small></span></button>
    <div class="panplay-transport__desktop-controls">
        <div class="panplay-transport__controls"><button class="panplay-transport__button" type="button" data-panplay-play aria-label="<?= h($t('play_action_label', 'Wiedergabe starten')) ?>"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-play viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-pause viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M7 5h4v14H7zm6 0h4v14h-4z" fill="currentColor" stroke="none"/></svg></button><button class="panplay-transport__button" type="button" data-panplay-cast aria-label="<?= h($t('cast_action_label', 'Auf Google Cast-Gerät wiedergeben')) ?>" title="Google Cast" hidden><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 18v3h3a3 3 0 0 0-3-3Zm0-4v2a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7Zm0-4v2a9 9 0 0 1 9 9h2A11 11 0 0 0 2 10Zm3-7a3 3 0 0 0-3 3v2h2V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-4v2h4a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Z" fill="currentColor" stroke="none"/></svg></button></div>
        <div class="panplay-transport__volume"><button class="panplay-transport__volume-button" type="button" data-panplay-mute aria-label="<?= h($t('mute_action_label', 'Stummschalten')) ?>"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-volume viewBox="0 0 24 24" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4Zm11.5.1v5.8a4 4 0 0 0 0-5.8Zm0-3.3v2.1a6 6 0 0 1 0 8.2v2.1a8 8 0 0 0 0-12.4Z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-muted viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M4 9v6h4l5 4V5L8 9H4Zm12.2 1.4L18.6 8 20 9.4 17.6 12l2.4 2.6-1.4 1.4-2.4-2.4-2.4 2.4-1.4-1.4 2.4-2.6-2.4-2.6L13.8 8Z" fill="currentColor" stroke="none"/></svg></button><label class="panplay-visually-hidden" for="panplay-volume"><?= h($t('volume_label', 'Lautstärke')) ?></label><input id="panplay-volume" class="pwf-range" type="range" min="0" max="1" step="0.05" value="0.5" data-panplay-volume<?= $streamUrl === '' ? ' disabled' : '' ?>></div>
    </div>
    <div class="panplay-transport__mobile-controls">
        <button class="panplay-transport__button" type="button" data-panplay-play aria-label="<?= h($t('play_action_label', 'Wiedergabe starten')) ?>"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-play viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-pause viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M7 5h4v14H7zm6 0h4v14h-4z" fill="currentColor" stroke="none"/></svg></button>
        <button class="panplay-transport__button" type="button" data-panplay-cast aria-label="<?= h($t('cast_action_label', 'Auf Google Cast-Gerät wiedergeben')) ?>" title="Google Cast" hidden><svg class="pwf-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 18v3h3a3 3 0 0 0-3-3Zm0-4v2a5 5 0 0 1 5 5h2a7 7 0 0 0-7-7Zm0-4v2a9 9 0 0 1 9 9h2A11 11 0 0 0 2 10Zm3-7a3 3 0 0 0-3 3v2h2V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-4v2h4a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Z" fill="currentColor" stroke="none"/></svg></button>
        <div class="panplay-mobile-volume"><button class="panplay-transport__volume-button" type="button" data-panplay-mobile-volume-toggle aria-expanded="false" aria-controls="panplay-mobile-volume" aria-label="<?= h($t('volume_label', 'Lautstärke')) ?>"<?= $streamUrl === '' ? ' disabled' : '' ?>><svg class="pwf-icon" data-panplay-icon-volume viewBox="0 0 24 24" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4Zm11.5.1v5.8a4 4 0 0 0 0-5.8Zm0-3.3v2.1a6 6 0 0 1 0 8.2v2.1a8 8 0 0 0 0-12.4Z" fill="currentColor" stroke="none"/></svg><svg class="pwf-icon" data-panplay-icon-muted viewBox="0 0 24 24" aria-hidden="true" hidden><path d="M4 9v6h4l5 4V5L8 9H4Zm12.2 1.4L18.6 8 20 9.4 17.6 12l2.4 2.6-1.4 1.4-2.4-2.4-2.4 2.4-1.4-1.4 2.4-2.6-2.4-2.6L13.8 8Z" fill="currentColor" stroke="none"/></svg></button><div class="panplay-mobile-volume__panel" id="panplay-mobile-volume" hidden><label class="panplay-visually-hidden" for="panplay-mobile-volume-range"><?= h($t('volume_label', 'Lautstärke')) ?></label><input id="panplay-mobile-volume-range" class="pwf-range" type="range" min="0" max="1" step="0.05" value="0.5" data-panplay-volume<?= $streamUrl === '' ? ' disabled' : '' ?>></div></div>
    </div>
    <audio id="panplay-audio" preload="none"<?= $streamUrl !== '' ? ' src="' . h($streamUrl) . '"' : '' ?>></audio>
</div></footer>
<script id="panplay-bootstrap" type="application/json"><?= $clientConfigJson ?: '{}' ?></script>
<?php if ($streamUrl !== ''): ?><script src="src/assets/vendor/castjs/cast.min.js" defer></script><?php endif; ?>
<script type="module" src="rscs/javascript/panplay-entry.js?v=<?= PANPLAY_ASSET_VERSION ?>"></script>
</body></html>
