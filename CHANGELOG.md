# Changelog

## [1.0.6] - 2025-02-08
### Added
- Updated vendor dependencies to ensure compatibility with the latest WordPress version.
- Improved chatbot initialization for better performance.
- Enhanced security by sanitizing and validating user input fields.

### Fixed
- Corrected minor UI inconsistencies in the admin settings page.
- Fixed an issue where some settings were not saving correctly.
- Optimized the plugin update check process.

---

## [1.0.5] - 2025-02-07
### Added
- Implemented more robust error handling in settings.
- Added support for debugging logs.

### Fixed
- Resolved an issue with the chatbot script not loading correctly in some themes.
- Fixed inconsistencies in plugin settings validation.

---

## [1.0.4] - 2025-02-07
### Added
- Improved wildcard matching logic for included and excluded pages.
- Enhanced compatibility with caching plugins.

### Fixed
- Removed duplicate "View details" link in the plugin listing.
- Addressed an issue where settings were sometimes not reflected immediately.

---

## [1.0.3] - 2025-02-06
### Added
- Implemented automatic updates using **Plugin Update Checker**.
- Changed WordPress sidebar menu icon to a **chat bubble** (`dashicons-format-chat`).

### Fixed
- Removed duplicate "View details" button from the WordPress plugin listing.
- Fixed `.gitignore` to prevent missing **plugin-update-checker** and **vendor** folders.
- Resolved an issue where the chatbot was not displaying properly on certain included pages.

---

## [1.0.2] - 2025-02-06
- Added chatbot display settings (enable, chatbot ID, included/excluded pages).
- Injected chatbot script dynamically in the header.
- Implemented wildcard pattern matching for included/excluded pages.

## [1.0.1] - 2025-02-05
- Initial release with chatbot integration.
