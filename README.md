=== OneTrust Text Overrides (WPML) ===
Contributors: vanik
Tags: onetrust, cookie banner, cookie consent, gdpr, translations, wpml, multilingual
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Override OneTrust cookie banner texts and the Preference Center with translations managed through WPML String Translation.

== Description ==

This plugin lets you **translate and override OneTrust cookie banner texts** (buttons, headings, descriptions, and category labels) using **WPML → String Translation**.  
It watches for the OneTrust banner/Preference Center to render, then replaces the UI texts client-side so your visitors see the correct language — even when OneTrust’s own UI copy is limited or injected late.

**What it does**

- Registers all key OneTrust UI strings with WPML (`wpml_register_single_string`).
- Retrieves the user’s translated strings (`wpml_translate_single_string`).
- Applies the texts to the banner and Preference Center via DOM updates and a `MutationObserver`.
- Hooks into `window.OptanonWrapper` so texts re-apply whenever OneTrust re-renders.

**What it doesn’t do**

- It does **not** modify your OneTrust configurations or categories. It only replaces visible text nodes/labels.

**Requirements**

- OneTrust script installed and working.
- WPML + WPML String Translation active.

== Features ==

- Translate banner title/description and buttons: **Accept All**, **Reject All**, **Cookie Settings/Preferences**, **Confirm My Choices**, **Allow All**.
- Translate Preference Center: title, description, section titles, and **category headers/descriptions/status** for `C0001`–`C0004`.
- Safe, idempotent client-side overrides with minimal layout impact.
- Works with late-rendered elements (OneTrust) thanks to observers + retry logic.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/onetrust-text-overrides-wpml` or install it as a zipped plugin.
2. Activate **OneTrust Text Overrides (WPML)** in **Plugins**.
3. Ensure **WPML** and **WPML String Translation** are active.
4. Make sure your OneTrust script is loaded on the site (per OneTrust docs).

== Usage ==

1. Visit **WPML → String Translation**.
2. Filter by **Domain**: `onetrust-overrides`.
3. Translate the strings you need (banner texts, buttons, Preference Center descriptions, categories).
4. Save translations and clear caches (plugin/CDN) if needed.
5. Load the site: the banner/Preference Center should show your translations.

**Tip:** If you don’t translate a string, the English default defined in the plugin is used.

== How it works ==

- On `init`, the plugin **registers** a set of strings under domain `onetrust-overrides`.
- On `wp_enqueue_scripts`, it injects a small script that:
  - Gathers translated strings from WPML.
  - Calls `applyOnce()` to replace texts when the banner is present.
  - Observes `#onetrust-banner-sdk` and `#onetrust-pc-sdk` for dynamic updates.
  - Wraps existing `window.OptanonWrapper` to re-apply on OneTrust’s lifecycle events.

== Available Strings ==

**Banner & Preference Center**
- `banner_title` – “Privacy Preference Center”
- `banner_description` – main banner body text
- `btn_accept` – “Accept All Cookies”
- `btn_reject` – “Reject All”
- `btn_settings` – “Cookies Settings”
- `btn_settings_link` – “Cookie Preferences” (text for any show-settings triggers)
- `pc_title` – Preference Center title
- `pc_desc` – Preference Center intro paragraph
- `pc_confirm` – “Confirm My Choices” (footer button)
- `pc_allow_all` – “Allow All”
- `cat_title` – “Cookie Preferences” (section header in PC)

**Categories**
- `cat_C0001_header`, `cat_C0001_desc`, `cat_C0001_status` (Strictly Necessary; default status “Always Active”)
- `cat_C0002_header`, `cat_C0002_desc`
- `cat_C0003_header`, `cat_C0003_desc`
- `cat_C0004_header`, `cat_C0004_desc`

== Compatibility Notes ==

- Selectors used include:  
  `#onetrust-accept-btn-handler`, `#onetrust-reject-all-handler`, `#onetrust-pc-btn-handler`,  
  `#onetrust-policy-title`, `#onetrust-policy-text`, `#ot-pc-title`, `#ot-pc-desc`,  
  `.ot-pc-footer .save-preference-btn-handler`, `.ot-pc-footer .ot-pc-refuse-all-handler`,  
  `.ot-pc-footer .accept-recommended-btn-handler`, `#accept-recommended-btn-handler`,  
  and category elements like `#ot-header-id-C0001`, `#ot-desc-id-C0001`, `#ot-status-id-C0001`, etc.

- If your OneTrust template uses different IDs/classes, you can adapt the selectors in the injected script.

== FAQ ==

= I translated strings but still see English. =  
Check that:
1) WPML String Translation has translations **complete** (not in “needs update”).  
2) Caches (page cache/CDN) are cleared.  
3) OneTrust renders the default markup/IDs. If customized, update selectors in the inline script.

= Can I add more categories than C0001–C0004? =  
Yes. Duplicate the pattern inside the `$data['cats']` array (PHP) and add matching WPML strings, then add the relevant `#ot-header-id-XXXX` / `#ot-desc-id-XXXX` / `#ot-status-id-XXXX` selectors in the JS block if needed.

= Will this break OneTrust consent logic? =  
No. It only replaces displayed text. Consent logic and storage remain handled by OneTrust.

== Troubleshooting ==

- **Nothing changes:** ensure `window.OptanonWrapper` is actually called by OneTrust on your site; your OneTrust script must be present and not blocked.
- **Partial changes only:** some OneTrust templates nest nodes. The script tries both `textContent` and direct text node replacement for paragraphs; adjust if your template differs.
- **Different languages per domain/path:** rely on WPML’s language detection; this plugin just requests the translated string for the current locale.

== Changelog ==

= 1.0.0 =
* Initial release: WPML-driven OneTrust text overrides for banner & Preference Center (including categories C0001–C0004).

== Upgrade Notice ==

= 1.0.0 =
Initial release. Configure translations under WPML → String Translation (domain: `onetrust-overrides`).
