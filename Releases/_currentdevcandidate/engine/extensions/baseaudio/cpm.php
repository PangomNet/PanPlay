<?php

function panplayCpmPath(string $relativePath): string
{
    return __DIR__ . '/../../../' . ltrim($relativePath, '/');
}

function panplayCpmStartsWith(string $haystack, string $needle): bool
{
    return $needle === '' || strpos($haystack, $needle) === 0;
}

function panplayCpmEndsWith(string $haystack, string $needle): bool
{
    if ($needle === '') {
        return true;
    }

    return substr($haystack, -strlen($needle)) === $needle;
}

function panplayCpmContains(string $haystack, string $needle): bool
{
    return $needle === '' || strpos($haystack, $needle) !== false;
}

function panplayCpmNormalizeUrl(string $url): array
{
    $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $parts = parse_url($url);

    if (!is_array($parts) || empty($parts['scheme']) || empty($parts['host'])) {
        return [
            'valid' => false,
            'full' => $url,
            'without_query' => $url,
            'host' => '',
            'host_path' => '',
        ];
    }

    $scheme = strtolower($parts['scheme']);
    $host = strtolower($parts['host']);
    $port = isset($parts['port']) ? (int) $parts['port'] : null;
    $path = isset($parts['path']) && $parts['path'] !== '' ? $parts['path'] : '/';
    $query = isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '';

    $path = preg_replace('#/+#', '/', $path);
    $portString = '';
    if ($port !== null && !(($scheme === 'http' && $port === 80) || ($scheme === 'https' && $port === 443))) {
        $portString = ':' . $port;
    }

    $withoutQuery = $scheme . '://' . $host . $portString . $path;
    $full = $withoutQuery . $query;

    return [
        'valid' => true,
        'full' => $full,
        'without_query' => $withoutQuery,
        'host' => $host,
        'host_path' => $host . $path . $query,
        'host_path_without_query' => $host . $path,
    ];
}

function panplayCpmWildcardMatch(string $pattern, string $target): bool
{
    $pattern = str_replace('\^', '[^a-zA-Z0-9_.%-]?', preg_quote($pattern, '#'));
    $pattern = str_replace('\*', '.*', $pattern);
    return (bool) preg_match('#^' . $pattern . '$#i', $target);
}

function panplayCpmFetchRemote(string $url)
{
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'PanPlay-CPM/0.1 (+https://play.pangom.net/cpm/)',
        ]);
        $body = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($body !== false && $status >= 200 && $status < 300) ? $body : null;
    }

    $context = stream_context_create([
        'http' => [
            'timeout' => 15,
            'user_agent' => 'PanPlay-CPM/0.1 (+https://play.pangom.net/cpm/)',
        ],
    ]);
    $body = @file_get_contents($url, false, $context);

    return $body === false ? null : $body;
}

function panplayCpmReadLocalFile(string $path): string
{
    return is_file($path) ? (string) file_get_contents($path) : '';
}

function panplayCpmResolveImports(string $listContent, array &$seenImports = []): string
{
    $merged = [];
    $lines = preg_split("/\r\n|\n|\r/", $listContent);

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if (stripos($trimmed, '!@import ') === 0) {
            $importUrl = trim(substr($trimmed, 9));
            if ($importUrl !== '' && empty($seenImports[$importUrl])) {
                $seenImports[$importUrl] = true;
                $imported = panplayCpmFetchRemote($importUrl);
                if ($imported !== null) {
                    $merged[] = '! Imported by PanPlay CPM from ' . $importUrl;
                    $merged[] = panplayCpmResolveImports($imported, $seenImports);
                } else {
                    $merged[] = '! PanPlay CPM import failed: ' . $importUrl;
                }
            }
            continue;
        }

        $merged[] = $line;
    }

    return implode("\n", $merged);
}

