<?php
session_start();

// JSON-Datenbankdatei für Hashes und Sender-Defaults
$dbFile = __DIR__ . '/links.json';

function loadLinks($file) {
    if (!file_exists($file)) return ['hashes' => [], 'defaults' => []];
    $data = @file_get_contents($file);
    if (!$data) return ['hashes' => [], 'defaults' => []];
    $decoded = json_decode($data, true);
    return is_array($decoded) ? $decoded : ['hashes' => [], 'defaults' => []];
}

function saveLinks($file, $data) {
    @file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Erkennt gängige Social-/Messenger-Crawler, die Link-Vorschauen bauen
// (Facebook, WhatsApp, Telegram, Slack, Discord, Twitter/X, LinkedIn, Skype, Pinterest, Reddit, Apple)
function isSocialCrawler() {
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if ($ua === '') return false;
    $bots = [
        'facebookexternalhit', 'Facebot', 'WhatsApp', 'Twitterbot', 'TelegramBot',
        'Slackbot', 'LinkedInBot', 'Discordbot', 'Pinterest', 'redditbot',
        'SkypeUriPreview', 'vkShare', 'Applebot', 'Google-InspectionTool',
        'Iframely', 'Embedly', 'W3C_Validator'
    ];
    foreach ($bots as $bot) {
        if (stripos($ua, $bot) !== false) return true;
    }
    return false;
}

// Holt Sender-/Songinfos von der laut.fm API für die OG-Vorschau
// (fällt bei jedem Problem einfach auf Stationsname/Standardtext zurück)
function fetchStationPreview($station) {
    $preview = [
        'title' => $station,
        'description' => 'Jetzt live anhören auf PanPlay',
        'image' => ''
    ];
    $ch = curl_init("https://api.laut.fm/stations/" . rawurlencode($station));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    $resp = curl_exec($ch);
    curl_close($ch);

    if (!$resp) return $preview;
    $info = json_decode($resp, true);
    if (!is_array($info)) return $preview;

    if (!empty($info['name'])) {
        $preview['title'] = $info['name'];
    }
    if (!empty($info['description'])) {
        $preview['description'] = $info['description'];
    }
    if (!empty($info['current_song'])) {
        $song = $info['current_song'];
        $artistName = $song['artist']['name'] ?? '';
        $songTitle = $song['title'] ?? '';
        if ($artistName || $songTitle) {
            $preview['description'] = trim("Läuft gerade: $artistName - $songTitle", ' -');
        }
        if (!empty($song['artist']['image'])) {
            $preview['image'] = $song['artist']['image'];
        }
    }
    return $preview;
}

// Den von der .htaccess übergebenen Pfad auslesen
$path = $_GET['path'] ?? '';
$segments = $path !== '' ? explode('/', trim($path, '/')) : [];
$station = !empty($segments[0]) ? trim($segments[0]) : '';
$subAction = !empty($segments[1]) ? trim($segments[1]) : '';

$queryParams = $_GET;
unset($queryParams['path']);

// -------------------------------------------------------------------------
// LAUT.FM ADMIN API LOGIN (Beispiel-Endpoint / Logik)
// -------------------------------------------------------------------------
$db = loadLinks($dbFile);
$loginError = '';

if (isset($_POST['laut_login'])) {
    $apiUser = trim($_POST['api_user'] ?? '');
    $apiPass = trim($_POST['api_pass'] ?? '');

    // Laut.fm API Authentifizierung prüfen 
    // (Laut.fm bietet hierfür Standard-HTTP-Basic-Auth oder Stations-Token an der API an)
    $ch = curl_init("https://api.laut.fm/stations/" . $apiUser);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $stationData = json_decode($response, true);
        $_SESSION['station'] = $stationData['name'] ?? $apiUser;
        header("Location: https://l.gehjetzt.de/"); // Zurück zum Dashboard (Root der Subdomain)
        exit;
    } else {
        $loginError = "Invalid Laut.fm credentials or station not found.";
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['station']);
    header("Location: https://l.gehjetzt.de/");
    exit;
}

