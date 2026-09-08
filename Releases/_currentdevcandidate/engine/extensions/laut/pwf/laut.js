import { renderMarkdown } from '../../../../rscs/pwf/markdown-viewer.js';

export function init(core) {
    const {
        i18n, stationId, params, mediaState, showView, setText, setPlaybackStatus,
        normalizeList, setArtwork, updateMediaMetadata, updateSong,
    } = core;
    if (!stationId) return;

    async function fetchJson(path = '') {
        const response = await fetch(`https://api.laut.fm/station/${encodeURIComponent(stationId)}${path}`, {
            headers: { Accept: 'application/json' },
        });
        if (!response.ok) throw new Error(`laut.fm API returned ${response.status}`);
        return response.json();
    }

    function revealRichGrid() {
        const grid = document.querySelector('[data-panplay-rich-grid]');
        if (grid) grid.hidden = false;
    }

    function thirdPartyUrl(entry, fallbackHost = '') {
        if (!entry) return '';
        let value = typeof entry === 'string' ? entry : (entry.url || entry.page || entry.name || '');
        if (!value) return '';
        if (!/^https?:\/\//i.test(value)) value = `https://${fallbackHost}/${String(value).replace(/^\/+/, '')}`;
        return value;
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
        } catch { /* Keep the direct image as the first attempt. */ }
        for (const source of sources) try {
            const image = new Image();
            if (source === imageUrl) image.crossOrigin = 'anonymous';
            await new Promise((resolve, reject) => {
                image.onload = resolve;
                image.onerror = reject;
                image.src = source;
            });
            const canvas = document.createElement('canvas');
            canvas.width = 24;
            canvas.height = 24;
            const context = canvas.getContext('2d', { willReadFrequently: true });
            if (!context) return;
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
            document.body.style.setProperty('--panplay-station-accent', color);
            return;
        } catch { /* Try the same-origin laut.fm image helper next. */ }
    }

    function updateStation(station) {
        mediaState.station = station;
        const current = station.current_playlist;
        mediaState.currentPlaylistKey = current ? `${current.day}:${current.hour}:${current.id}` : null;
        mediaState.currentPlaylistName = current?.name || '';
        const name = station.display_name || station.name || stationId;
        setText('[data-panplay-station-heading]', name);
        setText('[data-panplay-station-description]', station.description || i18n.stationDescriptionFallback || 'Für diesen Sender ist keine Beschreibung hinterlegt.');
        const slogan = document.querySelector('[data-panplay-station-slogan]');
        if (slogan && station.slogan) {
            slogan.textContent = station.slogan;
            slogan.hidden = false;
        }

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
        if (background && backgroundUrl) {
            background.style.setProperty('--panplay-station-background-image', `url(${JSON.stringify(backgroundUrl)})`);
        }
        applyStationAccent(stationImage);

        renderTagGroup('djs', station.djs, (value) => `https://www.last.fm/music/${encodeURIComponent(value)}`);
        let location = station.location;
        if (location && typeof location === 'object') location = location.name || location.city || location;
        const coordinates = station.lat && station.lng ? `${station.lat},${station.lng}` : '';
        renderTagGroup('location', location, (value) => `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(coordinates || value)}`);
        renderTagGroup('genres', station.genres, (value) => `https://www.last.fm/tag/${encodeURIComponent(value)}`);
        renderTagGroup('artists', station.top_artists, (value) => `https://www.last.fm/music/${encodeURIComponent(value)}`);
        const stationMeta = document.querySelector('[data-panplay-station-meta]');
        if (stationMeta) {
            stationMeta.replaceChildren();
            [
                station.format ? `${i18n.stationFormatPrefix || 'Format'}: ${station.format}` : '',
                Number.isFinite(Number(station.listeners)) ? `${station.listeners} ${i18n.stationListenersSuffix || 'Hörer'}` : '',
                Number.isFinite(Number(station.position)) ? `${i18n.stationRankPrefix || 'Rang'} ${station.position}` : '',
            ].filter(Boolean).forEach((value) => {
                const badge = document.createElement('span');
                badge.className = 'panplay-tag';
                badge.textContent = value;
                stationMeta.append(badge);
            });
        }
        renderStationLinks(station);

        const showButton = document.querySelector('[data-panplay-current-show]');
        if (showButton && current?.name) {
            showButton.textContent = current.name;
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

    const dayLabels = {
        mon: 'Montag', tue: 'Dienstag', wed: 'Mittwoch', thu: 'Donnerstag',
        fri: 'Freitag', sat: 'Samstag', sun: 'Sonntag',
    };

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
                const key = `${entry.day}:${entry.hour}:${entry.id}`;
                const item = document.createElement(entry.description ? 'details' : 'div');
                item.className = 'panplay-schedule-item';
                item.dataset.playlistKey = key;
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
                if (key === mediaState.currentPlaylistKey) item.classList.add('is-current');
                section.append(item);
            });
            fragment.append(section);
        });
        target.replaceChildren(fragment);
        if (document.body.dataset.panplayView === 'schedule') openCurrentScheduleItem();
    }

    function openCurrentScheduleItem() {
        let current = mediaState.currentPlaylistKey
            ? document.querySelector(`[data-playlist-key="${CSS.escape(mediaState.currentPlaylistKey)}"]`)
            : null;
        if (!current && mediaState.currentPlaylistName) {
            current = [...document.querySelectorAll('[data-playlist-name]')]
                .find((item) => item.dataset.playlistName.trim().toLowerCase() === mediaState.currentPlaylistName.trim().toLowerCase());
        }
        if (current instanceof HTMLDetailsElement) current.open = true;
        current?.classList.add('is-current');
        current?.scrollIntoView({ block: 'center', behavior: 'smooth' });
    }

    function syncLautSongUi({ song = {}, title = '', artist = '', artwork = '' }) {
        if (artwork) {
            setArtwork('[data-panplay-cover]', '[data-panplay-cover-fallback]', artwork, `${i18n.artworkAltPrefix || 'Bild zu'} ${artist}`);
        }
        const lastfm = document.querySelector('[data-panplay-current-lastfm]');
        if (lastfm) {
            lastfm.href = `https://www.last.fm/search/tracks?q=${encodeURIComponent(`${artist} - ${title}`)}`;
            lastfm.hidden = false;
        }
        const liveByName = params.get('lbn') === 'y' && mediaState.currentPlaylistName.toLowerCase().includes('live');
        const isLive = song.live === true || song.type === 'live' || mediaState.station?.live === true || liveByName;
        const liveStrip = document.querySelector('[data-panplay-live-strip]');
        if (liveStrip) {
            liveStrip.hidden = !isLive;
            setText('[data-panplay-live-label]', mediaState.currentPlaylistName || title);
        }
    }

    async function loadLautData() {
        try {
            const [station, currentSong, history, schedule, listeners] = await Promise.all([
                fetchJson(), fetchJson('/current_song'), fetchJson('/last_songs'), fetchJson('/schedule'),
                fetchJson('/listeners').catch(() => null),
            ]);
            station.listeners = typeof listeners === 'number' ? listeners : (listeners?.listeners ?? listeners?.current ?? '');
            updateStation(station);
            const detailed = Array.isArray(history) && history[0] ? history[0] : {};
            updateSong({ ...detailed, ...currentSong, artist: { ...(detailed.artist || {}), ...(currentSong.artist || {}) } });
            renderHistory(history);
            renderSchedule(schedule);
        } catch (error) {
            console.error('PanPlay laut.fm API error:', error);
            setPlaybackStatus(i18n.stationDataUnavailableStatus || 'Senderdaten derzeit nicht erreichbar');
        }
    }

    async function refreshLautNowPlaying() {
        try {
            const [station, currentSong, history] = await Promise.all([
                fetchJson(), fetchJson('/current_song'), fetchJson('/last_songs'),
            ]);
            updateStation(station);
            const detailed = Array.isArray(history) && history[0] ? history[0] : {};
            updateSong({ ...detailed, ...currentSong, artist: { ...(detailed.artist || {}), ...(currentSong.artist || {}) } });
            renderHistory(history);
        } catch (error) {
            console.warn('PanPlay laut.fm refresh failed:', error);
        }
    }

    document.addEventListener('panplay:viewchange', (event) => {
        if (event.detail?.view === 'schedule') openCurrentScheduleItem();
    });
    document.addEventListener('panplay:songchange', (event) => syncLautSongUi(event.detail || {}));

    loadLautData();
    window.setInterval(refreshLautNowPlaying, 30000);
}
