# Changelog


## [1.0.13] - 2025-03-18
### Added
- Added fade effect when toggling chatbot visibility
### Changed
- Used variable for version number display
- Improved chatbot visibility transitions



## [1.0.12] - 2025-03-17
### Fixed
- Improved iframe visibility handling when chatbot is disabled
- Enhanced UI responsiveness to toggle state changes



## [1.0.11] - 2025-03-16
### Fixed
- Fixed chatbot preview not updating immediately after saving settings
- Changed "Enable AI Bot" label to "Enable HeroChat"

## [1.0.10] - 2025-03-16
### Changed
- Updated the Enable AI Bot checkbox to a toggle slider
- Added live preview of the chatbot in settings when enabled


## [1.0.9] - 2025-03-15
### Changed
- Updated HeroChat menu item styling to use a solid blue background color (#1FB7FF).
- Removed gradient and border radius from menu item styling.

## [1.0.8] - 2025-03-14
### Added
- Styled HeroChat menu item with a gradient background.
- Applied hover effect to make it stand out in the WordPress admin panel.


## [1.0.7] - 2025-03-14
### Changed
- Updated chatbot embed script to use a new format.
- The chatbot ID is now the only required setting for embedding.

### Fixed
- Resolved issues where the chatbot script was not loading correctly.
- Improved the script initialization process for better performance.
- Fixed an issue with excluded pages not properly preventing chatbot display.

---

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
