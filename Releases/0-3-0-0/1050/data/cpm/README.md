# PanPlay CPM

This document describes the PanPlay Content Protection Mechanism (CPM) implemented for Everlasting Build 1030.

CPM applies to the baseaudio extension only. It is not used for laut.fm streams because laut.fm playback already follows the laut.fm platform and API flow.

## Purpose

CPM is not DRM and it is not a real copy-protection system. It is a player-side/server-side protection layer for PanPlay instances. Its goal is to prevent PanPlay baseaudio from being used as a simple playback frontend for URLs that are known, reported, or locally marked as copyright-infringing or otherwise disallowed.

The system:

- block known disallowed direct audio URLs before playback starts
- support local self-hosted instance rules
- optionally support a central Pangom/PanPlay CPM list through CPM by CDN
- allow instance operators to maintain their own rules through simple text filter lists
- allow copyright complaints to be handled through the operator contact address or the central PanPlay CPM contact page
- keep the system transparent and documented
- avoid pretending to provide complete legal or technical protection

## Basic Flow

1. A user opens PanPlay with a baseaudio URL, for example `?webstream=https://example.com/audio.mp3`.
2. PanPlay detects baseaudio mode.
3. If `cfg_panplay_cpm` is enabled, PanPlay normalizes the requested URL.
4. PanPlay checks local CPM rules.
5. If `cfg_panplay_cpm_by_cdn` is enabled, PanPlay also checks/syncs the central CPM rules.
6. If a blocking rule matches and no exception rule applies, playback is stopped before the audio source is exposed to the player UI.
7. PanPlay shows a dedicated CPM error message explaining that the requested content is blocked by the instance policy.

## Filter List Model

CPM is maintained through a filter-list style format inspired by adblocker lists, not through a simple table of exact URLs.

This keeps local and central lists easy to read, diff, review, sync, and edit manually.

PanPlay implements a limited CPM-specific subset instead of trying to support the full Adblock Plus syntax.

### Supported Rule Types

```txt
! Comment line

||example.com^
||example.com/path/*
https://example.com/audio/file.mp3
*leaked-album*
@@||example.com/allowed-file.mp3
!@import https://example.com/filterlist.txt
```

Meaning:

- Lines starting with `!` are comments.
- Empty lines are ignored.
- `||example.com^` blocks a full domain.
- `||example.com/path/*` blocks a domain/path pattern.
- A full `http://` or `https://` URL blocks that exact normalized URL.
- `*keyword*` supports simple wildcard matching.
- Lines starting with `@@` are exception rules and override matching block rules.
- Lines starting with `!@import` are PanPlay CPM import directives. Normal adblock parsers ignore them as comments; PanPlay CPM fetches and merges the referenced list during CDN-list synchronization.

### Rule Priority

Exception rules win over block rules.

Implemented order:

1. Normalize requested URL.
2. Check local exception rules.
3. Check CDN exception rules if CPM by CDN is enabled.
4. Check local block rules.
5. Check CDN block rules if CPM by CDN is enabled.
6. Block playback if a block rule matches and no exception matched first.

## URL Normalization

Before matching, URLs are normalized so rules behave predictably.

Implemented normalization:

- trim whitespace
- decode obvious HTML entities if needed
- lowercase scheme and host
- remove default ports `:80` for HTTP and `:443` for HTTPS
- normalize duplicate slashes in path where safe
- remove URL fragments
- preserve query strings by default

### Query Strings

- Query strings may contain tracking values or signatures. CPM matches against both:
  - full normalized URL
  - normalized URL without query string

This allows exact blocking where needed but keeps signed CDN URLs manageable.

## Local File Layout

Files used in this folder:

```txt
data/cpm/README.md
data/cpm/filterlist.txt
data/cpm/local-filterlist.txt
data/cpm/cdn-cache-filterlist.txt
data/cpm/cdn-cache-meta.json
data/cpm/cdn-fetch.lock
data/cpm/site/
data/cpm/panplay-cpm-site.zip
```

Meaning:

