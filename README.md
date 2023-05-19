# TYPO3 extension Swiper slider

### This is a TYPO3 extension of the Swiper slider
Integrates [Swiper](https://swiperjs.com/  "Swiper") into TYPO3.

Does not require jQuery.

## Developed for
TYPO3 v. 11.5, PHP 8.1

## Contents
### Two content elements:
* Create slides items with image and/or text
* Create slides with records

## Features
* Play/pause buttons
* Accessibility: No autoplay if user has enabled reduced motions in their OS.

## Settings
* Auloplay
* Infinite loop
* Number of slides to display at the time in different viewports
* Option to display slides partially
* Slide speed
* Lazy load
* Fade or sliding effect
* ...etc.

Use some of the many settings, or go with a basic slider.

## Known issues
When using the content element "Create slides with records" and adding a custom order of records in the TCA field, there's a bug in TYPO3 v.11, which makes the records render by UUID in the frontend, rather than the order set by the user in the backend. [See the bug here](https://forge.typo3.org/issues/93760  "TYPO3 forge").