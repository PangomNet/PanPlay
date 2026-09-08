<?php
/*
 * PanPlay language file
 *
 * ENCODING: UTF-8 only.
 * Read and save this file as UTF-8. Keep Unicode characters literal.
 * Do not replace them with escaped code points, HTML entities, or Latin-1.
 * After every edit, verify that the integrity line below is still readable.
 *
 * INTEGRITY CHECK: æøå | ñáéíóú | 你好世界 | नमस्ते | مرحبا | äöüß
 */
$ext_lang = array(
    // Basic
    'lng_title' => '简体中文',
    'extension_title' => 'PanPlay Baseaudio 扩展',
    'extension_credits' => 'PanPlay Baseaudio 扩展',
    'extension_credits_link' => 'https://play.pangom.net/?from=PanPlay-Extension',

    // Navigation
    'stationinfo_navbar_title' => ' 关于音频源',
    'playwith_navbar_title' => '切换播放器',

    // Audio source information
    'stationinfo_modal_title' => '音频源信息',
    'stationinfo_modal_topdesc' => '此音频源目前没有可用的其他元数据。',

    // 文件元数据
    'metadata_file_details' => '音频文件详情',
    'metadata_title_label' => '标题',
    'metadata_artist_label' => '艺术家',
    'metadata_album_label' => '专辑',
    'metadata_genre_label' => '流派',
    'metadata_year_label' => '年份',
    'metadata_duration_label' => '时长',
    'metadata_format_label' => '格式和编解码器',
    'metadata_bitrate_label' => '比特率',
    'metadata_sample_rate_label' => '采样率',
    'metadata_channels_label' => '声道',
    'metadata_filesize_label' => '文件大小',
    'metadata_source_label' => '音频来源',
    'metadata_tags_unavailable' => 'PanPlay 无法从此来源读取更多标签。播放器仍可使用网址中的信息进行播放。',

    // External playback and Google Cast
    'playwith_modal_title' => '切换播放器',
    'playwith_modal_topdesc' => '您可以在其他应用或外部播放设备上打开此音频源。',
    'playwith_modal_gcast_topdesc1' => '使用播放器中的 Cast 按钮将“',
    'playwith_modal_gcast_topdesc2' => '”投送到 Google Cast 设备。',
    'directstreamtobrowserdropdown' => '打开音频源',

    // Content Protection Mechanism
    'cpm_info_title' => '内容保护机制（CPM）',
    'cpm_info_description' => 'PanPlay CPM 使用本地以及可选的中央过滤规则检查请求的 baseaudio URL。',
    'cpm_info_scope' => '只有 baseaudio 会被检查。被阻止的内容会在播放器界面加载前停止，并在错误页面中说明原因。',
    'cpm_info_local_status' => '本地 CPM',
    'cpm_info_local_list' => '本地过滤列表',
    'cpm_info_cdn_status' => '通过 CDN 的 CPM',
    'cpm_info_cache_status' => '中央列表缓存',
    'cpm_info_enabled' => '已启用',
    'cpm_info_disabled' => '已禁用',
    'cpm_info_available' => '可用',
    'cpm_info_unavailable' => '不可用',
    'cpm_info_last_sync' => '上次同步',
    'cpm_info_read_only' => '此信息为只读。CPM 设置和过滤列表由服务器运营者管理。',
    'cpm_info_more_information' => '了解有关 PanPlay CPM 的更多信息',

    // Network and playback errors
    'neterr_modal_title' => '播放错误',
    'neterr_desc_net_thinking' => '正在检查音频源…',
    'neterr_desc_net_okay1' => '<b>连接已恢复</b><hr>音频源已恢复访问。如果播放未自动继续，请重新加载播放器。',
    'neterr_desc_net_okay2' => '',
    'neterr_console_net_okay' => '音频源已恢复访问。',
    'neterr_desc_net_not_okay1' => '<b>音频源不可用</b><hr>无法访问请求的音频源。请检查互联网连接，并在网络切换后重新加载播放器。',
    'neterr_desc_net_not_okay2' => '',
    'neterr_console_net_not_okay' => '检查音频源时出错：',

    //PWF app shell (0.3.0.0 Fieldrush) -- added by Claude Code, see AI-HANDOFF.md
    'metadata_codec_label' => '编解码器',
    'settings_source_legend' => '音频源',
    'direct_audio_url_label' => '直接音频地址',
    'settings_cpm_managed_note' => '此设置由服务器管理员管理。',
    'settings_cpm_cdn_suffix' => '，中心列表已启用',
    'cover_alt_prefix' => '封面：',
);

?>