- `local-filterlist.txt`: local instance rules maintained by the server operator.
- `filterlist.txt`: template/source file for the central CPM list that can be uploaded to `https://play.pangom.net/cpm/filterlist.txt`.
- `cdn-cache-filterlist.txt`: cached copy of the central CPM by CDN list.
- `cdn-cache-meta.json`: cached list metadata containing the source URL, last successful fetch time, and resolved imports.
- `cdn-fetch.lock`: lock file used while refreshing the CDN cache.
- `site/`: source of the standalone multilingual public CPM information site.
- `panplay-cpm-site.zip`: upload-ready archive of the public information site.

## Local Filter List Example

```txt
! PanPlay CPM local filter list
! This list is maintained by the local PanPlay instance operator.

||example-piracy-site.test^
||cdn.example.test/leaks/*
https://example.test/files/blocked-track.mp3
*unreleased-album-name*

! Exception: this file was cleared by the operator.
@@https://example.test/files/cleared-demo.mp3
```

## CPM by CDN

CPM by CDN means that PanPlay uses a central Pangom/PanPlay list in addition to local rules.

Important: CPM by CDN is not a live URL-check service for every playback request.

The intended model is list synchronization:

1. The local PanPlay instance stores its own local filter list.
2. If `cfg_panplay_cpm_by_cdn` is enabled, the instance also keeps a cached copy of the central Pangom/PanPlay CPM filter list.
3. The playback URL is always checked locally against local rules and the cached CDN rules.
4. The local instance refreshes the cached CDN list only when the cache is too old according to the configured freshness policy.
5. If the CDN server cannot be reached, the local instance continues to use the cached CDN list if one exists.
6. If a URL was newly blocked on the CDN but a local instance has not synced yet, that local instance may still allow playback until its cache refreshes. This is acceptable for the CPM list-sync model.

This keeps normal playback checks local and avoids sending every user-provided playback URL to Pangom/PanPlay infrastructure.

The central list and information site are hosted under:

```txt
https://play.pangom.net/cpm/
```

This keeps the central CPM area separated from the player application and avoids special handling for the official PanPlay CDN instance. If CPM by CDN is enabled on the official CDN/player instance, it can use the same public list URL as every other PanPlay instance.

The player downloads and caches the text filter list from that location.

### Privacy Notice

CPM by CDN is privacy-relevant, but the list-sync model keeps it much less invasive than a live check service.

In the intended default flow, the local instance downloads the CDN filter list and checks user-provided URLs locally. The playback URL is not sent to Pangom/PanPlay during normal playback checks.

URLs are only sent to Pangom/PanPlay if a person explicitly submits a complaint through the contact route on the central CPM page or by email. That is outside the normal playback check.

### CDN Resources

Current public resource:

```txt
GET /cpm/filterlist.txt
```

- `filterlist.txt`: download/sync the public central CPM filter list in text format.
- No live `check` endpoint exists. Playback checks remain local.

The standalone multilingual `/cpm/` information site is provided in `data/cpm/site/` and as the upload-ready `data/cpm/panplay-cpm-site.zip` archive. It explains the system, links the public list, and directs copyright complaints to the central contact route without requiring WordPress or a framework.

## Cache Freshness

The local instance should not download the central list on every request.

Instead, it should use a cache with age checking, similar to feed/news cache scripts:

- keep the cached list in `data/cpm/cdn-cache-filterlist.txt`
- keep cache metadata in `data/cpm/cdn-cache-meta.json`
- check the cached list age before refreshing
- use a lock file during refresh so parallel requests do not all fetch the CDN list
- use the old cached list when refresh fails

Cache files:

```txt
data/cpm/cdn-cache-filterlist.txt
data/cpm/cdn-cache-meta.json
data/cpm/cdn-fetch.lock
```

Implemented freshness policy:

- normal default: refresh after 6 hours
- fallback: use stale cache if CDN is unavailable

The six-hour threshold is currently defined in the CPM interpreter and can become a storage setting in a later release if operators need it.

## Full URL vs Hash

For normal CPM by CDN playback checks, this question is avoided by design: playback URLs are checked locally against the downloaded list, so they are not sent to the CDN service.

For explicit copyright complaints, the full URL may be sent by email or through the central `/cpm/` contact page because a human needs to understand what should be reviewed.

