(function () {
    'use strict';

    var metadata = window.panplayBaseaudioMetadata || {};
    window.currentSongTitle = metadata.title || 'Audio';
    window.currentArtistName = metadata.artist || 'PanPlay';
    window.currentAlbumTitle = metadata.album || '';
    window.currentAlbumArtUrl = metadata.artwork || metadata.fallbackArtwork || '';

    window.getCurrentSongInfoFromUI = function () {
        return {
            title: window.currentSongTitle,
            artist: window.currentArtistName,
            album: window.currentAlbumTitle,
            artwork: window.currentAlbumArtUrl
        };
    };

    window.updateCurrentAlbumArtFromAPI = function () {
        return window.currentAlbumArtUrl;
    };

    function updateMediaSession() {
        if (!('mediaSession' in navigator) || typeof MediaMetadata === 'undefined') {
            return;
        }

        var mediaMetadata = {
            title: window.currentSongTitle,
            artist: window.currentArtistName,
            album: window.currentAlbumTitle
        };
        if (window.currentAlbumArtUrl) {
            mediaMetadata.artwork = [{
                src: window.currentAlbumArtUrl,
                type: metadata.artworkMime || 'image/png'
            }];
        }

        try {
            navigator.mediaSession.metadata = new MediaMetadata(mediaMetadata);
        } catch (error) {
            console.warn('PanPlay could not publish Baseaudio metadata.', error);
        }
    }

    function registerAction(action, callback) {
        if (!('mediaSession' in navigator) || typeof navigator.mediaSession.setActionHandler !== 'function') {
            return;
        }
        try {
            navigator.mediaSession.setActionHandler(action, callback);
        } catch (error) {
            // Older Media Session implementations may not support every action.
        }
    }

    var audio = document.getElementById('oop_audio');
    if (audio) {
        audio.addEventListener('loadedmetadata', updateMediaSession);
        audio.addEventListener('play', updateMediaSession);
        registerAction('play', function () { audio.play(); });
        registerAction('pause', function () { audio.pause(); });
        registerAction('seekbackward', function (details) {
            audio.currentTime = Math.max(0, audio.currentTime - (details.seekOffset || 10));
        });
        registerAction('seekforward', function (details) {
            var nextTime = audio.currentTime + (details.seekOffset || 10);
            audio.currentTime = Number.isFinite(audio.duration) ? Math.min(audio.duration, nextTime) : nextTime;
        });
        registerAction('seekto', function (details) {
            if (typeof details.seekTime === 'number') {
                audio.currentTime = details.seekTime;
            }
        });
    }

    document.title = window.currentArtistName && window.currentArtistName !== 'PanPlay'
        ? window.currentArtistName + ' - ' + window.currentSongTitle + ' - PanPlay'
        : window.currentSongTitle + ' - PanPlay';
    updateMediaSession();
}());
