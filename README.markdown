# JIT Image Manipulation #

"Just in time" image manipulation for Symphony.
It is part of the Symphony core download package.

- Version: 1.10
- Date: 26th October 2010
- Requirements: Symphony 2.0.5 or later
- Author: Alistair Kearney, alistair@symphony-cms.com
- Constributors: [A list of contributors can be found in the commit history](http://github.com/pointybeard/jit_image_manipulation/commits/master)
- GitHub Repository: <http://github.com/pointybeard/jit_image_manipulation>

## Synopsis

A simple way to manipulate images on the fly via the URL. Supports caching, image quality settings and loading of offsite images.

## Installation

Information about [installing and updating extensions](http://symphony-cms.com/learn/tasks/view/install-an-extension/) can be found in the Symphony documentation at <http://symphony-cms.com/learn/>.

## Updating

Due to some .htaccess changes in Symphony 2.0.6+, it is recommended that you edit your core Symphony .htaccess to remove anything
before 'extensions/' in the JIT rewrite. It should look like the following regardless of where you installed Symphony:

	### IMAGE RULES	
	RewriteRule ^image\/(.+\.(jpg|gif|jpeg|png|bmp))$ extensions/jit_image_manipulation/lib/image.php?param=$1 [L,NC]

It is not absolutely necessary to do this, but may prevent problems with future releases.

## Usage

### Basics

The image manipulation is controlled via the URL, e. g.:

	<img src="{$root}/image/2/80/80/0/5{image/@path}/{image/filename}" />

The extension accepts four nummeric settings and one hex setting for image manipulation:

1. mode
2. width
3. height
4. rotation
5. reference position (for cropping only)
6. color (for background filling with rotational images and cropped images only)

There are seven possible modes:

- `0` none
- `1` resize
- `2` resize and crop
- `3` crop
- `4` crop and rotate
- `5` resize and rotate
- `6` resize, crop and rotate (used in the example)
- `7` rotate

If you're using mode `2`, `4`, '5' or '6' for image cropping you need to specify the reference position:

	+---+---+---+
	| 1 | 2 | 3 |
	+---+---+---+
	| 4 | 5 | 6 |
	+---+---+---+
	| 7 | 8 | 9 |
	+---+---+---+

If you're using mode `4`, `5` `6` or `7` for image rotation you need to specify a rotational angle, specified clockwise or ani-clockwise in degrees. For exmaple:

	0 = 0º
	90 = rotated 90º clockwise
	-90 = rotated 90º anti-clockwise

You also need to specify a background hex color value (supports CSS-style short hex strings [ff2233 == f23]). This is used as a compelte fill for JPGs and as a keyline for PNGs and GIFs, which are otherwise transparent.

### Trusted Sites

In order pull images from external sources, you must set up a white-list of trusted sites. To do this, goto "System > Preferences" and add rules to the "JIT Image Manipulation" rules textarea. To match anything use a single asterisk (*).

## Change Log

**Version 1.10**

- Added image rotation modes (Joseph Denne [josephdenne.com])

**Version 1.09**

- Sending `ETag` header with response
- Added support for `HTTP_IF_MODIFIED_SINCE` and `HTTP_IF_NONE_MATCH` request headers, which will mean a `304 Not Modified` header can be set (Thanks to Nick Dunn for helping on this one)
- Added Portuguese and Italian translations (Thanks to Rainer Borene & Simone Economo for those)

**Version 1.08**

- Added French localisation
- Adjusted German localisation
- Fixed a Symphony 2.0.7RC2 compatibility issue.

**Version 1.07**

- Added localisation files for Dutch, German, Portuguese (Brazil) and Russian
- `trusted()` will look for the `jit-trusted-sites` before attempting to return its contents. This prevents warnings from showing up in the logs.

**Version 1.06**

- Code responsible for .htaccess update will no longer try to append the rewrite base to for path to extensions folder 

**Version 1.05**

- Fixed bug introduced by usage of the imageAntiAlias() function
- Errors and warnings are logged in the main Symphony log
- A dump of internal params are logged in addition to any errors

**Version 1.04**

- Adding support for alpha masked images.

**Version 1.03**

- Minor changes to how DOCROOT is determined

**Version 1.02**

- Disabling extension will remove rule from .htaccess

**Version 1.01**

- Updated to work with 2.0.2 config changes
	
