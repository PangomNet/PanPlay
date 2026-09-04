<?php
$metadata = isset($baseaudioMetadata) && is_array($baseaudioMetadata)
    ? $baseaudioMetadata
    : panplayBaseaudioMetadataFallback((string) $webstream, 'not_initialized');

$artwork = $metadata['artwork_data_uri'] !== ''
    ? $metadata['artwork_data_uri']
    : 'engine/extensions/baseaudio/placeholder-cover.png';
$artworkMime = 'image/png';
if (strpos($artwork, 'data:') === 0) {
    $separator = strpos($artwork, ';');
    $artworkMime = $separator !== false ? substr($artwork, 5, $separator - 5) : 'image/png';
}

$browserMetadata = [
    'title' => $metadata['title'],
    'artist' => $metadata['artist'],
    'album' => $metadata['album'],
    'artwork' => $artwork,
    'fallbackArtwork' => 'engine/extensions/baseaudio/placeholder-cover.png',
    'artworkMime' => $artworkMime,
    'format' => $metadata['format'],
    'duration' => $metadata['duration_seconds'],
];
$metadataJson = json_encode(
    $browserMetadata,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
);
?>
<script>
window.panplayBaseaudioMetadata = <?= $metadataJson !== false ? $metadataJson : '{}' ?>;
<?php require __DIR__ . '/mediametadata_notify.js'; ?>
</script>
