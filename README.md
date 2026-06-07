# PanPlay

_Free HTML5-based audio player with laut.fm integration._

![PanPlay preview](https://github.com/PangomNet/PanPlay/assets/166552194/49a951d2-8cb7-4326-b9a2-da21999823fa)

PanPlay is a web player based on HTML5 audio playback. It can be used as a playback interface for laut.fm stations and for direct audio files or streams through the baseaudio extension. PanPlay includes a modular extension structure, multilingual UI files, cast.js support, browser compatibility checks, and a growing configuration layer for self-hosted instances.

PanPlay is open source and published under the MIT license. The project is still in public alpha, so the feature set is actively changing and some areas are still being rebuilt.

Find out more at [play.pangom.net](https://play.pangom.net/).

This project is tested with BrowserStack.

---

## Current Stable Alpha

The current stable alpha release is [PanPlay 0.1.0.1 Dandelion Build 1029](https://github.com/PangomNet/PanPlay/releases/tag/v0.1.0.1).

Dandelion replaces 0.1.0.0 Cactus as the default version on the CDN and is the latest version intended for production use.

- Use PanPlay via CDN: [play.pangom.net/app](https://play.pangom.net/app?lfmstream=simliveradio)
- Create a CDN link: [PanPlay Link Generator](https://play.pangom.net/create/)
- Read the CDN guide: [Use PanPlay via CDN](https://play.pangom.net/getpanplay/cdn/)
- Read the hosting guide: [How to host PanPlay](https://play.pangom.net/getpanplay/panplay-hosting/)
- Download the current self-hosted files: [Releases/0-1-0-1/1029](https://github.com/PangomNet/PanPlay/tree/main/Releases/0-1-0-1/1029)
- Read the release notes: [v0.1.0.1 release](https://github.com/PangomNet/PanPlay/releases/tag/v0.1.0.1)

## Public Test Build

The first visible test build for the Everlasting development cycle is Build 1030. It is available for public testing on the PanPlay CDN, but it is not a stable release and does not have a separate GitHub prerelease entry.

- Test Build 1030 via CDN: [play.pangom.net/app/_currentdevcandidate](https://play.pangom.net/app/_currentdevcandidate/?lfmstream=zwei)
- Browse the self-hosted test files: [Releases/0-1-0-2/1030](https://github.com/PangomNet/PanPlay/tree/main/Releases/0-1-0-2/1030)

The CDN test folder may lag behind the newest local development candidate. For the newest development state, use the GitHub `_currentdevcandidate` folder and host it yourself.

## Development Version

Active development continues in [`Releases/_currentdevcandidate`](https://github.com/PangomNet/PanPlay/tree/main/Releases/_currentdevcandidate).

The current development cycle is 0.1.1.0 Everlasting. Build 1030 is the first public test build, while `_currentdevcandidate` has moved on to Build 1031. This folder is a development candidate and should not be treated as a public stable release unless a release note explicitly says so.

## Requirements

Self-hosted PanPlay requires a PHP-capable web server. Dandelion is documented for PHP 7.0+.

The 2026 browser compatibility layer targets modern browser engines with ES2021+ and current security capabilities. The current baseline is Chrome 86+, Firefox 86+, Edge 91+, Safari 14+, Vivaldi 5+, and Opera 71+. Internet Explorer and legacy EdgeHTML are blocked server-side.

## CDN And Self-Hosting

PanPlay can be used in two ways:

- CDN mode: no installation is required. The CDN version is hosted by Pangom and is intended as the easiest way to use PanPlay.
- Self-hosted mode: download a release folder from this repository and host it on your own PHP-capable server.

The main CDN app follows the current supported build. The separate CDN test candidate may expose a development build for public testing and may not always match the newest `_currentdevcandidate` state on GitHub. Self-hosted installations do not update themselves. If a newer build is published inside a release folder, self-hosted users need to replace their local files manually.

Builds are small update packages between full GitHub releases. They may be added to the repository without getting their own GitHub Release entry.

## Documentation Status

The documentation is being updated, but it is not complete yet and some pages may lag behind the current code. The PanPlay website and the GitHub Wiki are both used for documentation, including CDN usage notes and setup information.

Useful starting points:

- [PanPlay website](https://play.pangom.net/)
- [PanPlay Wiki](https://github.com/PangomNet/PanPlay/wiki)
- [CDN guide](https://play.pangom.net/getpanplay/cdn/)
- [Hosting guide](https://play.pangom.net/getpanplay/panplay-hosting/)
- [All versions](https://play.pangom.net/version-all/)

## Repository Layout

- `Releases/`: published versions and builds.
- `Releases/_currentdevcandidate/`: current development candidate.
- `Sample Files/`: small sample audio files for testing playback.
- `Archive/`: historical oOPlay base package and old resources. This is kept as an optional code/resource collection and is not part of the active player release.
- `Branding/`: project branding resources.
- `Releases/Releasename-Schedule.md`: planned release names.

The old `Releases/Master-Changelog.md` is obsolete. Current release notes are kept in the active release folder, on [play.pangom.net](https://play.pangom.net/), and in GitHub releases.

## Highlights In 0.1.0.1 Dandelion

- Browser compatibility check updated for the 2026 Pangom browser support service at [browser.pangom.net](https://browser.pangom.net/).
- Compatibility failures now use the PanPlay Bluescreen interface with localized messages.
- New URL parameter `lgc=on` bypasses the server-side compatibility check for debugging.
- New URL parameter `lgc=netscape` forces the compatibility failure path for testing.
- Central instance configuration moved into `/data/storage.php`.
- `engine/config.php` is no longer part of the active initialization path.
- Debug mode, legal document source switches, extension credits, language behavior, and attribution data are now controlled from storage.
- Core PanPlay attribution is assembled from protected `pp_pro_*` values and checked through a SHA-256 integrity hash.
- Privacy and imprint documents can be linked remotely or served locally as escaped plain text.
- Laut.fm placeholder covers were removed; station logos are now used for cover and background imagery.

## Languages

PanPlay is developed mainly in Germany, while release notes and public project communication are written in English.

Current language files include:

- English
- German
- German variants for Austria and Switzerland
- Danish
- Spanish, including Argentina, Latin America, and Mexico variants
- French
- Hindi
- Italian
- Dutch and Belgian Dutch
- Simplified Chinese

Translations may be incomplete or uneven in quality. If you want to help with translations, please open an issue.

## Support And Issues

Report bugs and feature requests through [GitHub Issues](https://github.com/PangomNet/PanPlay/issues).

Older releases may remain available for download, but support follows the version lifecycle announced in release notes and on [play.pangom.net/version-all](https://play.pangom.net/version-all/).
