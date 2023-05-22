# TYPO3 extension Swiper slider

### This is a TYPO3 extension of the Swiper slider
Integrates [Swiper](https://swiperjs.com/  "Swiper") (currently v9.3.2) into TYPO3.

Does not require jQuery.

## Developed for
TYPO3 v. 11.5, PHP 8.1

## Contents
### Two TYPO3 content elements:
* Create slides as items with image and/or text
* Create slides with existing content records

## Features
* Play/pause buttons
* Accessibility: No autoplay if user has enabled reduced motions in their OS/Platform.

## Settings
### Many of Swiper options are available:
* Autoplay
* Infinite loop
* Number of slides to display at the time in different viewports
* Option to display slides partially
* Slide speed
* Lazy load
* Fade or sliding effect
* ...etc.

Use some of the many settings, or go with a basic slider.

## Known issues
When using the content element "Create slides with records" and adding a custom order of records in the TCA field, there's a bug in TYPO3 v.11, which makes the records render by UUID in the frontend, rather than the order set by the user in the backend. [See the bug described here](https://forge.typo3.org/issues/93760).

## Bugs and feature requests

Have a bug or a feature request? If your problem or idea is not addressed yet, [please open a new issue](https://github.com/ku-kom/ku_swiper/issues).

## License
This project is released under the terms of the [MIT license](https://en.wikipedia.org/wiki/MIT_License).