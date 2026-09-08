(function () {
    'use strict';

    var castButton = document.getElementById('cast');
    if (!castButton) {
        return;
    }

    castButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (typeof cjs === 'undefined' || !cjs || !cjs.available) {
            return;
        }

        var streamUrl = new URLSearchParams(window.location.search).get('webstream');
        if (!streamUrl) {
            return;
        }

        var metadata = window.panplayBaseaudioMetadata || {};
        var castRequest = cjs.cast(streamUrl, {
            poster: metadata.artwork || metadata.fallbackArtwork || '',
            title: metadata.artist ? metadata.artist + ' - ' + metadata.title : (metadata.title || 'PanPlay'),
            description: metadata.album || 'PanPlay'
        });
        if (castRequest && typeof castRequest.catch === 'function') {
            castRequest.catch(function (error) {
                console.error('PanPlay Cast error:', error);
            });
        }
    });

    if (typeof cjs !== 'undefined'
        && cjs
        && typeof cjs.addEventListener === 'function'
        && typeof cast !== 'undefined'
        && cast.framework
        && cast.framework.RemotePlayerEventType) {
        cjs.addEventListener(cast.framework.RemotePlayerEventType.MEDIA_INFO_CHANGED, function () {
            var session = cast.framework.CastContext.getInstance().getCurrentSession();
            if (!session || !session.getMediaSession()) {
                return;
            }
        });
    }
}());
