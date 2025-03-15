## [1.0.47] - 2025-03-19
### Changed
- Allow empty chatbot ID when toggle is off
- Clear chatbot ID field when toggle is disabled

## [1.0.46] - 2025-03-19
### Changed
- Settings and API Key tabs are now only visible when Chatbot ID is configured

## [1.0.45] - 2025-03-19
### Changed
- Settings tab is now only visible when API key is configured

## [1.0.44] - 2025-03-19
### Changed
- Made chatbot ID field optional
- Improved save button validation logic
- Fixed version synchronization across files

## [1.0.42] - 2025-03-19
### Changed
- Made chatbot ID field mandatory
- Added form validation to prevent saving without chatbot ID

## [1.0.28] - 2025-03-19
### Changed
- Made chatbot ID field mandatory
- Added form validation to prevent saving without chatbot ID

## [1.0.27] - 2025-03-19
### Changed
- Only show chatbot on pages when custom ID is provided
- Use default bot ID (61be3e7b6818446c8486b538147dce8e) only for settings preview
- Automatically disable chatbot when no ID is provided



## [1.0.26] - 2025-03-19
### Changed
- Always use default bot ID (61be3e7b6818446c8486b538147dce8e) unless custom ID is provided
- Improved user experience with consistent default chatbot behavior

## [1.0.25] - 2025-03-19
### Changed
- Set /* as default value for included pages when empty
- Added default wildcard pattern when no included pages are specified


# Changelog

## [1.0.24] - 2025-03-19
### Fixed
- Added excluded pages check before loading chatbot script
- Improved page visibility logic to respect both included and excluded paths


## [1.0.23] - 2025-03-19
### Changed
- Improved chatbot script loading logic for included pages
- Enhanced page path matching functionality


## [1.0.22] - 2025-03-19
### Changed
- Synchronized version numbers across plugin files
- Improved plugin header version handling

## [1.0.21] - 2025-03-19
### Changed
- Updated plugin version constant implementation
- Improved version consistency across plugin files

## [1.0.20] - 2025-03-19
### Changed
- Added iframe border-radius for improved visual appearance
- Fixed version constant display across plugin


## [1.0.19] - 2025-03-19
### Fixed
- Fixed chatbot display logic to properly handle wildcard patterns
- Improved page matching with explicit path handling


## [1.0.18] - 2025-03-19
### Changed
- Added page reload after saving settings for better state management

## [1.0.17] - 2025-03-19
### Changed
- Added default fallback chatbot ID when none is provided

## [1.0.16] - 2025-03-19
### Fixed
- Fixed incorrect version display in settings screen

## [1.0.15] - 2025-03-19
### Fixed
- Fixed toggle state persistence in settings page
- Improved settings save feedback without page reload

## [1.0.14] - 2025-03-19
### Changed
- Added fade effects for chatbot visibility toggle
- Used variable for version display in settings
- Updated chatbot visibility transition handling


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