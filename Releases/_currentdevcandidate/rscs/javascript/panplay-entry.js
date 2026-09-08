const entryUrl = new URL(import.meta.url);
const coreUrl = new URL('./panplay-alpha.js', entryUrl);
coreUrl.search = entryUrl.search;

const core = await import(coreUrl.href);
const extensionPath = core.config.extensionModule;

if (extensionPath) {
    const extensionUrl = new URL(extensionPath, document.baseURI);
    const extensionRoot = new URL('engine/extensions/', document.baseURI);
    if (extensionUrl.origin !== window.location.origin || !extensionUrl.href.startsWith(extensionRoot.href)) {
        throw new Error('PanPlay rejected an invalid extension client module.');
    }
    extensionUrl.search = entryUrl.search;
    const extension = await import(extensionUrl.href);
    if (typeof extension.init === 'function') {
        await extension.init(core);
    }
}
