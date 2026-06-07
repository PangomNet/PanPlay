# PanPlay CPM Concept

This document is a working technical concept for the PanPlay Content Protection Mechanism (CPM).

CPM is planned for the baseaudio extension only. It is not intended for laut.fm streams because laut.fm playback already follows the laut.fm platform and API flow.

## Purpose

CPM is not DRM and it is not a real copy-protection system. It is a player-side/server-side protection layer for PanPlay instances. Its goal is to prevent PanPlay baseaudio from being used as a simple playback frontend for URLs that are known, reported, or locally marked as copyright-infringing or otherwise disallowed.

The system should:

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

CPM should be maintained through a filter-list style format inspired by adblocker lists, not through a simple table of exact URLs.

This keeps local and central lists easy to read, diff, review, sync, and edit manually.

PanPlay should implement a limited CPM-specific subset instead of trying to support the full Adblock Plus syntax.

### Proposed Rule Types

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
- Lines starting with `!@import` are PanPlay CPM import directives. Normal adblock parsers should ignore them as comments, but PanPlay CPM should fetch and merge the referenced list during CDN-list synchronization.

### Rule Priority

Exception rules should win over block rules.

Suggested order:

1. Normalize requested URL.
2. Check local exception rules.
3. Check CDN exception rules if CPM by CDN is enabled.
4. Check local block rules.
5. Check CDN block rules if CPM by CDN is enabled.
6. Block playback if a block rule matches and no exception matched first.

## URL Normalization

Before matching, URLs should be normalized so rules behave predictably.

Suggested normalization:

- trim whitespace
- decode obvious HTML entities if needed
- lowercase scheme and host
- remove default ports `:80` for HTTP and `:443` for HTTPS
- normalize duplicate slashes in path where safe
- remove URL fragments
- preserve query strings by default

Open decision:

- Query strings may contain tracking or signatures. CPM must decide whether rules match full query strings, stripped query strings, or both.

Suggested first implementation:

- Match against both:
  - full normalized URL
  - normalized URL without query string

This allows exact blocking where needed but keeps signed CDN URLs manageable.

## Local File Layout

Planned files in this folder:

```txt
data/cpm/README.md
data/cpm/filterlist.txt
data/cpm/local-filterlist.txt
data/cpm/cdn-cache-filterlist.txt
data/cpm/cdn-cache-meta.json
data/cpm/cdn-fetch.lock
data/cpm/cpm.log
```

Suggested meaning:

- `local-filterlist.txt`: local instance rules maintained by the server operator.
- `filterlist.txt`: template/source file for the central CPM list that can be uploaded to `https://play.pangom.net/cpm/filterlist.txt`.
- `cdn-cache-filterlist.txt`: cached copy of the central CPM by CDN list.
- `cdn-cache-meta.json`: cached list metadata such as last fetch time, ETag, Last-Modified, and source URL.
- `cdn-fetch.lock`: lock file used while refreshing the CDN cache.
- `cpm.log`: optional local debug/audit log for CPM decisions.

The first implementation can start with only `local-filterlist.txt`.

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

Important: CPM by CDN is not planned as a live URL-check service for every playback request.

The intended model is list synchronization:

1. The local PanPlay instance stores its own local filter list.
2. If `cfg_panplay_cpm_by_cdn` is enabled, the instance also keeps a cached copy of the central Pangom/PanPlay CPM filter list.
3. The playback URL is always checked locally against local rules and the cached CDN rules.
4. The local instance refreshes the cached CDN list only when the cache is too old according to the configured freshness policy.
5. If the CDN server cannot be reached, the local instance continues to use the cached CDN list if one exists.
6. If a URL was newly blocked on the CDN but a local instance has not synced yet, that local instance may still allow playback until its cache refreshes. This is acceptable for the planned CPM model.

This keeps normal playback checks local and avoids sending every user-provided playback URL to Pangom/PanPlay infrastructure.

The central list should be hosted under:

```txt
https://play.pangom.net/cpm/
```

This keeps the central CPM area separated from the player application and avoids special handling for the official PanPlay CDN instance. If CPM by CDN is enabled on the official CDN/player instance, it can use the same public list URL as every other PanPlay instance.

The first client-side implementation only needs to download/cache a text filter list from that location.

### Privacy Notice

CPM by CDN is privacy-relevant, but the list-sync model keeps it much less invasive than a live check service.

In the intended default flow, the local instance downloads the CDN filter list and checks user-provided URLs locally. The playback URL is not sent to Pangom/PanPlay during normal playback checks.

