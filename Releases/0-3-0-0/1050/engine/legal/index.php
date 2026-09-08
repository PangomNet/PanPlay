<?php
require_once __DIR__ . '/../../data/storage.php';

$requestedDoc = isset($_GET['doc']) ? strtolower($_GET['doc']) : 'all';

function ppLegalTextPath($fileName) {
    $dataDir = realpath(__DIR__ . '/../../data');
    $candidate = realpath($dataDir . DIRECTORY_SEPARATOR . basename($fileName));

    if ($dataDir === false || $candidate === false || strpos($candidate, $dataDir) !== 0) {
        return null;
    }

    return $candidate;
}

function ppLoadLegalText($fileName) {
    $path = ppLegalTextPath($fileName);

    if ($path === null || !is_readable($path)) {
        return "This legal document has not been configured yet.\n\nExpected plain text file: data/" . basename($fileName);
    }

    return file_get_contents($path);
}

$documents = [
    'privacy' => [
        'title' => 'Privacy Policy',
        'text' => ppLoadLegalText($pro_privacy_text),
    ],
    'imprint' => [
        'title' => 'Imprint',
        'text' => ppLoadLegalText($pro_imprint_text),
    ],
];

if ($requestedDoc !== 'all' && !isset($documents[$requestedDoc])) {
    $requestedDoc = 'all';
}
?>
<!DOCTYPE html>
<!-- saved from url=(0015)edge://credits/ -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width">
<meta name="color-scheme" content="light dark">
<title>Legal Documents</title>
<link rel="stylesheet" href="css.css">
</head>
<body>
<span class="page-title">Legal Documents</span>
<a id="print-link" href="#" onclick="window.print(); return false;">Print</a>
<label class="show show-all" tabindex="0">
<input type="checkbox" hidden="">
</label>
<div class="open-sourced">
This version of <?php echo htmlspecialchars($pro_name_cleartext); ?> is operated by <?php echo htmlspecialchars($pro_eula_vendor); ?>. The following legal documents apply:
</div>

<?php foreach ($documents as $docKey => $document): ?>
<?php if ($requestedDoc === 'all' || $requestedDoc === $docKey): ?>
<div class="product">
<span class="title"><?php echo htmlspecialchars($document['title']); ?></span>
<label class="show" tabindex="0">
<input type="checkbox" hidden="">
</label>
<div class="license">
<pre><?php echo htmlspecialchars($document['text']); ?></pre>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>

<script src="js.js"></script>
</body>
</html>
