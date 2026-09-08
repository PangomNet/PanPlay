import { initPwf } from '../pwf/pwf.js';

initPwf();

const body = document.body;
const bootstrapNode = document.getElementById('panplay-bootstrap');
let config = {};
try { config = JSON.parse(bootstrapNode?.textContent || '{}'); } catch { config = {}; }
const labels = config.labels || {};
// Strings the server already resolved through $lang/$ext_lang for the active
// language — see index-alpha.php's $clientI18n. JS has no direct access to the
// PHP translation arrays, so this bootstrap object is the bridge.
const i18n = config.i18n || {};
const stationId = config.station || '';
const mode = config.mode || 'none';
const media = document.getElementById('panplay-audio');
const params = new URLSearchParams(window.location.search);
const mobileLayout = window.matchMedia('(max-width: 48rem)');
const mediaState = {
    station: null,
    song: null,
    history: [],
    currentPlaylistKey: null,
    currentPlaylistName: '',
    cast: null,
    richContentAttempted: false,
    lastMediaMetadataSignature: null,
};

function cleanTrackTitle(value, artist = '') {
    const title = String(value || '').trim();
    const performer = String(artist || '').trim();
    if (!title || !performer) return title;
    const lowerTitle = title.toLocaleLowerCase();
    const lowerArtist = performer.toLocaleLowerCase();
    for (const separator of [' - ', ' – ', ' — ', ': ']) {
        const prefix = lowerArtist + separator;
        if (lowerTitle.startsWith(prefix)) return title.slice(performer.length + separator.length).trim();
    }
    return title;
}

function mobileViewLabel(view = body.dataset.panplayView || 'player') {
    if (view !== 'player') return labels[view] || labels.player || 'Player';
    if (mode === 'laut.fm') return mediaState.station?.display_name || mediaState.station?.name || stationId || labels.player || 'Player';
    if (mode === 'Baseaudio') {
        const artist = mediaState.song?.artist?.name || '';
        return cleanTrackTitle(mediaState.song?.title || config.sourceName, artist) || labels.player || 'Player';
    }
    return labels.player || 'Player';
}

function updateMobileLabel(view = body.dataset.panplayView || 'player') {
    const mobileLabel = document.querySelector('[data-panplay-mobile-label]');
    if (mobileLabel) mobileLabel.textContent = mobileViewLabel(view);
}

function showView(requestedView, updateHistory = true) {
    const panel = document.querySelector(`[data-panplay-view-panel="${CSS.escape(requestedView || '')}"]`);
    const view = panel ? requestedView : 'player';
    document.querySelectorAll('[data-panplay-view-panel]').forEach((item) => { item.hidden = item.dataset.panplayViewPanel !== view; });
    document.querySelectorAll('[data-panplay-route]').forEach((link) => {
        if (link.dataset.panplayRoute === view) link.setAttribute('aria-current', 'page');
        else link.removeAttribute('aria-current');
    });
    body.dataset.panplayView = view;
    updateMobileLabel(view);
    document.title = `${labels[view] || 'PanPlay'} · ${mediaState.station?.display_name || 'PanPlay'}`;
    if (updateHistory) {
        const url = new URL(window.location.href);
        url.searchParams.set('view', view);
        window.history.pushState({ view }, '', url);
    }
    document.querySelector('.pwf-app__mobile-pages')?.removeAttribute('open');
    document.dispatchEvent(new CustomEvent('panplay:viewchange', { detail: { view } }));
}

