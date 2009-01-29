pref("toolkit.defaultChromeURI", "chrome://eccstract/content/browser.xul");
pref("toolkit.singletonWindowType", "cscrape");
pref("toolkit.defaultChromeFeatures", "chrome,menubar,toolbar,status,resizable=yes,dialog=no");

/* Show error pages instead of an alert window. */
pref("browser.xul.error_pages.enabled", true);

/* Disable useless warnings */
pref("general.warnOnAboutConfig", false);
pref("security.warn_entering_secure", false);
pref("security.warn_entering_weak", false);
pref("security.warn_leaving_secure", false);
pref("security.warn_submit_insecure", false);
pref("security.warn_viewing_mixed", false);

pref("extensions.getMoreExtensionsURL", "about:blank");
pref("extensions.update.url", "");
pref("extensions.dss.enabled", false);
pref("extensions.dss.switchPending", false);

/* debugging prefs */
pref("browser.dom.window.dump.enabled", true);
pref("javascript.options.showInConsole", true);
pref("javascript.options.strict", false);
pref("nglayout.debug.disable_xul_cache", true);
pref("nglayout.debug.disable_xul_fastload", true);

pref("permissions.default.image", 2); // don't load image automatically
pref("security.enable_java", false); // disable java
pref("layout.css.report_errors", false); // hide CSS errors in the console
pref("privacy.popups.disable_from_plugins", true); // disable popups from plugins