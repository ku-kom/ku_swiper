<?php

declare(strict_types=1);

/**
* Process Swiper configuration from flexforms
*/

namespace UniversityOfCopenhagen\KuSwiper\DataProcessing;

use UniversityOfCopenhagen\KuSwiper\Service\SwiperConfiguration\SwiperConfiguration;
use UniversityOfCopenhagen\KuSwiper\Service\Breakpoints\BreakpointConfiguration;
use UniversityOfCopenhagen\KuSwiper\Service\Breakpoints\Breakpoint;
use UniversityOfCopenhagen\KuSwiper\Service\Effect\SlideEffect;
use UniversityOfCopenhagen\KuSwiper\Service\Effect\FadeEffect;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class SwiperConfigurationProcessor implements DataProcessorInterface
{
    /**
      * @param ContentObjectRenderer $cObj The data of the content element or page
      * @param array $contentObjectConfiguration The configuration of Content Object
      * @param array $processorConfiguration The configuration of this processor
      * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
      * @return array the processed data as key/value store
      */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // Get flexform data from Swiper content element and override default settings
        $swiperConfiguration = new SwiperConfiguration();
        
        $flexFormData = $processedData['flexFormData'];

        // Number of inline slides or records
        if (isset($processedData['data']['tx_ku_swiper_item'])) {
            $number_of_slides = intval($processedData['data']['tx_ku_swiper_item']);
        } elseif (isset($processedData['data']['records'])) {
            $number_of_slides = intval($processedData['data']['records']);
        }

        // Start slide 0 is default order, 1 means random number between 1 and total number of slides
        if (isset($flexFormData['startSlide']) && $flexFormData['startSlide'] === '1') {
            $swiperConfiguration->initialSlide = (int) rand(1, $number_of_slides);
        }

        // Autoplay
        if (isset($flexFormData['autoplay']) && $number_of_slides > 1 && $flexFormData['autoplay'] === '1') {
            $swiperConfiguration->autoplay = array(
                "delay" => intval($flexFormData['slideSpeed']),
                "disableOnInteraction" => false,
            );
        } else {
            $swiperConfiguration->autoplay = (int) $flexFormData['autoplay'];
        }

        // Loop
        if (isset($flexFormData['loop']) && $number_of_slides > 2 && $flexFormData['loop'] === '1') {
            $swiperConfiguration->loop = true;
        }

        // Fade
        $swiperConfiguration->effect = SlideEffect::create();
        if (isset($flexFormData['fade']) && $number_of_slides > 1 && $flexFormData['fade'] === '1') {
            $swiperConfiguration->effect = FadeEffect::create();
        }

        // Centered slides
        if (isset($flexFormData['centeredSlides'])) {
            $swiperConfiguration->centeredSlides = (int) $flexFormData['centeredSlides'];
        }

        // Slides to show at the time
        if (isset($flexFormData['slidesToShow-smartphone'])) {
            $swiperConfiguration->slidesPerView = (float) $flexFormData['slidesToShow-smartphone'];
        }

        // Slides to swipe at the time
        if (isset($flexFormData['slidesToScroll-smartphone'])) {
            $swiperConfiguration->slidesPerGroup = (int) $flexFormData['slidesToScroll-smartphone'];
        }
        
        // Breakpoint settings
        if (isset($flexFormData['slidesToShow-smartphone']) && isset($flexFormData['slidesToScroll-smartphone'])) {
            $swiperConfiguration->breakpoints[Breakpoint::MOBILE->size()] = new BreakpointConfiguration(slidesPerView: (float) $flexFormData['slidesToShow-smartphone'], slidesPerGroup: (float) $flexFormData['slidesToScroll-smartphone']);
        }

        if (isset($flexFormData['slidesToShow-tablet']) && isset($flexFormData['slidesToScroll-tablet'])) {
            $swiperConfiguration->breakpoints[Breakpoint::TABLET->size()] = new BreakpointConfiguration(slidesPerView: (float) $flexFormData['slidesToShow-tablet'], slidesPerGroup: (float) $flexFormData['slidesToScroll-tablet']);
        }

        if (isset($flexFormData['slidesToShow-desktop']) && isset($flexFormData['slidesToScroll-desktop'])) {
            $swiperConfiguration->breakpoints[Breakpoint::DESKTOP->size()] = new BreakpointConfiguration(slidesPerView: (float) $flexFormData['slidesToShow-desktop'], slidesPerGroup: (float) $flexFormData['slidesToScroll-desktop']);
        }
        
        if (isset($flexFormData['slidesToShow-widescreen']) && isset($flexFormData['slidesToScroll-widescreen'])) {
            $swiperConfiguration->breakpoints[Breakpoint::WIDESCREEN->size()] = new BreakpointConfiguration(slidesPerView: (float) $flexFormData['slidesToShow-widescreen'], slidesPerGroup: (float) $flexFormData['slidesToScroll-widescreen']);
        }

        $processedData['swiperConfiguration'] = $swiperConfiguration;
        return $processedData;
    }
}