// -------------------------------------------------------------------------
// REDIRECT MODE (If a station name was provided in the path)
// -------------------------------------------------------------------------
if ($station !== '' && $station !== 'index.php') {
    $targetBase = "https://play.pangom.net/app/";
    $paramsToUse = [];
    $version = '';

    // Prüfen, ob ein Hash übergeben wurde (/l/station/hash)
    if ($subAction !== '' && isset($db['hashes'][$station][$subAction])) {
        $savedData = $db['hashes'][$station][$subAction];
        $version = $savedData['version'] ?? '';
        $paramsToUse = $savedData['params'] ?? [];
    } else {
        // Kein Hash: Prüfen, ob der Sender einen "Default-Link" hinterlegt hat!
        if (isset($db['defaults'][$station])) {
            $defaultData = $db['defaults'][$station];
            $version = $defaultData['version'] ?? '';
            $paramsToUse = $defaultData['params'] ?? [];
        } else {
            // Fallback: Direkte URL Parameter nutzen
            $version = $queryParams['version'] ?? '';
            unset($queryParams['version']);
            $paramsToUse = $queryParams;
        }
    }

    if (!empty($version)) {
        $targetBase .= $version . "/";
    }

    $paramsToUse['lfmstream'] = $station;
    $targetUrl = $targetBase . "?" . http_build_query($paramsToUse);

    // Social-/Messenger-Crawler bekommen eine HTML-Seite mit OG-Tags statt eines
    // reinen Redirects, damit Facebook/WhatsApp/Telegram & Co. eine hübsche
    // Linkvorschau (Titel, Songinfo, Bild) bauen können. Echte Besucher springen
    // stattdessen sofort per 302 weiter.
    if (isSocialCrawler()) {
        $preview = fetchStationPreview($station);
        $canonicalUrl = "https://l.gehjetzt.de/" . ltrim($path, '/');
        header('Content-Type: text/html; charset=utf-8');
        ?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($preview['title']) ?> · PanPlay</title>
<meta property="og:type" content="music.radio_station">
<meta property="og:site_name" content="PanPlay">
<meta property="og:title" content="<?= htmlspecialchars($preview['title']) ?>">
<meta property="og:description" content="<?= htmlspecialchars($preview['description']) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
<?php if (!empty($preview['image'])): ?>
<meta property="og:image" content="<?= htmlspecialchars($preview['image']) ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta http-equiv="refresh" content="0; url=<?= htmlspecialchars($targetUrl) ?>">
</head>
<body>
<p><?= htmlspecialchars($preview['title']) ?> – <a href="<?= htmlspecialchars($targetUrl) ?>">hier klicken, falls die Weiterleitung nicht automatisch startet</a>.</p>
</body>
</html>
<?php
        exit;
    }

    header("Location: $targetUrl", true, 302);
    exit;
}

// -------------------------------------------------------------------------
// ACTIONS (Delete Hash or Save Default via Dashboard)
// -------------------------------------------------------------------------
if (isset($_SESSION['station'])) {
    $loggedStation = $_SESSION['station'];

    // Hash löschen
    if (isset($_GET['delete_hash'])) {
        $hashToDelete = $_GET['delete_hash'];
        if (isset($db['hashes'][$loggedStation][$hashToDelete])) {
            unset($db['hashes'][$loggedStation][$hashToDelete]);
            saveLinks($dbFile, $db);
        }
        header("Location: https://l.gehjetzt.de/");
        exit;
    }

    // Standard-Link (Default) speichern
    if (isset($_POST['save_default'])) {
        $defParams = [];
        $allowedKeys = ['version', 'theme', 'nolfmw', 'schedule', 'stationinfo', 'playwith', 'trackhistory', 'currentsongmodal', 'lbn', 'stationaccent', 'hl'];
        foreach ($allowedKeys as $key) {
            if (!empty($_POST[$key])) {
                $defParams[$key] = $_POST[$key];
            }
        }
        $defVersion = $defParams['version'] ?? '';
        unset($defParams['version']);

        $db['defaults'][$loggedStation] = [
            'version' => $defVersion,
            'params' => $defParams
        ];
        saveLinks($dbFile, $db);
        header("Location: https://l.gehjetzt.de/");
        exit;
    }
}