document.querySelectorAll('[data-panplay-route]').forEach((link) => {
    link.addEventListener('click', (event) => {
        if (event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
        event.preventDefault();
        showView(link.dataset.panplayRoute);
    });
});
document.querySelector('[data-panplay-open-current]')?.addEventListener('click', () => {
    showView(mobileLayout.matches && body.dataset.panplayView === 'nowplaying' ? 'player' : 'nowplaying');
});
document.querySelector('[data-panplay-close-current]')?.addEventListener('click', () => showView('player'));
window.addEventListener('popstate', () => showView(new URL(window.location.href).searchParams.get('view') || 'player', false));

const themeSelect = document.querySelector('[data-panplay-theme-select]');
themeSelect?.addEventListener('change', () => {
    const theme = themeSelect.value;
    const stylesheet = document.getElementById('panplay-theme-stylesheet');
    if (stylesheet) stylesheet.href = `rscs/pwf/themes/${encodeURIComponent(theme)}.css`;
    document.documentElement.dataset.pwfTheme = theme;
    const url = new URL(window.location.href);
    url.searchParams.set('theme', theme);
    window.history.replaceState(window.history.state, '', url);
});

const settingsForm = document.querySelector('[data-panplay-settings-form]');
const disableAll = document.querySelector('[data-panplay-disable-all]');
const featureSettings = [...document.querySelectorAll('[data-panplay-feature-setting]')];
function syncSettingsState() {
    featureSettings.forEach((control) => { control.disabled = Boolean(disableAll?.checked); });
}
disableAll?.addEventListener('change', syncSettingsState);
syncSettingsState();
settingsForm?.addEventListener('submit', (event) => {
    event.preventDefault();
    const url = new URL(window.location.href);
    settingsForm.querySelectorAll('[name]').forEach((control) => {
        if (control instanceof HTMLInputElement && control.type === 'checkbox') {
            const checkedValue = control.dataset.panplayCheckedValue || 'y';
            const uncheckedValue = control.dataset.panplayUncheckedValue || 'n';
            url.searchParams.set(control.name, control.checked ? checkedValue : uncheckedValue);
        } else if (control.value) {
            url.searchParams.set(control.name, control.value);
        } else {
            url.searchParams.delete(control.name);
        }
    });
    url.searchParams.set('view', 'settings');
    window.location.assign(url);
});

function setText(selector, value) {
    const target = document.querySelector(selector);
    if (target && value != null && String(value).trim()) target.textContent = String(value).trim();
}

function setPlaybackStatus(text) {
    setText('[data-panplay-playback-status]', text);
}

function syncTransport() {
    if (!media) return;
    const paused = media.paused;
    const muted = media.muted || media.volume === 0;
    document.querySelectorAll('[data-panplay-icon-play]').forEach((icon) => icon.toggleAttribute('hidden', !paused));
    document.querySelectorAll('[data-panplay-icon-pause]').forEach((icon) => icon.toggleAttribute('hidden', paused));
    document.querySelectorAll('[data-panplay-icon-volume]').forEach((icon) => icon.toggleAttribute('hidden', muted));
    document.querySelectorAll('[data-panplay-icon-muted]').forEach((icon) => icon.toggleAttribute('hidden', !muted));
    document.querySelectorAll('[data-panplay-play]').forEach((button) => {
        button.setAttribute('aria-label', paused ? (i18n.playActionLabel || 'Wiedergabe starten') : (i18n.pauseActionLabel || 'Wiedergabe pausieren'));
    });
    document.querySelectorAll('[data-panplay-mute]').forEach((button) => {
        button.setAttribute('aria-label', muted ? (i18n.unmuteActionLabel || 'Ton einschalten') : (i18n.muteActionLabel || 'Stummschalten'));
        button.setAttribute('aria-pressed', String(muted));
    });
}

const volumeControls = [...document.querySelectorAll('[data-panplay-volume]')];
const mobileVolumeToggle = document.querySelector('[data-panplay-mobile-volume-toggle]');
const mobileVolumePanel = document.getElementById('panplay-mobile-volume');
function setMobileVolumeOpen(open) {
    if (!mobileVolumeToggle || !mobileVolumePanel) return;
    mobileVolumeToggle.setAttribute('aria-expanded', String(open));
    mobileVolumePanel.hidden = !open;
}
mobileVolumeToggle?.addEventListener('click', (event) => {
    event.stopPropagation();
    setMobileVolumeOpen(mobileVolumeToggle.getAttribute('aria-expanded') !== 'true');
});
mobileVolumePanel?.addEventListener('click', (event) => event.stopPropagation());
document.addEventListener('click', () => setMobileVolumeOpen(false));
if (typeof mobileLayout.addEventListener === 'function') mobileLayout.addEventListener('change', () => setMobileVolumeOpen(false));
else if (typeof mobileLayout.addListener === 'function') mobileLayout.addListener(() => setMobileVolumeOpen(false));

if (media) {
    if (volumeControls[0]) media.volume = Number(volumeControls[0].value);
    document.querySelectorAll('[data-panplay-play]').forEach((button) => {
        button.addEventListener('click', () => {
            if (media.paused) media.play().catch(() => setPlaybackStatus(i18n.startFailedStatus || 'Wiedergabe konnte nicht gestartet werden'));
            else media.pause();
        });
    });
    document.querySelectorAll('[data-panplay-mute]').forEach((button) => {
        button.addEventListener('click', () => { media.muted = !media.muted; syncTransport(); });
    });
    volumeControls.forEach((control) => control.addEventListener('input', () => {
        const value = Number(control.value);
        media.volume = value;
        media.muted = value === 0;
        volumeControls.forEach((other) => { if (other !== control) other.value = String(value); });
        syncTransport();
    }));
    media.addEventListener('volumechange', () => {
        volumeControls.forEach((control) => { control.value = String(media.volume); });
        syncTransport();
    });
    media.addEventListener('play', () => { setPlaybackStatus(i18n.playingStatus || 'Wiedergabe läuft'); syncTransport(); setMediaSessionPlaybackState('playing'); });
    media.addEventListener('pause', () => { setPlaybackStatus(i18n.pausedStatus || 'Pausiert'); syncTransport(); setMediaSessionPlaybackState('paused'); });
    media.addEventListener('waiting', () => { setPlaybackStatus(i18n.connectingStatus || 'Verbindung wird aufgebaut'); setMediaSessionPlaybackState('none'); });
    media.addEventListener('playing', () => { setPlaybackStatus(i18n.playingStatus || 'Wiedergabe läuft'); setMediaSessionPlaybackState('playing'); });
    media.addEventListener('error', () => setPlaybackStatus(i18n.errorStatus || 'Audioquelle nicht erreichbar'));
    syncTransport();
    if ('mediaSession' in navigator) {
        navigator.mediaSession.setActionHandler('play', () => media.play());
        navigator.mediaSession.setActionHandler('pause', () => media.pause());
    }
}

function setMediaSessionPlaybackState(state) {
    // Keeping navigator.mediaSession.playbackState in sync with the actual
    // <audio> element is what makes lock-screen/notification controls stay
    // reliable — without it, some platforms intermittently show a stale or
    // wrong play/pause state and can drop the metadata entirely. PanPlay
    // 0.1.1.0 "Everlasting" never had this problem because it re-rendered the
    // whole MediaMetadata object from scratch on every poll; the PWF rebuild
    // updates it more surgically, so playbackState has to be maintained explicitly.
    if ('mediaSession' in navigator) {
        try { navigator.mediaSession.playbackState = state; } catch { /* Unsupported on some older browsers. */ }
    }
}

function normalizeList(value) {
    if (Array.isArray(value)) return value.map((item) => String(typeof item === 'object' ? (item.name || item.display_name || '') : item).trim()).filter(Boolean);
    if (typeof value === 'string') return value.split(/[,;]+/).map((item) => item.trim()).filter(Boolean);
    if (value && typeof value === 'object') return [value.name || value.display_name || ''].filter(Boolean);
    return [];
}

function setArtwork(selector, fallbackSelector, url, alt) {
    const image = document.querySelector(selector);
    const fallback = fallbackSelector ? document.querySelector(fallbackSelector) : null;
    if (!image || !url) return;
    image.src = url;
    image.alt = alt || '';
    image.hidden = false;
    if (fallback) fallback.hidden = true;
}

function currentArtwork() {
    return mediaState.song?.artist?.image || mediaState.song?.artist?.thumb || mediaState.song?.image
        || mediaState.station?.images?.station_640x640 || mediaState.station?.images?.station || config.baseaudio?.artwork_data_uri || '';
}

function updateMediaMetadata() {
    if (!('mediaSession' in navigator)) return;
    const song = mediaState.song || {};
    const station = mediaState.station;
    const artwork = currentArtwork();
    const title = song.title || config.sourceName || 'PanPlay';
    const artist = song.artist?.name || station?.display_name || '';
    const album = song.album || station?.current_playlist?.name || '';
    // Same title/artist/album/artwork as last time: skip re-creating MediaMetadata.
    // Recreating it every ~30s (refreshLautNowPlaying) even with unchanged data is
    // what made lock-screen artwork/controls flicker or briefly drop on some
    // platforms compared to Everlasting's simpler, less frequent DOM-polling approach.
    const signature = `${title} | ${artist} | ${album} | ${artwork}`;
    if (mediaState.lastMediaMetadataSignature === signature) return;
    mediaState.lastMediaMetadataSignature = signature;
    // Everlasting declared the same artwork URL under several `sizes` entries
    // (96x96/128x128/256x256/512x512) instead of a single sizeless entry — several
    // platforms pick the wrong image or silently drop artwork without `sizes` set.
    // Replicating that here restores the more reliable Everlasting behavior.
    const artworkSizes = ['96x96', '128x128', '256x256', '512x512'];
    navigator.mediaSession.metadata = new MediaMetadata({
        title,
        artist,
        album,
        artwork: artwork ? artworkSizes.map((sizes) => ({ src: artwork, sizes })) : [],
    });
}

function appendFact(list, label, value) {
    if (!list || value == null || !String(value).trim()) return;
    const row = document.createElement('div');
    const term = document.createElement('dt');
    const detail = document.createElement('dd');
    term.textContent = label;
    detail.textContent = String(value).trim();
    row.append(term, detail);
    list.append(row);
}

function formatDuration(value) {
    const seconds = Number(value);
    if (!Number.isFinite(seconds) || seconds < 0) return value || '';
    const rounded = Math.round(seconds);
    const hours = Math.floor(rounded / 3600);
    const minutes = Math.floor((rounded % 3600) / 60);
    const remaining = rounded % 60;
    return hours > 0
        ? `${hours}:${String(minutes).padStart(2, '0')}:${String(remaining).padStart(2, '0')}`
        : `${minutes}:${String(remaining).padStart(2, '0')}`;
}

function formatDateTime(value) {
    if (typeof value !== 'string' || !value) return '';
    const parsed = new Date(value);
    return Number.isNaN(parsed.valueOf()) ? '' : parsed.toLocaleString();
}

function updateCurrentDetail(song, title, artist, artwork) {
    setText('[data-panplay-current-title]', title);
    setText('[data-panplay-current-artist]', artist);
    setArtwork('[data-panplay-current-art]', '[data-panplay-current-art-fallback]', artwork, `${i18n.artworkAltPrefix || 'Bild zu'} ${artist}`);
    const facts = document.querySelector('[data-panplay-current-facts]');
    if (facts) {
        facts.replaceChildren();
        appendFact(facts, i18n.factAlbumLabel || 'Album', song.album);
        appendFact(facts, i18n.factGenreLabel || 'Genre', song.genre);
        appendFact(facts, i18n.factDurationLabel || 'Dauer', formatDuration(song.length || song.duration));
        appendFact(facts, i18n.factYearLabel || 'Jahr', song.year);
        appendFact(facts, i18n.factFormatLabel || 'Format', song.format);
        appendFact(facts, i18n.factCodecLabel || 'Codec', song.codec);
        appendFact(facts, i18n.factStartedLabel || 'Gestartet', formatDateTime(song.started_at));
        appendFact(facts, i18n.factEndsLabel || 'Endet', formatDateTime(song.ends_at));
    }
}

function updateSong(song) {
    mediaState.song = song || mediaState.song || {};
    const activeSong = mediaState.song;
    const artist = activeSong.artist?.name || mediaState.station?.display_name || mode;
    const title = cleanTrackTitle(activeSong.title || mediaState.station?.display_name || config.sourceName || 'PanPlay', activeSong.artist?.name || '');
    const artwork = currentArtwork();
    setText('[data-panplay-title]', title);
    setText('[data-panplay-artist]', artist);
    setText('[data-panplay-transport-title]', title);
    setText('[data-panplay-transport-artist]', artist);
    updateMobileLabel();
    setArtwork('[data-panplay-transport-art]', '[data-panplay-transport-art-fallback]', artwork, `${i18n.artworkAltPrefix || 'Bild zu'} ${artist}`);
    updateCurrentDetail(activeSong, title, artist, artwork);
    updateTrackShare(title, artist);
    updateMediaMetadata();
    document.dispatchEvent(new CustomEvent('panplay:songchange', {
        detail: { song: activeSong, title, artist, artwork },
    }));
}

function canonicalPlayerUrl() {
    const url = new URL(window.location.href);
    url.searchParams.set('view', 'player');
    return url.href;
}

function populateShareActions(type, text, url) {
    const target = document.querySelector(`[data-panplay-share-actions="${type}"]`);
    if (!target) return;
    target.replaceChildren();
    if (navigator.share) {
        const native = document.createElement('button');
        native.type = 'button';
        native.className = 'pwf-button pwf-button--primary';
        native.textContent = i18n.shareNativeButton || 'Teilen';
        native.addEventListener('click', () => navigator.share({ title: 'PanPlay', text, url }).catch(() => {}));
        target.append(native);
    }
    const encodedText = encodeURIComponent(text);
    const encodedUrl = encodeURIComponent(url);
    const services = [
        ['X', `https://x.com/intent/post?text=${encodedText}&url=${encodedUrl}`],
        ['Bluesky', `https://bsky.app/intent/compose?text=${encodeURIComponent(`${text} ${url}`)}`],
        ['Facebook', `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`],
        ['WhatsApp', `https://wa.me/?text=${encodeURIComponent(`${text} ${url}`)}`],
        ['Telegram', `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`],
        ['E-Mail', `mailto:?subject=${encodeURIComponent('PanPlay')}&body=${encodeURIComponent(`${text}\n${url}`)}`],
    ];
    services.forEach(([label, href]) => {
        const link = document.createElement('a');
        link.className = 'pwf-button';
        link.href = href;
        link.target = label === 'E-Mail' ? '_self' : '_blank';
        link.rel = 'noopener noreferrer';
        link.textContent = label;
        target.append(link);
    });
}

function updateTrackShare(title, artist) {
    const text = artist ? `${artist} – ${title}` : title;
    setText('[data-panplay-share-track-label]', text);
    const prefix = i18n.shareTrackIntentPrefix || 'Ich höre gerade';
    const suffix = i18n.shareTrackIntentSuffix || 'mit PanPlay.';
    populateShareActions('track', `${prefix} ${text} ${suffix}`, canonicalPlayerUrl());
}

function initShare() {
    populateShareActions('page', i18n.sharePageIntentText || 'Diesen Player mit PanPlay öffnen.', canonicalPlayerUrl());
    const song = mediaState.song;
    updateTrackShare(song?.title || config.sourceName || 'PanPlay', song?.artist?.name || '');
}

function initPlaylistDownloads() {
    const target = document.querySelector('[data-panplay-service-links]');
    if (!target || !config.streamUrl) return;
    const files = [
        ['M3U-Playlist', '#EXTM3U\n' + config.streamUrl + '\n', 'audio/x-mpegurl', 'panplay.m3u'],
        ['PLS-Playlist', `[playlist]\nNumberOfEntries=1\nFile1=${config.streamUrl}\nTitle1=${config.sourceName || 'PanPlay'}\nVersion=2\n`, 'audio/x-scpls', 'panplay.pls'],
    ];
    files.forEach(([label, content, mime, filename]) => {
        const link = document.createElement('a');
        link.className = 'pwf-button';
        link.href = `data:${mime};charset=utf-8,${encodeURIComponent(content)}`;
        link.download = filename;
        link.textContent = label;
        target.append(link);
    });
}

function initCast() {
    const buttons = [...document.querySelectorAll('[data-panplay-cast]')];
    if (!buttons.length || !media?.src) return;
    let checks = 0;
    const syncAvailability = () => {
        checks += 1;
        if (!mediaState.cast && typeof window.Castjs === 'function') {
            try { mediaState.cast = new window.Castjs({ receiver: 'DA6AE6DC' }); }
            catch (error) { console.warn('PanPlay Cast initialization failed:', error); }
        }
        buttons.forEach((button) => { button.hidden = !(mediaState.cast?.available); });
        if (checks >= 60 && !mediaState.cast?.available) window.clearInterval(timer);
    };
    const timer = window.setInterval(syncAvailability, 500);
    syncAvailability();
    buttons.forEach((button) => button.addEventListener('click', () => {
        if (!mediaState.cast?.available) return;
        mediaState.cast.cast(media.currentSrc || media.src, {
            poster: currentArtwork(),
            title: cleanTrackTitle(mediaState.song?.title || config.sourceName || 'PanPlay', mediaState.song?.artist?.name || ''),
            description: mediaState.song?.artist?.name || mediaState.station?.display_name || 'PanPlay',
        });
    }));
}

initShare();
initPlaylistDownloads();
initCast();

export {
    config,
    i18n,
    stationId,
    params,
    mediaState,
    showView,
    setText,
    setPlaybackStatus,
    normalizeList,
    setArtwork,
    currentArtwork,
    updateMediaMetadata,
    updateSong,
};
