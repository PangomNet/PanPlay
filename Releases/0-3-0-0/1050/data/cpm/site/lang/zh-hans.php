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
$cpmSite = array(
    'meta_title' => 'PanPlay 内容保护机制',
    'meta_description' => '关于 PanPlay CPM、本地和中央过滤列表、隐私及服务器运营者责任的公开说明。',
    'language_label' => '语言',
    'language_apply' => '应用',
    'status_label' => '公开文档',
    'title' => 'PanPlay 内容保护机制',
    'lead' => '了解 PanPlay 如何检查直接音频网址、使用本地规则和可选的中央规则，并在不报告收听网址的情况下保护播放。',
    'current_title' => '中央列表已提供',
    'current_body' => '参与的 PanPlay 实例可以使用公开的 CPM 过滤列表。是否参与仍由各实例运营者自行配置。',
    'what_title' => 'CPM 是什么',
    'what_body' => 'CPM 是 PanPlay Baseaudio 扩展的过滤层，可在播放前阻止已知或在本地被禁止的直接音频网址。它既不是数字版权管理，也不是对网站、用户或文件作出的法律判断。',
    'geography_title' => '不包含地区规则',
    'why_title' => '为什么需要 CPM',
    'why_body' => 'CPM 为 PanPlay 实例运营者提供一种技术手段，用于响应权利人的通知、类似 DMCA 的下架请求，以及欧盟和其他司法管辖区的类似版权要求。它既不是上传过滤器，也不是主动打击盗版的行动；它只过滤通过 PanPlay 进行的播放和处理。',
    'effect_title' => '阻止会产生什么效果',
    'effect_body' => '规则匹配不会删除或扣押源文件，也不会使该文件无法通过其他方式访问。PanPlay 只会拒绝通过 Baseaudio 获取和播放它。检查不会向用户、权利人、托管服务商、主管机关或任何其他第三方发送警告或报告。',
    'geography_body' => '中央列表不会作出针对特定国家或地区的决定。如果运营者所在司法管辖区或自身政策需要不同规则，应关闭 CPM by CDN 并维护适合的本地列表。',
    'flow_title' => '播放检查的工作方式',
    'flow_1' => 'PanPlay 在 Baseaudio 模式下接收一个直接音频网址。',
    'flow_2' => '实例对网址进行规范化，以便稳定地匹配。',
    'flow_3' => 'PanPlay 服务器检查本地规则。',
    'flow_4' => '如果已启用，还会检查保存在本地缓存中的中央列表。',
    'flow_5' => '例外规则优先于阻止规则。剩余的匹配项会停止播放并显示中性的 403 错误。',
    'lists_title' => '规则和来源',
    'local_title' => '本地规则',
    'local_body' => '每个自行托管的实例都可以维护自己的规则。这些规则独立于中央列表，并始终由实例运营者控制。',
    'central_title' => 'CPM by CDN',
    'central_body' => '参与的实例会定期下载并缓存 PanPlay 公开列表。播放检查仍在本地完成，不会调用实时网址检查服务。',
    'exceptions_title' => '例外规则',
    'exceptions_body' => '以 @@ 开头的规则会明确允许匹配的地址，并优先于阻止规则。运营者可以借此修正范围过大的匹配。',
    'rules_title' => '过滤列表格式',
    'rules_intro' => 'CPM 使用有文档说明的类 Adblock 子集：注释、域名、精确网址、简单通配符、例外规则和 PanPlay 导入指令。',
    'rule_comment' => '注释',
    'privacy_title' => '隐私',
    'privacy_body' => '启用 CPM by CDN 时，PanPlay 下载列表并在本地实例上检查请求的网址。正常播放检查不会把收听网址发送给 Pangom。',
    'operator_title' => '自行托管的责任',
    'operator_body' => '实例运营者决定是否启用 CPM 和 CPM by CDN，并负责适当的本地规则、法律文件、联系信息以及遵守当地法律。',
    'complaints_title' => '更正和投诉',
    'complaints_body' => '如需处理本地阻止，请联系相应实例的运营者。面向共享列表的报告可以提交给 PanPlay，并会在修改中央规则前由人工审核。',
    'contact_link' => '联系 PanPlay',
    'limits_title' => '技术限制',
    'limits_body' => 'CPM 仅适用于 Baseaudio，不适用于 laut.fm 播放。它无法保证完全防止盗版，不执行地区限制，也不能保证已知所有被禁止的来源。',
    'resources_title' => '公开资源',
    'filterlist_link' => '打开中央过滤列表',
    'source_link' => '导入的反盗版来源',
    'repository_link' => 'PanPlay 源代码',
    'footer_note' => 'CPM 用于说明过滤决定，不能替代实例运营者进行的法律审查。',
);
