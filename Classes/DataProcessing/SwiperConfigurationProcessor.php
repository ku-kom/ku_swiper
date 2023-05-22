<?php

declare(strict_types=1);

/**
* Process Swiper configuration from flexforms
*/

namespace UniversityOfCopenhagen\KuSwiper\DataProcessing;

use UniversityOfCopenhagen\KuSwiper\Service\SwiperConfiguration;
//use UniversityOfCopenhagen\KuSwiper\Service\BreakpointConfiguration;
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

        // Get felxform data from Swiper content element and override default settings
        $swiperConfiguration = new SwiperConfiguration();
        
        $flexFormData = $processedData['flexFormData'];

        if (isset($flexFormData['slideSpeed'])) {
            $swiperConfiguration->slideSpeed = (int) $flexFormData['slideSpeed'];
        }

        if (isset($flexFormData['autoplay'])) {
            $swiperConfiguration->autoplay = (int) $flexFormData['autoplay'];
        }

        if (isset($flexFormData['loop'])) {
            $swiperConfiguration->loop = (int) $flexFormData['loop'];
        }

        if (isset($flexFormData['centeredSlides'])) {
            $swiperConfiguration->centeredSlides = (int) $flexFormData['centeredSlides'];
        }
        // if (isset($flexFormData['slidesToShow-smartphone']) && isset($flexFormData['slidesToScroll-smartphone'])) {
        //     $swiperConfiguration->breakpoints[Breakpoint::MOBILE] = new BreakpointConfiguration(slidesPerView: (int) $flexFormData['slidesToShow-smartphone'], slidesPerGroup: (int) $flexFormData['slidesToScroll-smartphone']);
        // }

        // if (isset($flexFormData['slidesToShow-tablet']) && isset($flexFormData['slidesToScroll-tablet'])) {
        //     $swiperConfiguration->breakpoints[Breakpoint::TABLET] = new BreakpointConfiguration(slidesPerView: (int) $flexFormData['slidesToShow-tablet'], slidesPerGroup: (int) $flexFormData['slidesToScroll-tablet']);
        // }

        // if (isset($flexFormData['slidesToShow-desktop']) && isset($flexFormData['slidesToScroll-desktop'])) {
        //     $swiperConfiguration->breakpoints[Breakpoint::DESKTOP] = new BreakpointConfiguration(slidesPerView: (int) $flexFormData['slidesToShow-desktop'], slidesPerGroup: (int) $flexFormData['slidesToScroll-desktop']);
        // }
        // if (isset($flexFormData['slidesToShow-widescreen']) && isset($flexFormData['slidesToScroll-widescreen'])) {
        //     $swiperConfiguration->breakpoints[Breakpoint::WIDESCREEN] = new BreakpointConfiguration(slidesPerView: (int) $flexFormData['slidesToShow-widescreen'], slidesPerGroup: (int) $flexFormData['slidesToScroll-widescreen']);
        // }

        $processedData['swiperConfiguration'] = $swiperConfiguration;
        return $processedData;
    }
}