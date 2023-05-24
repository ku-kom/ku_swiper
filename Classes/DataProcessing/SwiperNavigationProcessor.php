<?php

declare(strict_types=1);

/**
* Process Swiper configuration from flexforms
*/

namespace UniversityOfCopenhagen\KuSwiper\DataProcessing;

use UniversityOfCopenhagen\KuSwiper\Service\Navigation\SwiperNavigationConfiguration;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class SwiperNavigationProcessor implements DataProcessorInterface
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
        $navigationConfiguration = new SwiperNavigationConfiguration();
        
        $flexFormData = $processedData['flexFormData'];
        
        // Arrows smartphone settings
        if (isset($flexFormData['arrows-smartphone']) && $flexFormData['arrows-smartphone'] === '0') {
            $navigationConfiguration->hideNavigationSm = true;
        }
        // Dots smartphone settings
        if (isset($flexFormData['dots-smartphone']) && $flexFormData['dots-smartphone'] === '0') {
            $navigationConfiguration->hidePaginationSm = true;
        }
        // Arrows tablet settings
        if (isset($flexFormData['arrows-tablet']) && $flexFormData['arrows-tablet'] === '0') {
            $navigationConfiguration->hideNavigationMd = true;
        }
        // Dots tablet settings
        if (isset($flexFormData['dots-tablet']) && $flexFormData['dots-tablet'] === '0') {
            $navigationConfiguration->hidePaginationMd = true;
        }

        // Arrows desktop settings
        if (isset($flexFormData['arrows-desktop']) && $flexFormData['arrows-desktop'] === '0') {
            $navigationConfiguration->hideNavigationLg = true;
        }
        // Dots desktop settings
        if (isset($flexFormData['dots-desktop']) && $flexFormData['dots-desktop'] === '0') {
            $navigationConfiguration->hidePaginationLg = true;
        }

        // Arrows widescreen settings
        if (isset($flexFormData['arrows-widescreen']) && $flexFormData['arrows-widescreen'] === '0') {
            $navigationConfiguration->hideNavigationXl = true;
        }
        // Dots widescreen settings
        if (isset($flexFormData['dots-widescreen']) && $flexFormData['dots-widescreen'] === '0') {
            $navigationConfiguration->hidePaginationXl = true;
        }

        // Convert $navigationConfiguration to array
        $classesToArray = (array) $navigationConfiguration;
        
        // Get keys (class names) if their value is 'true'
        $classNames = array_keys(array_filter($classesToArray));

        // Convert array of class names to a string seperated by space
        $classes = implode(" ", $classNames);

        // Class names to lower case
        $classes = strtolower($classes);

        $processedData['swiperNavigation'] = $classes;

        return $processedData;
    }
}
