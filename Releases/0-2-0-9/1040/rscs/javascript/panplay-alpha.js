import { initPwf } from '../pwf/pwf.js';
import { renderMarkdown } from '../pwf/markdown-viewer.js';

initPwf();

const body = document.body;
const bootstrapNode = document.getElementById('panplay-bootstrap');
let config = {};
try { config = JSON.parse(bootstrapNode?.textContent || '{}'); } catch { config = {}; }
const labels = config.labels || {};
const stationId = config.station || '';
const mode = config.mode || 'none';
const media = document.getElementById('panplay-audio');
const params = new URLSearchParams(window.location.search);
const mediaState = {
    station: null,
    song: mode === 'Baseaudio' ? baseaudioSong() : null,
    history: [],
    currentPlaylistKey: null,
    currentPlaylistName: '',
    cast: null,
    richContentAttempted: false,
};

function baseaudioSong() {
    const data = config.baseaudio || {};
    return {
        title: data.title || config.sourceName || 'Audio',
        artist: { name: data.artist || '' },
        album: data.album || '',
        genre: data.genre || '',
        year: data.year || '',
        length: data.duration_label || '',
        image: data.artwork_data_uri || '',
        format: data.format || '',
        codec: data.codec || '',
    };
}

function showView(requestedView, updateHistory = true) {
    const panel = document.querySelector(`[data-panplay-view-panel="${CSS.escape(requestedView || '')}"]`);
    const view = panel ? requestedView : 'player';
    document.querySelectorAll('[data-panplay-view-panel]').forEach((item) => { item.hidden = item.dataset.panplayViewPanel !== view; });
    document.querySelectorAll('[data-panplay-route]').forEach((link) => {
        if (link.dataset.panplayRoute === view) link.setAttribute('aria-current', 'page');
        else link.removeAttribute('aria-current');
    });
    const mobileLabel = document.querySelector('[data-panplay-mobile-label]');
    if (mobileLabel) mobileLabel.textContent = labels[view] || labels.player || 'Player';
    body.dataset.panplayView = view;
    document.title = `${labels[view] || 'PanPlay'} · ${mediaState.station?.display_name || 'PanPlay'}`;
    if (updateHistory) {
        const url = new URL(window.location.href);
        url.searchParams.set('view', view);
        window.history.pushState({ view }, '', url);
    }
    document.querySelector('.pwf-app__mobile-pages')?.removeAttribute('open');
    if (view === 'schedule') openCurrentScheduleItem();
}

document.querySelectorAll('[data-panplay-route]').forEach((link) => {
    link.addEventListener('click', (event) => {
        if (event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
        event.preventDefault();
        showView(link.dataset.panplayRoute);
    });
});
document.querySelector('[data-panplay-open-current]')?.addEventListener('click', () => showView('nowplaying'));
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
    const playButton = document.querySelector('[data-panplay-play]');
    const muteButton = document.querySelector('[data-panplay-mute]');
    document.querySelector('[data-panplay-icon-play]')?.toggleAttribute('hidden', !paused);
    document.querySelector('[data-panplay-icon-pause]')?.toggleAttribute('hidden', paused);
    document.querySelector('[data-panplay-icon-volume]')?.toggleAttribute('hidden', muted);
    document.querySelector('[data-panplay-icon-muted]')?.toggleAttribute('hidden', !muted);
    playButton?.setAttribute('aria-label', paused ? 'Wiedergabe starten' : 'Wiedergabe pausieren');
    muteButton?.setAttribute('aria-label', muted ? 'Ton einschalten' : 'Stummschalten');
    muteButton?.setAttribute('aria-pressed', String(muted));
}

