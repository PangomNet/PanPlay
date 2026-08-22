<?php

$streamValue = panplaySettingsParamValue('webstream');
$body = '<p class="card-text fs-6"><small>' .
    htmlspecialchars(panplaySettingsText('settingspanel_baseaudio_desc', 'Change the direct audio URL used by baseaudio. Applying this reloads the player with a new webstream URL parameter.'), ENT_QUOTES, 'UTF-8') .
    '</small></p>';

$body .= '<div class="input-group">';
$body .= '<input class="form-control bg-dark text-white border-danger" type="url" name="webstream" value="' . $streamValue . '" placeholder="https://example.com/audio.mp3">';
$body .= '</div>';

panplaySettingsCard(
    htmlspecialchars(panplaySettingsText('settingspanel_extension_title', 'Extension settings'), ENT_QUOTES, 'UTF-8'),
    'fas fa-plug',
    $body
);

$cpmText = static function ($key, $fallback) use ($ext_lang) {
    return isset($ext_lang[$key]) ? $ext_lang[$key] : $fallback;
};
$cpmEscape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$cpmBadge = static function ($enabled, $enabledText, $disabledText) use ($cpmEscape) {
    $class = $enabled ? 'bg-success' : 'bg-secondary';
    $text = $enabled ? $enabledText : $disabledText;
    return '<span class="badge ' . $class . '">' . $cpmEscape($text) . '</span>';
};

$cpmEnabled = !empty($cfg_panplay_cpm);
$cpmCdnEnabled = $cpmEnabled && !empty($cfg_panplay_cpm_by_cdn);
$cpmLocalListPath = panplayCpmPath('data/cpm/local-filterlist.txt');
$cpmCachePath = panplayCpmPath('data/cpm/cdn-cache-filterlist.txt');
$cpmMetaPath = panplayCpmPath('data/cpm/cdn-cache-meta.json');
$cpmLocalListAvailable = is_file($cpmLocalListPath);
$cpmCacheAvailable = is_file($cpmCachePath) && filesize($cpmCachePath) > 0;
$cpmLastSync = '';
$cpmLastSyncIso = '';
$cpmLastSyncTimestamp = $cpmCacheAvailable ? filemtime($cpmCachePath) : false;

if (is_file($cpmMetaPath)) {
    $cpmMeta = json_decode((string) file_get_contents($cpmMetaPath), true);
    if (is_array($cpmMeta) && !empty($cpmMeta['last_fetch'])) {
        $cpmMetaTimestamp = strtotime((string) $cpmMeta['last_fetch']);
        if ($cpmMetaTimestamp !== false && ($cpmLastSyncTimestamp === false || $cpmMetaTimestamp > $cpmLastSyncTimestamp)) {
            $cpmLastSyncTimestamp = $cpmMetaTimestamp;
        }
    }
}

if ($cpmLastSyncTimestamp !== false) {
    $cpmLastSync = date('Y-m-d H:i T', $cpmLastSyncTimestamp);
    $cpmLastSyncIso = date('c', $cpmLastSyncTimestamp);
}

$cpmOperatorUrl = isset($copyowner_url) && $copyowner_url !== ''
    ? $copyowner_url
    : (isset($pro_eula_vendor_link) ? $pro_eula_vendor_link : '');
$cpmInfoUrl = $cpmCdnEnabled ? 'https://play.pangom.net/cpm/' : $cpmOperatorUrl;
$cpmEnabledText = $cpmText('cpm_info_enabled', 'Enabled');
$cpmDisabledText = $cpmText('cpm_info_disabled', 'Disabled');
$cpmAvailableText = $cpmText('cpm_info_available', 'Available');
$cpmUnavailableText = $cpmText('cpm_info_unavailable', 'Not available');

$cpmBody = '<p class="card-text fs-6"><small>' .
    $cpmEscape($cpmText('cpm_info_description', 'PanPlay CPM checks the requested baseaudio URL against local and optional central filter rules.')) .
    '</small></p>';
$cpmBody .= '<div class="alert alert-secondary py-2" role="note"><small><i class="fas fa-info-circle me-1"></i>' .
    $cpmEscape($cpmText('cpm_info_scope', 'Only baseaudio is checked. Blocked content is stopped before the player interface loads and is explained on a Bluescreen.')) .
    '</small></div>';
$cpmBody .= '<dl class="row mb-2 small">';
$cpmBody .= '<dt class="col-sm-7">' . $cpmEscape($cpmText('cpm_info_local_status', 'Local CPM')) . '</dt>';
$cpmBody .= '<dd class="col-sm-5">' . $cpmBadge($cpmEnabled, $cpmEnabledText, $cpmDisabledText) . '</dd>';
$cpmBody .= '<dt class="col-sm-7">' . $cpmEscape($cpmText('cpm_info_local_list', 'Local filter list')) . '</dt>';
$cpmBody .= '<dd class="col-sm-5">' . $cpmBadge($cpmLocalListAvailable, $cpmAvailableText, $cpmUnavailableText) . '</dd>';
$cpmBody .= '<dt class="col-sm-7">' . $cpmEscape($cpmText('cpm_info_cdn_status', 'CPM by CDN')) . '</dt>';
$cpmBody .= '<dd class="col-sm-5">' . $cpmBadge($cpmCdnEnabled, $cpmEnabledText, $cpmDisabledText) . '</dd>';
$cpmBody .= '<dt class="col-sm-7">' . $cpmEscape($cpmText('cpm_info_cache_status', 'Central list cache')) . '</dt>';
$cpmBody .= '<dd class="col-sm-5">' . $cpmBadge($cpmCacheAvailable, $cpmAvailableText, $cpmUnavailableText) . '</dd>';
if ($cpmLastSync !== '') {
    $cpmBody .= '<dt class="col-sm-7">' . $cpmEscape($cpmText('cpm_info_last_sync', 'Last synchronization')) . '</dt>';
    $cpmBody .= '<dd class="col-sm-5"><time datetime="' . $cpmEscape($cpmLastSyncIso) . '">' . $cpmEscape($cpmLastSync) . '</time></dd>';
}
$cpmBody .= '</dl>';
$cpmBody .= '<p class="card-text mb-2"><small><i class="fas fa-lock me-1"></i>' .
    $cpmEscape($cpmText('cpm_info_read_only', 'This information is read-only. Server operators maintain CPM settings and filter lists.')) .
    '</small></p>';
if ($cpmInfoUrl !== '') {
    $cpmBody .= '<a class="btn btn-outline-danger btn-sm" target="_blank" rel="noopener noreferrer" href="' .
        $cpmEscape($cpmInfoUrl) . '"><i class="fas fa-external-link-alt me-1"></i>' .
        $cpmEscape($cpmText('cpm_info_more_information', 'More information about PanPlay CPM')) . '</a>';
}

panplaySettingsCard(
    $cpmEscape($cpmText('cpm_info_title', 'Content Protection Mechanism (CPM)')),
    'fas fa-shield-alt',
    $cpmBody
);

?>