function panplayCpmEnsureCdnCache(): string
{
    $cacheFile = panplayCpmPath('data/cpm/cdn-cache-filterlist.txt');
    $metaFile = panplayCpmPath('data/cpm/cdn-cache-meta.json');
    $lockFile = panplayCpmPath('data/cpm/cdn-fetch.lock');
    $sourceUrl = 'https://play.pangom.net/cpm/filterlist.txt';
    $maxAgeSeconds = 6 * 60 * 60;

    if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < $maxAgeSeconds) {
        return (string) file_get_contents($cacheFile);
    }

    $lockHandle = @fopen($lockFile, 'c');
    if ($lockHandle && !flock($lockHandle, LOCK_EX | LOCK_NB)) {
        if (is_file($cacheFile)) {
            return (string) file_get_contents($cacheFile);
        }
        return '';
    }

    $remote = panplayCpmFetchRemote($sourceUrl);
    if ($remote !== null) {
        $seenImports = [$sourceUrl => true];
        $merged = panplayCpmResolveImports($remote, $seenImports);
        file_put_contents($cacheFile, $merged);
        file_put_contents($metaFile, json_encode([
            'source_url' => $sourceUrl,
            'last_fetch' => date('c'),
            'imports' => array_keys($seenImports),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        if ($lockHandle) {
            flock($lockHandle, LOCK_UN);
            fclose($lockHandle);
        }
        return $merged;
    }

    if ($lockHandle) {
        flock($lockHandle, LOCK_UN);
        fclose($lockHandle);
    }

    return is_file($cacheFile) ? (string) file_get_contents($cacheFile) : '';
}

function panplayCpmParseRules(string $listContent, string $source): array
{
    $rules = [];
    $lines = preg_split("/\r\n|\n|\r/", $listContent);

    foreach ($lines as $lineNumber => $line) {
        $rule = trim($line);
        if ($rule === '' || $rule === '[Adblock Plus]' || $rule[0] === '!') {
            continue;
        }

        $exception = false;
        if (strpos($rule, '@@') === 0) {
            $exception = true;
            $rule = substr($rule, 2);
        }

        if (strpos($rule, '##') !== false || strpos($rule, '#@#') !== false || strpos($rule, '#$#') !== false) {
            continue;
        }

        $optionPos = strpos($rule, '$');
        if ($optionPos !== false) {
            $rule = substr($rule, 0, $optionPos);
        }

        $rule = trim($rule);
        if ($rule === '') {
            continue;
        }

        $rules[] = [
            'rule' => $rule,
            'exception' => $exception,
            'source' => $source,
            'line' => $lineNumber + 1,
        ];
    }

    return $rules;
}

function panplayCpmRuleMatches(array $rule, array $url): bool
{
    $pattern = $rule['rule'];

    if (strpos($pattern, '||') === 0) {
        $domainPattern = substr($pattern, 2);
        $domainPattern = rtrim($domainPattern, '^');
        $slashPos = strpos($domainPattern, '/');

        if ($slashPos === false) {
            $domain = strtolower($domainPattern);
            return $url['host'] === $domain || panplayCpmEndsWith($url['host'], '.' . $domain);
        }

        $domain = strtolower(substr($domainPattern, 0, $slashPos));
        $pathPattern = substr($domainPattern, $slashPos);
        $hostMatches = $url['host'] === $domain || panplayCpmEndsWith($url['host'], '.' . $domain);

        return $hostMatches && (
            panplayCpmWildcardMatch($domain . $pathPattern, $url['host_path']) ||
            panplayCpmWildcardMatch($domain . $pathPattern, $url['host_path_without_query'])
        );
    }

    if (panplayCpmStartsWith($pattern, 'http://') || panplayCpmStartsWith($pattern, 'https://')) {
        return panplayCpmWildcardMatch($pattern, $url['full']) ||
               panplayCpmWildcardMatch($pattern, $url['without_query']);
    }

    if (panplayCpmContains($pattern, '*')) {
        return panplayCpmWildcardMatch($pattern, $url['full']) ||
               panplayCpmWildcardMatch($pattern, $url['without_query']) ||
               panplayCpmWildcardMatch($pattern, $url['host_path']);
    }

    return stripos($url['full'], $pattern) !== false ||
           stripos($url['without_query'], $pattern) !== false;
}

function panplayCpmCheckUrl(string $url, bool $useCdn): array
{
    $normalized = panplayCpmNormalizeUrl($url);
    if (!$normalized['valid']) {
        return ['blocked' => false, 'reason' => 'invalid_url_for_cpm'];
    }

    $localRules = panplayCpmParseRules(
        panplayCpmReadLocalFile(panplayCpmPath('data/cpm/local-filterlist.txt')),
        'local'
    );
    $cdnRules = $useCdn ? panplayCpmParseRules(panplayCpmEnsureCdnCache(), 'cdn') : [];
    $rules = array_merge($localRules, $cdnRules);

    foreach ($rules as $rule) {
        if ($rule['exception'] && panplayCpmRuleMatches($rule, $normalized)) {
            return [
                'blocked' => false,
                'reason' => 'exception',
                'rule' => $rule,
                'normalized_url' => $normalized['full'],
            ];
        }
    }

    foreach ($rules as $rule) {
        if (!$rule['exception'] && panplayCpmRuleMatches($rule, $normalized)) {
            return [
                'blocked' => true,
                'reason' => 'blocked',
                'rule' => $rule,
                'normalized_url' => $normalized['full'],
            ];
        }
    }

    return [
        'blocked' => false,
        'reason' => 'no_match',
        'normalized_url' => $normalized['full'],
    ];
}

function panplayCpmEnforceBaseaudio(string $url)
{
    global $cfg_panplay_cpm, $cfg_panplay_cpm_by_cdn, $copyowner_url, $pro_eula_vendor_link, $lang;

    if (empty($cfg_panplay_cpm)) {
        return;
    }

    $result = panplayCpmCheckUrl($url, !empty($cfg_panplay_cpm_by_cdn));

    if (!empty($result['blocked'])) {
        $rule = $result['rule'];
        $ruleText = htmlspecialchars($rule['rule']);
        $source = htmlspecialchars($rule['source']);
        $cpmInfoUrl = !empty($cfg_panplay_cpm_by_cdn)
            ? 'https://play.pangom.net/cpm/'
            : (isset($copyowner_url) && $copyowner_url !== '' ? $copyowner_url : $pro_eula_vendor_link);
        $cpmText = function ($key, $fallback) use ($lang) {
            return isset($lang[$key]) ? $lang[$key] : $fallback;
        };

        $reason = $cpmText('cpm_block_headline', 'Content blocked by PanPlay CPM');
        $description =
            htmlspecialchars($cpmText('cpm_block_desc', 'The requested baseaudio URL is blocked by this PanPlay instance policy.')) .
            '<br><br><b>' . htmlspecialchars($cpmText('cpm_block_source', 'Matched rule source')) . ':</b> ' . $source .
            '<br><b>' . htmlspecialchars($cpmText('cpm_block_rule', 'Matched rule')) . ':</b> <code>' . $ruleText . '</code>' .
            '<br><br><a target="_blank" href="' . htmlspecialchars($cpmInfoUrl) . '">' . htmlspecialchars($cpmText('cpm_more_info', 'More information about this content policy')) . '</a>';

        bluescreen(
            403,
            $reason,
            $description
        );
    }
}
