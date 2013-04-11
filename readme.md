# Genesis Mobile Menu plugin

**Contributors**:

* Nick the Geek ( [@Nick_theGeek](http://twitter.com/Nick_theGeek ) / [DesignsbyNicktheGeek.com](http://designsbynickthegeek.com/) )
* Jennifer Baumann ( [@dreamwhisper](https://twitter.com/dreamwhisper ) / [DreamWhisperDesigns.com](http://dreamwhisperdesigns.com) )

**Version**: 0.3.0   
**Requires at least**: 3.5  
**Tested up to**: 3.5.1  
**License**: GPLv2  

## Description

Created 3 mobile menu options for Genesis child themes

* Select Menu
* Collapsable Menu
* Alternate Menu

Also creates a gmm_is_mobile() function which can be used with the widget logic (or similar) plugin to hide widgets such as the Custom Menu Widget which might be in the header right sidebar

The menu includes a "fail safe" option which can be enabled to create a CSS and JS solution instead of a PHP solution which might not work in certain caching environments


This plugin requires the [Genesis Theme Framework](http://studiopress.com/themes/genesis) 

##### Links
* [Github project page](https://github.com/NicktheGeek/genesis-mobile-menus)
* [Documentation (GitHub wiki)](https://github.com/NicktheGeek/genesis-mobile-menus/wiki)


## Installation

This script is easy to install. If you can't figure it out you probably shouldn't be using it.

1. Upload the entire `genesis-responsive-menus` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to `Settings` menu item under `Genesis`
4. Select the menu type and menu position in the settings meta box.
5. If using a caching plugin it is recommended you use the fail safe option.

## Known Issues

* Some plugins may result in javascript conflicts; there is know fix at this time.

## To-do
* Fix known issues (above)
* clean up code
* improve inline documentation

## Changelog

### 0.3 (4-11-2013 : Current)
* First public release 