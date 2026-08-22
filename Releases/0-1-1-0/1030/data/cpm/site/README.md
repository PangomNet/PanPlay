# PanPlay CPM public information site

This folder contains the standalone multilingual information site intended for:

```text
https://play.pangom.net/cpm/
```

## Deployment

Copy the contents of this folder into the existing server directory that already contains `filterlist.txt`.

Expected server layout:

```text
/cpm/index.php
/cpm/.htaccess
/cpm/assets/style.css
/cpm/lang/*.php
/cpm/filterlist.txt
```

The generated `panplay-cpm-site.zip` archive already uses this layout and can be extracted directly into `/cpm/` without containing an additional parent folder.

## Language behavior

The site supports the same public language codes as PanPlay through the `hl` query parameter and browser-language detection. Regional variants use the matching maintained base translation.

Examples:

```text
/cpm/?hl=en
/cpm/?hl=de-at
/cpm/?hl=es-mx
/cpm/?hl=zh-hans
```

## Important

- The public site is informational and does not edit CPM rules.
- `filterlist.txt` remains a separate public resource in the deployment directory.
- No playback URL is sent to this site during normal CPM checks.
- Keep all language files in literal UTF-8 and preserve their integrity headers.