Implemented approach:

1. Local CPM: full URL processing stays on the local instance.
2. CDN filter list sync: PanPlay downloads a central list and still checks locally.
3. Complaints/reports are handled outside the player through the operator contact address or the central `/cpm/` page.

This keeps the first useful CPM implementation simple and avoids sending every playback URL to Pangom/PanPlay.

## Operator Workflow

CPM should stay simple for self-hosted operators.

Local rule maintenance should primarily happen through text filter lists. Operators who want full local control can edit these files directly, similar to maintaining an adblock-style filter list.

No local admin panel is required for the first CPM implementation.

Practical workflow:

1. A copyright owner contacts the server operator through the contact address shown in the PanPlay About dialog.
2. The server operator reviews the complaint.
3. If the complaint is valid for that instance only, the operator adds a rule to `data/cpm/local-filterlist.txt`.
4. If the complaint should apply to all participating PanPlay instances, the operator can also submit it through `https://play.pangom.net/cpm/`.
5. Pangom/PanPlay reviews central complaints and, if accepted, adds the rule to the central `filterlist.txt`.
6. Instances with CPM by CDN enabled receive the block when their cache refreshes.

Optional helper tools can be added later, for example a URL test/debug page that shows which local or CDN rule matched. This is useful for development and support, but not required for basic CPM operation.

## Default Behavior

CPM and CPM by CDN are enabled by default for new PanPlay builds.

Reason:

- it gives self-hosted operators a shared baseline without requiring them to maintain everything themselves
- it allows copyright complaints reported centrally through `play.pangom.net/cpm` to reach participating instances
- operators who want full independence, or whose jurisdiction requires different rules, can disable CPM by CDN and maintain only their local list
- CPM does not apply rules by country; geographic policy remains the responsibility of each self-hosted instance operator

## Runtime Error Path

When CPM blocks playback, PanPlay should not show the normal offline/net-error modal.

Current behavior:

- stop before playback
- show a CPM-specific blocking message
- explain that the content was blocked by the instance policy
- do not accuse the user of wrongdoing
- include whether the match came from local CPM or CPM by CDN
- offer general help/documentation
- use the shared PanPlay Bluescreen so fatal errors continue to have one maintainable interface

## Implementation Status

### Completed: Local CPM Foundation

- create `data/cpm/local-filterlist.txt`
- implement URL normalization
- implement simple rule parser
- support comments, exact URL, domain, wildcard, and exception rules
- apply only in baseaudio mode
- block before player UI renders
- show CPM-specific error message

### Completed: Read-only Player Information

- show whether local CPM and CPM by CDN are enabled
- show local-list and central-cache availability
- show the latest known cache synchronization time
- link to the operator site or the central CPM information page
- keep server configuration and list editing outside the public player settings

### Completed: CDN List Sync

- define central list URL under `https://play.pangom.net/cpm/`
- download/cache central list locally
- add cache metadata and cache age checks
- use lock file during refresh
- continue with stale cache if refresh fails
- combine local and central rules
- expose list version/date in logs or debug helper
- fail gracefully if central sync is unavailable

### Completed: Central CPM Information Site Package

- multilingual standalone site in `data/cpm/site/`
- upload-ready archive in `data/cpm/panplay-cpm-site.zip`
- language selection, contact guidance, privacy explanation, operator responsibility, rule examples, and source attribution
- central complaints and accepted central rules remain manually reviewed

### Completed: CDN List Service Foundation

- finish central CPM list hosting under `play.pangom.net/cpm`
- provide filter list metadata/status
- keep moderation and review outside PanPlay
- keep playback-time checks local unless a future reason requires otherwise

## Notes For Future Work

- CPM must not break normal baseaudio playback for valid URLs.
- CPM should be transparent enough for self-hosted operators to understand what is blocked.
- CPM by CDN is enabled by default and can be disabled by self-hosted operators.
- Local rules remain available independently of the central list.
- CPM by CDN should sync/cache central lists instead of performing live checks for every playback URL.
- A future URL test/debug helper may display the exact matching rule, but it is not required for normal operation.