// -------------------------------------------------------------------------
// GENERATOR UI
// -------------------------------------------------------------------------
$inputStation = $_POST['station'] ?? ($_SESSION['station'] ?? '');
$shortLink = '';
$longLink = '';
$useHash = isset($_POST['use_hash']);

if (!empty($inputStation) && !isset($_POST['laut_login'])) {
    $params = [];
    $allowedKeys = ['version', 'theme', 'nolfmw', 'schedule', 'stationinfo', 'playwith', 'trackhistory', 'currentsongmodal', 'lbn', 'stationaccent', 'hl'];
    
    foreach ($allowedKeys as $key) {
        if (!empty($_POST[$key])) {
            $params[$key] = $_POST[$key];
        }
    }
    
    $version = '';
    if (!empty($params['version'])) {
        $version = $params['version'];
        $targetVersion = $version . '/';
        unset($params['version']);
    } else {
        $targetVersion = '';
    }

    $cleanStation = trim($inputStation);
    $targetParams = array_merge(['lfmstream' => $cleanStation], $params);
    if (!empty($version)) {
        $targetParams['version'] = $version;
    }
    
    $longLink = "https://l.gehjetzt.de/" . urlencode($cleanStation) . (!empty($params) || !empty($version) ? '?' . http_build_query($targetParams) : '');

    if ($useHash) {
        if (!isset($db['hashes'][$cleanStation])) {
            $db['hashes'][$cleanStation] = [];
        }

        $existingHash = false;
        foreach ($db['hashes'][$cleanStation] as $savedHash => $savedData) {
            if (($savedData['version'] ?? '') === $version && ($savedData['params'] ?? []) === $params) {
                $existingHash = $savedHash;
                break;
            }
        }

        if ($existingHash === false) {
            $hashData = $cleanStation . json_encode($params) . $version;
            $existingHash = substr(md5($hashData), 0, 5);
            
            $db['hashes'][$cleanStation][$existingHash] = [
                'version' => $version,
                'params' => $params
            ];
            saveLinks($dbFile, $db);
        }

        $shortLink = "https://l.gehjetzt.de/" . urlencode($cleanStation) . "/" . $existingHash;
    }

    $targetUrlDisplay = "https://play.pangom.net/app/" . $targetVersion . "?" . http_build_query(array_merge(['lfmstream' => $cleanStation], $params));
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PanPlay Shortener & Station Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <style>
        body { font-family: "Readex Pro", sans-serif; background: #161616; color: #F4F4F4; max-width: 800px; margin: 40px auto; padding: 20px; line-height: 1.6; }
        h1 { color: #FBFBFB; font-size: 1.8rem; border-bottom: 2px solid #F94E41; padding-bottom: 10px; margin-bottom: 20px; }
        h2 { font-size: 1.2rem; color: #F94E41; margin-top: 25px; }
        label { display: block; margin-top: 15px; font-size: 0.9rem; color: #ccc; font-weight: 600; }
        input[type="text"], input[type="password"], select { width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #fff; margin-top: 5px; border-radius: 4px; box-sizing: border-box; }
        .row { display: flex; gap: 15px; }
        .row > div { flex: 1; }
        .checkbox-group { margin-top: 10px; background: rgba(255,255,255,0.05); padding: 15px; border-radius: 4px; }
        .form-check { margin-top: 8px; display: flex; align-items: center; gap: 10px; }
        .form-check input { width: auto; }
        button, .btn { background: #F94E41; color: #FBFBFB; border: none; padding: 12px 20px; font-weight: bold; cursor: pointer; margin-top: 25px; border-radius: 4px; font-size: 1rem; text-decoration: none; display: inline-block; text-align: center; }
        button:hover, .btn:hover { background: #e03c31; }
        .btn-danger { background: #b71c1c; }
        .btn-danger:hover { background: #7f0000; }
        .result { background: #111; border: 1px solid #333; padding: 20px; margin-top: 30px; border-radius: 4px; word-break: break-all; }
        .result code { color: #7bdcb5; display: block; margin-top: 5px; font-family: monospace; background: #000; padding: 8px; border-radius: 3px; }
        .dashboard-box { background: #1e1e1e; border: 1px solid #444; padding: 20px; margin-bottom: 30px; border-radius: 6px; }
        table { width: 100%; margin-top: 10px; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #333; font-size: 0.9rem; }
        th { color: #F94E41; }
        .error { color: #ff5252; margin-top: 10px; }
        .hint { font-size: 0.8rem; color: #888; margin-top: 6px; }
        .hint a { color: #7bdcb5; }
    </style>
</head>
<body>
    <h1>📻 PanPlay Shortener & Station Hub</h1>

    <!-- LOGIN / DASHBOARD BEREICH -->
    <div class="dashboard-box">
        <?php if (!isset($_SESSION['station'])): ?>
            <h3>Station Admin Login (Laut.fm API)</h3>
            <p style="font-size: 0.85rem; color: #aaa;">Log in with your Laut.fm station credentials to manage your default settings and links.</p>
            <?php if (!empty($loginError)) echo "<p class='error'>$loginError</p>"; ?>
            <form method="POST">
                <div class="row">
                    <div>
                        <label for="api_user">Station ID / Name:</label>
                        <input type="text" id="api_user" name="api_user" required placeholder="e.g. eins">
                    </div>
                    <div>
                        <label for="api_pass">API Password / Token:</label>
                        <input type="password" id="api_pass" name="api_pass" required placeholder="Password">
                        <p class="hint">No token yet? <a href="https://radioadmin.laut.fm/login?callback_url=PanPlayShortener" target="_blank" rel="noopener">Get it here</a>.</p>

                    </div>
                </div>
                <button type="submit" name="laut_login">Login to Dashboard</button>
            </form>
        <?php else: ?>
            <h3>Logged in as Station: <span style="color:#7bdcb5;"><?= htmlspecialchars($_SESSION['station']) ?></span></h3>
            <a href="?logout=1" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem; margin-top: 10px;">Logout</a>
            
            <hr style="border:0; border-top:1px solid #444; margin: 20px 0;">

            <!-- STANDARD-LINK (DEFAULT) DEFINIEREN -->
            <h4>Default Settings (for clean links like <code>l.gehjetzt.de/<?= htmlspecialchars($_SESSION['station']) ?></code>)</h4>
            <p style="font-size: 0.85rem; color: #aaa;">Define parameters that will always be applied when someone calls your shortlink without any extra options.</p>
            
            <form method="POST">
                <input type="hidden" name="station" value="<?= htmlspecialchars($_SESSION['station']) ?>">
                <div class="row">
                    <div>
                        <label>Default Version:</label>
                        <select name="version">
                            <option value="">Latest Stable (Default)</option>
                            <option value="0-1-0-1">0.1.0.0 (Stable)</option>
                            <option value="0-0-1-8">0.0.1.8 (LTS)</option>
                            <option value="0-0-1-6">0.0.1.6 (Legacy)</option>
                        </select>
                    </div>
                    <div>
                        <label>Default Theme:</label>
                        <select name="theme">
                            <option value="">Default (Dark)</option>
                            <option value="light">Light</option>
                            <option value="hc-dark">High Contrast Dark</option>
                            <option value="win9x">Win9x</option>
                            <option value="glass">Glass</option>
                            <option value="aero">Aero</option>
                            <option value="laut">Laut</option>
                            <option value="bs-cosmo">Modern UI (Cosmo)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="save_default">Save Station Default Settings</button>
            </form>

            <hr style="border:0; border-top:1px solid #444; margin: 20px 0;">

            <!-- GESPEICHERTE HASHES FÜR DIESEN SENDER ANZEIGEN & LÖSCHEN -->
            <h4>Your Generated Hash Links</h4>
            <?php 
            $loggedStation = $_SESSION['station'];
            $stationHashes = $db['hashes'][$loggedStation] ?? [];
            if (empty($stationHashes)): 
            ?>
                <p style="font-size: 0.85rem; color: #777;">No custom hash links generated yet.</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Hash / Shortlink</th>
                        <th>Settings / Version</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($stationHashes as $hKey => $hData): ?>
                    <tr>
                        <td><code>https://l.gehjetzt.de/<?= urlencode($loggedStation) ?>/<?= $hKey ?></code></td>
                        <td>
                            Ver: <?= !empty($hData['version']) ? $hData['version'] : 'Latest' ?><br>
                            <small style="color:#aaa;"><?= htmlspecialchars(http_build_query($hData['params'])) ?></small>
                        </td>
                        <td>
                            <a href="?delete_hash=<?= $hKey ?>" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.75rem; margin:0;" onclick="return confirm('Delete this shortlink?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- GENERATOR UI -->
    <form method="POST">
        <h2>Link Generator</h2>
        <label for="station">Station ID (Laut.fm Stream Name):</label>
        <input type="text" id="station" name="station" value="<?= htmlspecialchars($inputStation) ?>" required placeholder="e.g. eins">

        <div class="row">
            <div>
                <label for="version">PanPlay Version:</label>
                <select id="version" name="version">
                    <option value="">Latest Stable (Default)</option>
                    <option value="0.1.0">0.1.0 (Stable)</option>
                    <option value="0.0.18">0.0.18 (LTS Supported)</option>
                    <option value="0.0.16">0.0.16 (Legacy Supported)</option>
                </select>
            </div>
            <div>
                <label for="theme">Theme:</label>
                <select id="theme" name="theme">
                    <option value="">Default (Dark)</option>
                    <option value="light">Light</option>
                    <option value="hc-dark">High Contrast Dark</option>
                    <option value="win9x">Win9x</option>
                    <option value="glass">Glass</option>
                    <option value="aero">Aero</option>
                    <option value="laut">Laut</option>
                    <option value="bs-cosmo">Modern UI (Cosmo)</option>
                </select>
            </div>
        </div>

        <h2>Appearance & Feature Controls</h2>
        <div class="checkbox-group">
            <div class="form-check">
                <input type="checkbox" name="use_hash" id="use_hash" value="1" checked>
                <label for="use_hash" style="margin:0; color:#7bdcb5; font-weight:bold;">Generate unique Hash Shortlink</label>
            </div>
            <hr style="border:0; border-top:1px solid #444; margin:10px 0;">
            <div class="form-check">
                <input type="checkbox" name="schedule" id="schedule" value="n">
                <label for="schedule" style="margin:0;">Hide Schedule</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="stationinfo" id="stationinfo" value="n">
                <label for="stationinfo" style="margin:0;">Hide Station Info</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="trackhistory" id="trackhistory" value="n">
                <label for="trackhistory" style="margin:0;">Hide Track History</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="playwith" id="playwith" value="n">
                <label for="playwith" style="margin:0;">Hide Play With</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="nolfmw" id="nolfmw" value="j">
                <label for="nolfmw" style="margin:0;">Hide All (nolfmw)</label>
            </div>
        </div>

        <button type="submit" style="width:100%;"><i class="fas fa-code"></i> Generate Link</button>
    </form>

    <?php if (!empty($longLink)): ?>
        <div class="result">
            <?php if (!empty($shortLink)): ?>
                <strong>Your Unique Hash Shortlink:</strong>
                <code><?= htmlspecialchars($shortLink) ?></code>
                <br><br>
            <?php endif; ?>
            
            <strong>Classic Link (with Parameters):</strong>
            <code><?= htmlspecialchars($longLink) ?></code>
        </div>
    <?php endif; ?>
</body>
</html>