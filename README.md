# PanPlay

_Free HTML5-based audio player with laut.fm integration._

![PanPlay preview](https://github.com/PangomNet/PanPlay/assets/166552194/49a951d2-8cb7-4326-b9a2-da21999823fa)

PanPlay is a web player based on HTML5 audio playback. It can be used as a playback interface for laut.fm stations and for direct audio files or streams through the baseaudio extension. PanPlay includes a modular extension structure, multilingual UI files, cast.js support, browser compatibility checks, and a growing configuration layer for self-hosted instances.

PanPlay is open source and published under the MIT license. The current generation remains a public beta, with Everlasting serving as its supported long-term release while the next interface generation is developed.

Find out more at [play.pangom.net](https://play.pangom.net/).

This project is tested with BrowserStack.

---

## Current Stable Beta

The current stable beta release is [PanPlay 0.1.1.0 Everlasting Build 1030](https://github.com/PangomNet/PanPlay/releases/tag/v0.1.1.0).

Everlasting is the final release based on the long-running Bootstrap interface. It is intended as a dependable long-term baseline that can remain supported while the next PanPlay generation is developed.

- Use PanPlay via CDN: [play.pangom.net/app](https://play.pangom.net/app?lfmstream=simliveradio)
- Create a CDN link: [PanPlay Link Generator](https://play.pangom.net/create/)
- Read the CDN guide: [Use PanPlay via CDN](https://play.pangom.net/getpanplay/cdn/)
- Read the hosting guide: [How to host PanPlay](https://play.pangom.net/getpanplay/panplay-hosting/)
- Download the current self-hosted files: [Releases/0-1-1-0/1030](https://github.com/PangomNet/PanPlay/tree/main/Releases/0-1-1-0/1030)
- Read the release notes: [v0.1.1.0 release](https://github.com/PangomNet/PanPlay/releases/tag/v0.1.1.0)

## Development Version

Active development continues in [`Releases/_currentdevcandidate`](https://github.com/PangomNet/PanPlay/tree/main/Releases/_currentdevcandidate).

At the Everlasting release point, `_currentdevcandidate` may temporarily mirror Build 1030. It can diverge again when maintenance work or development of the successor generation begins. Published releases remain in their numbered release folders.

## Requirements

Self-hosted PanPlay requires a PHP-capable web server. Everlasting requires PHP 7.0+.

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

## Highlights In 0.1.1.0 Everlasting

- Final and feature-frozen release of the Bootstrap-based PanPlay interface, maintained as a long-term beta alongside development of the successor generation.
- Eleven selectable legacy-interface themes, including the rebuilt Liquid Glass theme and the new Aqua, Windows XP Luna, and Deepin themes, plus extensive Aero, Windows 9x, Cosmo, Light, laut.fm, and accessibility fixes.
- Rebuilt baseaudio interface with getID3 metadata, embedded artwork, safe remote analysis, browser Media Session metadata, and improved Google Cast metadata.
- PanPlay Content Protection Mechanism for baseaudio with local filter lists, optional privacy-preserving CPM by CDN list synchronization, caching, exceptions, localized blocking messages, and public documentation.
- Connected settings interface for language, theme, active-extension options, and URL/session parameters without exposing server administration to player users.
- Repaired and verified literal UTF-8 language resources across the core, laut.fm, and baseaudio surfaces, including regional variants.
- Expandable laut.fm programme descriptions, preserved API playlist colors, current-programme highlighting, and direct navigation from the main player to the running schedule entry.
- More reliable network-error dialogs, localized Bluescreens and fatal error paths, optional Cast initialization, browser compatibility handling, legal-document source controls, and central instance configuration through `data/storage.php`.

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
