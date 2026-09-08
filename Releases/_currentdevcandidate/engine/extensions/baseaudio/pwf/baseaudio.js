export function init(core) {
    const { config, mediaState, updateSong } = core;
    const data = config.baseaudio || {};
    const song = {
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

    mediaState.song = song;
    if (data.artwork_data_uri) {
        document.querySelector('[data-panplay-background]')
            ?.style.setProperty('--panplay-station-background-image', `url(${JSON.stringify(data.artwork_data_uri)})`);
    }
    updateSong(song);
}