URLs are only sent to Pangom/PanPlay if a person explicitly submits a complaint through a contact form, email, or future central CPM page. That is outside the normal playback check.

### Possible CDN Resources

Draft CDN shape:

```txt
GET /cpm/filterlist.txt
GET /cpm/status.json
```

Possible responsibilities:

- `filterlist.txt`: download/sync the public central CPM filter list in text format.
- `status.json`: optional metadata such as list version, update timestamp, and suggested cache lifetime.

The first implementation should only use a downloaded list. A live `check` endpoint is not part of the current plan.

The `/cpm/` index page can be a normal information/contact page. It may later use WordPress or another website form so copyright owners can submit reports centrally.

## Cache Freshness

The local instance should not download the central list on every request.

Instead, it should use a cache with age checking, similar to feed/news cache scripts:

- keep the cached list in `data/cpm/cdn-cache-filterlist.txt`
- keep cache metadata in `data/cpm/cdn-cache-meta.json`
- check the cached list age before refreshing
- use a lock file during refresh so parallel requests do not all fetch the CDN list
- use the old cached list when refresh fails
- optionally use `ETag` and `Last-Modified` headers if the CDN provides them

Suggested files:

```txt
data/cpm/cdn-cache-filterlist.txt
data/cpm/cdn-cache-meta.json
data/cpm/cdn-fetch.lock
```

Suggested freshness policy:

- normal default: refresh after 6 hours
- faster development/debug mode: refresh after 15 minutes
- fallback: use stale cache if CDN is unavailable

The exact threshold can become a storage setting later.

## Full URL vs Hash

For normal CPM by CDN playback checks, this question is avoided by design: playback URLs are checked locally against the downloaded list, so they are not sent to the CDN service.

For explicit copyright complaints, the full URL may be sent by email or through the central `/cpm/` contact page because a human needs to understand what should be reviewed.

Suggested approach:

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

After CPM is implemented and tested, CPM by CDN should be enabled by default for new PanPlay builds.

Reason:

- it gives self-hosted operators a shared baseline without requiring them to maintain everything themselves
- it allows copyright complaints reported centrally through `play.pangom.net/cpm` to reach participating instances
- operators who want full independence can disable CPM by CDN and maintain only their local list

Until CPM is implemented, the runtime switches in `storage.php` may remain inactive to avoid advertising behavior that does not exist yet.

## Runtime Error Path

When CPM blocks playback, PanPlay should not show the normal offline/net-error modal.

Recommended behavior:

- stop before playback
- show a CPM-specific blocking message
- explain that the content was blocked by the instance policy
- do not accuse the user of wrongdoing
- include whether the match came from local CPM or CPM by CDN, if safe to reveal
- offer general help/documentation

Open decision:

- Use PanPlay Bluescreen for hard policy blocks.
- Or use a normal modal in the player UI.

Suggested first implementation:

- Use a dedicated CPM error page/modal for baseaudio.
- Keep Bluescreen for engine/core failures.

## Implementation Phases

### Phase 1: Local CPM Foundation

- create `data/cpm/local-filterlist.txt`
- implement URL normalization
- implement simple rule parser
- support comments, exact URL, domain, wildcard, and exception rules
- apply only in baseaudio mode
- block before player UI renders
- show CPM-specific error message

### Phase 2: Local Test/Debug Helper

- allow URL test against local rules
- show which rule matched
- show whether the match came from the local list or the cached CDN list
- add privacy notes for CDN list sync

### Phase 3: CDN List Sync

- define central list URL under `https://play.pangom.net/cpm/`
- download/cache central list locally
- add cache metadata and cache age checks
- use lock file during refresh
- continue with stale cache if refresh fails
- combine local and central rules
- expose list version/date in logs or debug helper
- fail gracefully if central sync is unavailable

### Phase 4: Central CPM Contact Page

- create an informational `/cpm/` page on play.pangom.net
- provide a contact/report form or clear contact instructions
- review accepted central complaints manually
- maintain the central filter list manually at first

### Phase 5: CDN List Service

- finish central CPM list hosting under `play.pangom.net/cpm`
- provide filter list metadata/status
- add moderation/review workflow outside PanPlay
- keep playback-time checks local unless a future reason requires otherwise

## Notes For Future Work

- CPM must not break normal baseaudio playback for valid URLs.
- CPM should be transparent enough for self-hosted operators to understand what is blocked.
- CPM by CDN must be opt-in.
- The first useful version should be local and simple.
- CPM by CDN should sync/cache central lists instead of performing live checks for every playback URL.
- The central service should not be rushed before local matching and cache workflows are stable.