const volume = document.querySelector('[data-panplay-volume]');
if (media) {
    if (volume) media.volume = Number(volume.value);
    document.querySelector('[data-panplay-play]')?.addEventListener('click', () => {
        if (media.paused) media.play().catch(() => setPlaybackStatus('Wiedergabe konnte nicht gestartet werden'));
        else media.pause();
    });
    document.querySelector('[data-panplay-mute]')?.addEventListener('click', () => { media.muted = !media.muted; syncTransport(); });
    volume?.addEventListener('input', () => {
        media.volume = Number(volume.value);
        if (media.volume > 0) media.muted = false;
    });
    media.addEventListener('play', () => { setPlaybackStatus('Wiedergabe läuft'); syncTransport(); });
    media.addEventListener('pause', () => { setPlaybackStatus('Pausiert'); syncTransport(); });
    media.addEventListener('waiting', () => setPlaybackStatus('Verbindung wird aufgebaut'));
    media.addEventListener('playing', () => setPlaybackStatus('Wiedergabe läuft'));
    media.addEventListener('error', () => setPlaybackStatus('Audioquelle nicht erreichbar'));
    media.addEventListener('volumechange', syncTransport);
    syncTransport();
    if ('mediaSession' in navigator) {
        navigator.mediaSession.setActionHandler('play', () => media.play());
        navigator.mediaSession.setActionHandler('pause', () => media.pause());
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
    navigator.mediaSession.metadata = new MediaMetadata({
        title: song.title || config.sourceName || 'PanPlay',
        artist: song.artist?.name || station?.display_name || '',
        album: song.album || station?.current_playlist?.name || '',
        artwork: artwork ? [{ src: artwork }] : [],
    });
}

async function fetchJson(path = '') {
    const response = await fetch(`https://api.laut.fm/station/${encodeURIComponent(stationId)}${path}`, { headers: { Accept: 'application/json' } });
    if (!response.ok) throw new Error(`laut.fm API returned ${response.status}`);
    return response.json();
}

function revealRichGrid() {
    const grid = document.querySelector('[data-panplay-rich-grid]');
    if (grid) grid.hidden = false;
}

async function loadStationRichContent(website) {
    const card = document.querySelector('[data-panplay-rich-card]');
    const target = document.querySelector('[data-panplay-rich-content]');
    if (!website || !card || !target || mediaState.richContentAttempted) return;
    mediaState.richContentAttempted = true;
    try {
        const source = new URL(website);
        if (!['http:', 'https:'].includes(source.protocol)) return;
        if (window.location.protocol === 'https:' && source.protocol === 'http:') source.protocol = 'https:';
        source.pathname = '/playercontent.md';
        source.search = '';
        source.hash = '';
        const response = await fetch(source.href, { headers: { Accept: 'text/markdown, text/plain;q=0.9' } });
        if (!response.ok || new URL(response.url).origin !== source.origin) return;
        if (Number(response.headers.get('content-length') || 0) > 524288) return;
        const markdown = await response.text();
        if (!markdown.trim() || markdown.length > 524288) return;
        renderMarkdown(markdown, target, {
            resolveLink: (href) => {
                try {
                    const resolved = new URL(href, source.origin);
                    return ['http:', 'https:', 'mailto:'].includes(resolved.protocol) ? resolved.href : '#';
                } catch { return '#'; }
            },
        });
        card.hidden = false;
        revealRichGrid();
    } catch {
        // Missing files and station websites without CORS permission are expected.
    }
}

function addExternalLink(container, label, url, className = 'pwf-button') {
    if (!container || !url) return;
    try {
        const parsed = new URL(url, window.location.href);
        if (!['http:', 'https:'].includes(parsed.protocol)) return;
        const link = document.createElement('a');
        link.className = className;
        link.href = parsed.href;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        link.textContent = label;
        container.append(link);
    } catch { /* Invalid third-party URLs are ignored. */ }
}

function addStationIconLink(container, label, url, imagePath) {
    if (!container || !url) return;
    try {
        const parsed = new URL(url, window.location.href);
        if (!['http:', 'https:'].includes(parsed.protocol)) return;
        const link = document.createElement('a');
        link.className = 'panplay-social-link panplay-social-link--image';
        link.href = parsed.href;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        link.title = label;
        link.setAttribute('aria-label', label);
        const image = document.createElement('img');
        image.src = imagePath;
        image.alt = '';
        link.append(image);
        container.append(link);
    } catch { /* Invalid third-party URLs are ignored. */ }
}

function renderTagGroup(group, values, urlFactory = null) {
    const section = document.querySelector(`[data-panplay-station-group="${group}"]`);
    const target = document.querySelector(`[data-panplay-station-${group}]`);
    const items = normalizeList(values);
    if (!section || !target || !items.length) return;
    const fragment = document.createDocumentFragment();
    items.forEach((value) => {
        const item = urlFactory ? document.createElement('a') : document.createElement('span');
        item.className = 'panplay-tag';
        item.textContent = value;
        if (item instanceof HTMLAnchorElement) {
            item.href = urlFactory(value);
            item.target = '_blank';
            item.rel = 'noopener noreferrer';
        }
        fragment.append(item);
    });
    target.replaceChildren(fragment);
    section.hidden = false;
}

function thirdPartyUrl(entry, fallbackHost = '') {
    if (!entry) return '';
    let value = typeof entry === 'string' ? entry : (entry.url || entry.page || entry.name || '');
    if (!value) return '';
    if (!/^https?:\/\//i.test(value)) value = `https://${fallbackHost}/${String(value).replace(/^\/+/, '')}`;
    return value;
}

function renderStationLinks(station) {
    const socialTarget = document.querySelector('[data-panplay-station-socials]');
    const serviceTarget = document.querySelector('[data-panplay-service-links]');
    const parties = station.third_parties || {};
    if (socialTarget) {
        socialTarget.replaceChildren();
        addStationIconLink(socialTarget, 'Website', thirdPartyUrl(parties.website), 'rscs/imglibs/social/homepage_link/link-tealwhite.png');
        addStationIconLink(socialTarget, 'X', thirdPartyUrl(parties.twitter, 'x.com'), 'rscs/imglibs/social/x/x-blackwhite.png');
        addStationIconLink(socialTarget, 'Facebook', thirdPartyUrl(parties.facebook, 'facebook.com'), 'rscs/imglibs/social/facebook/fb-color.png');
        addStationIconLink(socialTarget, 'Instagram', thirdPartyUrl(parties.instagram, 'instagram.com'), 'rscs/imglibs/social/instagramm/ig-color.png');
    }
    if (serviceTarget) {
        serviceTarget.querySelectorAll('.panplay-api-service').forEach((item) => item.remove());
        addExternalLink(serviceTarget, 'laut.fm', `https://laut.fm/${encodeURIComponent(station.name || stationId)}`, 'pwf-button panplay-api-service');
        addExternalLink(serviceTarget, 'TuneIn', thirdPartyUrl(parties.tunein, 'tunein.com'), 'pwf-button panplay-api-service');
        addExternalLink(serviceTarget, 'radio.de', thirdPartyUrl(parties.radiode, 'radio.de'), 'pwf-button panplay-api-service');
        addExternalLink(serviceTarget, 'Phonostar', thirdPartyUrl(parties.phonostar, 'phonostar.de'), 'pwf-button panplay-api-service');
    }
}

async function applyStationAccent(imageUrl) {
    if (!imageUrl || params.get('stationaccent') === 'n') return;
    const sources = [imageUrl];
    try {
        const proxy = new URL('engine/extensions/laut/imageproxy.php', window.location.href);
        proxy.searchParams.set('url', imageUrl);
        sources.push(proxy.href);
    } catch { /* The direct image remains available as the first attempt. */ }
    for (const source of sources) try {
        const image = new Image();
        if (source === imageUrl) image.crossOrigin = 'anonymous';
        const loaded = new Promise((resolve, reject) => { image.onload = resolve; image.onerror = reject; });
        image.src = source;
        await loaded;
        const canvas = document.createElement('canvas');
        canvas.width = 24;
        canvas.height = 24;
        const context = canvas.getContext('2d', { willReadFrequently: true });
        context.drawImage(image, 0, 0, 24, 24);
        const pixels = context.getImageData(0, 0, 24, 24).data;
        let red = 0, green = 0, blue = 0, weight = 0;
        for (let index = 0; index < pixels.length; index += 4) {
            const alpha = pixels[index + 3] / 255;
            const max = Math.max(pixels[index], pixels[index + 1], pixels[index + 2]);
            const min = Math.min(pixels[index], pixels[index + 1], pixels[index + 2]);
            const lightness = (max + min) / 510;
            const saturation = max === min ? 0 : (max - min) / (255 - Math.abs(max + min - 255));
            if (alpha < 0.45 || lightness < 0.12 || lightness > 0.9) continue;
            const pixelWeight = alpha * (0.35 + saturation);
            red += pixels[index] * pixelWeight;
            green += pixels[index + 1] * pixelWeight;
            blue += pixels[index + 2] * pixelWeight;
            weight += pixelWeight;
        }
        if (!weight) return;
        const color = `rgb(${Math.round(red / weight)} ${Math.round(green / weight)} ${Math.round(blue / weight)})`;
        document.documentElement.style.setProperty('--pwf-color-accent', color);
        document.documentElement.style.setProperty('--pwf-route-accent', color);
        body.style.setProperty('--panplay-station-accent', color);
        return;
    } catch { /* Try the same-origin, laut.fm-only proxy after a CORS failure. */ }
}

function updateStation(station) {
    mediaState.station = station;
    const currentPlaylist = station.current_playlist;
    mediaState.currentPlaylistKey = currentPlaylist ? `${currentPlaylist.day}:${currentPlaylist.hour}:${currentPlaylist.id}` : null;
    mediaState.currentPlaylistName = currentPlaylist?.name || '';
    const name = station.display_name || station.name || stationId;
    setText('[data-panplay-station-heading]', name);
    setText('[data-panplay-station-description]', station.description || 'Für diesen Sender ist keine Beschreibung hinterlegt.');
    const slogan = document.querySelector('[data-panplay-station-slogan]');
    if (slogan && station.slogan) { slogan.textContent = station.slogan; slogan.hidden = false; }

    const stationImage = station.images?.station_640x640 || station.images?.station || '';
    const brandImage = document.querySelector('[data-panplay-brand-image]');
    const brandNote = document.querySelector('[data-panplay-brand-note]');
    const brandLabel = document.querySelector('[data-panplay-brand-label]');
    if (brandImage && station.images?.station_80x80) {
        brandImage.src = station.images.station_80x80;
        brandImage.hidden = false;
        if (brandNote) brandNote.hidden = true;
    }
    if (brandLabel) brandLabel.textContent = name;
    setArtwork('[data-panplay-station-image]', '', stationImage, `Senderlogo von ${name}`);
    setArtwork('[data-panplay-cover]', '[data-panplay-cover-fallback]', stationImage, `Senderlogo von ${name}`);
    const backgroundUrl = station.images?.background_1024x768 || station.images?.background || stationImage;
    const background = document.querySelector('[data-panplay-background]');
    if (background && backgroundUrl) background.style.setProperty('--panplay-station-background-image', `url(${JSON.stringify(backgroundUrl)})`);
    applyStationAccent(stationImage);

    renderTagGroup('djs', station.djs, (value) => `https://www.last.fm/music/${encodeURIComponent(value)}`);
    let locationValues = station.location;
    if (station.location && typeof station.location === 'object') locationValues = station.location.name || station.location.city || station.location;
    const coordinates = station.lat && station.lng ? `${station.lat},${station.lng}` : '';
    renderTagGroup('location', locationValues, (value) => `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(coordinates || value)}`);
    renderTagGroup('genres', station.genres, (value) => `https://www.last.fm/tag/${encodeURIComponent(value)}`);
    renderTagGroup('artists', station.top_artists, (value) => `https://www.last.fm/music/${encodeURIComponent(value)}`);
    const stationMeta = document.querySelector('[data-panplay-station-meta]');
    if (stationMeta) {
        stationMeta.replaceChildren();
        const values = [
            station.format ? `Format: ${station.format}` : '',
            Number.isFinite(Number(station.listeners)) ? `${station.listeners} Hörer` : '',
            Number.isFinite(Number(station.position)) ? `Rang ${station.position}` : '',
        ].filter(Boolean);
        values.forEach((value) => {
            const badge = document.createElement('span');
            badge.className = 'panplay-tag';
            badge.textContent = value;
            stationMeta.append(badge);
        });
    }
    renderStationLinks(station);

    const showButton = document.querySelector('[data-panplay-current-show]');
    if (showButton && currentPlaylist?.name) {
        showButton.textContent = currentPlaylist.name;
        showButton.hidden = false;
        showButton.onclick = () => showView('schedule');
    }
    const descriptionCard = document.querySelector('[data-panplay-station-summary-card]');
    if (descriptionCard && station.description) {
        setText('[data-panplay-station-summary]', station.description);
        descriptionCard.hidden = false;
        revealRichGrid();
    }
    loadStationRichContent(thirdPartyUrl(station.third_parties?.website));
    updateMediaMetadata();
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
    setArtwork('[data-panplay-current-art]', '[data-panplay-current-art-fallback]', artwork, `Bild zu ${artist}`);
    const facts = document.querySelector('[data-panplay-current-facts]');
    if (facts) {
        facts.replaceChildren();
        appendFact(facts, 'Album', song.album);
        appendFact(facts, 'Genre', song.genre);
        appendFact(facts, 'Dauer', formatDuration(song.length || song.duration));
        appendFact(facts, 'Jahr', song.year);
        appendFact(facts, 'Format', song.format);
        appendFact(facts, 'Codec', song.codec);
        appendFact(facts, 'Gestartet', formatDateTime(song.started_at));
        appendFact(facts, 'Endet', formatDateTime(song.ends_at));
    }
    const lastfm = document.querySelector('[data-panplay-current-lastfm]');
    if (lastfm && mode === 'laut.fm') {
        lastfm.href = `https://www.last.fm/search/tracks?q=${encodeURIComponent(`${artist} - ${title}`)}`;
        lastfm.hidden = false;
    }
}

function updateSong(song) {
    mediaState.song = song || mediaState.song || {};
    const activeSong = mediaState.song;
    const title = activeSong.title || mediaState.station?.display_name || config.sourceName || 'PanPlay';
    const artist = activeSong.artist?.name || mediaState.station?.display_name || mode;
    const artwork = currentArtwork();
    setText('[data-panplay-title]', title);
    setText('[data-panplay-artist]', artist);
    setText('[data-panplay-transport-title]', title);
    setText('[data-panplay-transport-artist]', artist);
    setArtwork('[data-panplay-transport-art]', '[data-panplay-transport-art-fallback]', artwork, `Bild zu ${artist}`);
    if (mode === 'laut.fm' && artwork) setArtwork('[data-panplay-cover]', '[data-panplay-cover-fallback]', artwork, `Bild zu ${artist}`);
    updateCurrentDetail(activeSong, title, artist, artwork);
    const liveByName = params.get('lbn') === 'y' && mediaState.currentPlaylistName.toLowerCase().includes('live');
    const isLive = activeSong.live === true || activeSong.type === 'live' || mediaState.station?.live === true || liveByName;
    const liveStrip = document.querySelector('[data-panplay-live-strip]');
    if (liveStrip) {
        liveStrip.hidden = !isLive;
        setText('[data-panplay-live-label]', mediaState.currentPlaylistName || title);
    }
    updateTrackShare(title, artist);
    updateMediaMetadata();
}

function renderHistory(songs) {
    const target = document.querySelector('[data-panplay-history]');
    if (!target || !Array.isArray(songs) || !songs.length) return;
    mediaState.history = songs;
    const list = document.createElement('ol');
    list.className = 'panplay-track-list';
    songs.forEach((song) => {
        const item = document.createElement('li');
        const time = document.createElement('time');
        const parsed = new Date(song.started_at);
        time.textContent = Number.isNaN(parsed.valueOf()) ? '' : parsed.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const link = document.createElement('a');
        const artist = song.artist?.name || 'Unbekannter Interpret';
        link.href = `https://www.last.fm/search/tracks?q=${encodeURIComponent(`${artist} - ${song.title || ''}`)}`;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        const title = document.createElement('strong');
        title.textContent = song.title || 'Unbekannter Titel';
        const by = document.createElement('small');
        by.textContent = artist;
        link.append(title, by);
        item.append(time, link);
        list.append(item);
    });
    target.replaceChildren(list);
}

const dayLabels = { mon: 'Montag', tue: 'Dienstag', wed: 'Mittwoch', thu: 'Donnerstag', fri: 'Freitag', sat: 'Samstag', sun: 'Sonntag' };
function renderSchedule(entries) {
    const target = document.querySelector('[data-panplay-schedule]');
    if (!target || !Array.isArray(entries) || !entries.length) return;
    const groups = new Map(Object.keys(dayLabels).map((day) => [day, []]));
    entries.forEach((entry) => groups.get(entry.day)?.push(entry));
    const fragment = document.createDocumentFragment();
    groups.forEach((items, day) => {
        if (!items.length) return;
        const section = document.createElement('section');
        section.className = 'panplay-schedule-day';
        const heading = document.createElement('h2');
        heading.textContent = dayLabels[day];
        section.append(heading);
        items.forEach((entry) => {
            const entryKey = `${entry.day}:${entry.hour}:${entry.id}`;
            const item = document.createElement(entry.description ? 'details' : 'div');
            item.className = 'panplay-schedule-item';
            item.dataset.playlistKey = entryKey;
            item.dataset.playlistName = entry.name || '';
            item.style.setProperty('--panplay-program-color', entry.color || 'var(--pwf-color-accent)');
            const summary = document.createElement(entry.description ? 'summary' : 'div');
            summary.className = 'panplay-schedule-item__summary';
            const swatch = document.createElement('span');
            swatch.className = 'panplay-schedule-item__swatch';
            swatch.setAttribute('aria-hidden', 'true');
            const time = document.createElement('time');
            time.textContent = `${String(entry.hour).padStart(2, '0')}:00`;
            const name = document.createElement('strong');
            name.textContent = entry.name || 'Sendung';
            summary.append(swatch, time, name);
            item.append(summary);
            if (entry.description) {
                const description = document.createElement('p');
                description.textContent = entry.description;
                item.append(description);
            }
            if (entryKey === mediaState.currentPlaylistKey) item.classList.add('is-current');
            section.append(item);
        });
        fragment.append(section);
    });
    target.replaceChildren(fragment);
}

function openCurrentScheduleItem() {
    let current = mediaState.currentPlaylistKey
        ? document.querySelector(`[data-playlist-key="${CSS.escape(mediaState.currentPlaylistKey)}"]`)
        : null;
    if (!current && mediaState.currentPlaylistName) {
        current = [...document.querySelectorAll('[data-playlist-name]')].find((item) => item.dataset.playlistName.trim().toLowerCase() === mediaState.currentPlaylistName.trim().toLowerCase());
    }
    if (current instanceof HTMLDetailsElement) current.open = true;
    current?.classList.add('is-current');
    current?.scrollIntoView({ block: 'center', behavior: 'smooth' });
}

async function loadLautData() {
    if (!stationId) return;
    try {
        const [station, currentSong, history, schedule, listeners] = await Promise.all([
            fetchJson(), fetchJson('/current_song'), fetchJson('/last_songs'), fetchJson('/schedule'), fetchJson('/listeners').catch(() => null),
        ]);
        station.listeners = typeof listeners === 'number' ? listeners : (listeners?.listeners ?? listeners?.current ?? '');
        updateStation(station);
        const detailed = Array.isArray(history) && history[0] ? history[0] : {};
        const merged = { ...detailed, ...currentSong, artist: { ...(detailed.artist || {}), ...(currentSong.artist || {}) } };
        updateSong(merged);
        renderHistory(history);
        renderSchedule(schedule);
    } catch (error) {
        console.error('PanPlay laut.fm API error:', error);
        setPlaybackStatus('Senderdaten derzeit nicht erreichbar');
    }
}

async function refreshLautNowPlaying() {
    if (!stationId) return;
    try {
        const [station, currentSong, history] = await Promise.all([fetchJson(), fetchJson('/current_song'), fetchJson('/last_songs')]);
        updateStation(station);
        const detailed = Array.isArray(history) && history[0] ? history[0] : {};
        updateSong({ ...detailed, ...currentSong, artist: { ...(detailed.artist || {}), ...(currentSong.artist || {}) } });
        renderHistory(history);
    } catch (error) {
        console.warn('PanPlay laut.fm refresh failed:', error);
    }
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
        native.textContent = 'Teilen';
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
    populateShareActions('track', `Ich höre gerade ${text} mit PanPlay.`, canonicalPlayerUrl());
}

function initShare() {
    populateShareActions('page', 'Diesen Player mit PanPlay öffnen.', canonicalPlayerUrl());
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
    const button = document.querySelector('[data-panplay-cast]');
    if (!button || !media?.src) return;
    let checks = 0;
    const syncAvailability = () => {
        checks += 1;
        if (!mediaState.cast && typeof window.Castjs === 'function') {
            try { mediaState.cast = new window.Castjs({ receiver: 'DA6AE6DC' }); }
            catch (error) { console.warn('PanPlay Cast initialization failed:', error); }
        }
        button.hidden = !(mediaState.cast?.available);
        if (checks >= 60 && !mediaState.cast?.available) window.clearInterval(timer);
    };
    const timer = window.setInterval(syncAvailability, 500);
    syncAvailability();
    button.addEventListener('click', () => {
        const cast = mediaState.cast;
        if (!cast?.available) return;
        cast.cast(media.currentSrc || media.src, {
            poster: currentArtwork(),
            title: mediaState.song?.title || config.sourceName || 'PanPlay',
            description: mediaState.song?.artist?.name || mediaState.station?.display_name || 'PanPlay',
        });
    });
}

if (mode === 'Baseaudio') {
    const artwork = config.baseaudio?.artwork_data_uri || '';
    if (artwork) {
        const background = document.querySelector('[data-panplay-background]');
        background?.style.setProperty('--panplay-station-background-image', `url(${JSON.stringify(artwork)})`);
    }
    updateSong(mediaState.song);
}
if (stationId) {
    loadLautData();
    window.setInterval(refreshLautNowPlaying, 30000);
}
initShare();
initPlaylistDownloads();
initCast();
