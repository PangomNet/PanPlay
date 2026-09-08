<?php
declare(strict_types=1);

function panplayExtensionFolder(string $mode): ?string
{
    if ($mode === 'laut.fm') {
        return 'laut';
    }
    if ($mode === 'Baseaudio') {
        return 'baseaudio';
    }
    return null;
}

function panplayPwfSlotPath(string $mode, string $slot): ?string
{
    $extension = panplayExtensionFolder($mode);
    if ($extension === null || preg_match('/^[a-z][a-z0-9_-]*$/', $slot) !== 1) {
        return null;
    }

    $path = __DIR__ . '/' . $extension . '/pwf/' . $slot . '.php';
    return is_file($path) ? $path : null;
}

function panplayLoadPwfSlot(string $mode, string $slot, array $context = [], $fallback = null)
{
    $path = panplayPwfSlotPath($mode, $slot);
    if ($path === null) {
        return $fallback;
    }

    return (static function (string $slotPath, array $slotContext) {
        extract($slotContext, EXTR_SKIP);
        return require $slotPath;
    })($path, $context);
}
