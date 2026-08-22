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
    'meta_title' => 'PanPlay Content Protection Mechanism',
    'meta_description' => 'Public information about PanPlay CPM, its local and central filter lists, privacy, and operator responsibilities.',
    'language_label' => 'Language',
    'language_apply' => 'Apply',
    'status_label' => 'Public documentation',
    'title' => 'PanPlay Content Protection Mechanism',
    'lead' => 'How PanPlay checks direct audio URLs, uses local and optional central rules, and protects playback without reporting listening URLs.',
    'current_title' => 'Central list available',
    'current_body' => 'The public CPM filter list can be used by participating PanPlay instances. Participation remains configurable by each operator.',
    'what_title' => 'What CPM is',
    'what_body' => 'CPM is a filtering layer for the PanPlay Baseaudio extension. It can stop known or locally prohibited direct audio URLs before playback begins. It is neither DRM nor a legal verdict about a website, a user, or a file.',
    'geography_title' => 'No geographic rules',
    'why_title' => 'Why CPM exists',
    'why_body' => 'CPM gives PanPlay instance operators a technical way to respond to rights-holder notices, DMCA-style takedown requests, and comparable copyright requirements in the EU and other jurisdictions. It is neither an upload filter nor an active campaign against piracy; it filters playback and processing through PanPlay.',
    'effect_title' => 'What a block does',
    'effect_body' => 'A match does not delete, seize, or otherwise make the source file inaccessible. PanPlay only refuses to fetch and play it through Baseaudio. The check sends no warning or report to the user, rights holder, hosting provider, authority, or any other third party.',
    'geography_body' => 'The central list does not apply country-specific decisions. An operator whose jurisdiction or policy requires different rules should disable CPM by CDN and maintain an appropriate local list.',
    'flow_title' => 'How a playback check works',
    'flow_1' => 'PanPlay receives a direct audio URL in Baseaudio mode.',
    'flow_2' => 'The instance normalizes the URL for predictable matching.',
    'flow_3' => 'Local rules are checked on the PanPlay server.',
    'flow_4' => 'If enabled, the locally cached central list is checked as well.',
    'flow_5' => 'Exceptions override blocks. A remaining match stops playback and displays a neutral 403 error.',
    'lists_title' => 'Rules and sources',
    'local_title' => 'Local rules',
    'local_body' => 'Every self-hosted instance can maintain its own rules. They apply independently of the central list and remain under the operator’s control.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Participating instances periodically download and cache the public PanPlay list. Playback checks still happen locally and do not call a live URL-checking service.',
    'exceptions_title' => 'Exceptions',
    'exceptions_body' => 'Rules beginning with @@ explicitly allow a matching address and take priority over blocking rules. Operators can use them to correct overly broad matches.',
    'rules_title' => 'Filter-list format',
    'rules_intro' => 'CPM uses a documented Adblock-style subset: comments, domains, exact URLs, simple wildcards, exceptions, and PanPlay import directives.',
    'rule_comment' => 'Comment',
    'privacy_title' => 'Privacy',
    'privacy_body' => 'With CPM by CDN, PanPlay downloads a list and evaluates the requested URL on the local instance. The listening URL is not sent to Pangom during normal playback checks.',
    'operator_title' => 'Self-hosting responsibility',
    'operator_body' => 'The instance operator decides whether CPM and CPM by CDN are enabled and is responsible for suitable local rules, legal documents, contact details, and compliance with local law.',
    'complaints_title' => 'Corrections and complaints',
    'complaints_body' => 'Contact the relevant instance operator for a local block. Reports intended for the shared list can be submitted to PanPlay and are reviewed manually before a central rule is changed.',
    'contact_link' => 'Contact PanPlay',
    'limits_title' => 'Technical limits',
    'limits_body' => 'CPM applies only to Baseaudio, not to laut.fm playback. It offers no complete piracy prevention, no geographic enforcement, and no guarantee that every prohibited source is known.',
    'resources_title' => 'Public resources',
    'filterlist_link' => 'Open the central filter list',
    'source_link' => 'Imported anti-piracy source',
    'repository_link' => 'PanPlay source code',
    'footer_note' => 'CPM documents filtering decisions; it does not replace legal review by an instance operator.',
);
