<?php

declare(strict_types=1);

/**
* Process Swiper configuration from flexforms
*/

namespace UniversityOfCopenhagen\KuSwiper\DataProcessing;

use UniversityOfCopenhagen\KuSwiper\Service\Navigation\NavigationConfiguration;
use UniversityOfCopenhagen\KuSwiper\Service\Breakpoints\Breakpoint;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class SwiperNavigationProcessor  implements DataProcessorInterface
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
        $navigationConfiguration = new NavigationConfiguration();
        
        $flexFormData = $processedData['flexFormData'];
        
        // Breakpoint settings
        if (isset($flexFormData['arrows-smartphone']) && isset($flexFormData['dots-smartphone'])) {
            $navigationConfiguration->breakpoints[Breakpoint::MOBILE->size()] = new NavigationConfiguration(
                hideNavigation: (bool) $flexFormData['arrows-smartphone'], 
                hidePagination: (bool) $flexFormData['dots-smartphone']
            );
        }

        if (isset($flexFormData['arrows-tablet']) && isset($flexFormData['dots-tablet'])) {
            $navigationConfiguration->breakpoints[Breakpoint::TABLET->size()] = new NavigationConfiguration(
                hideNavigation: (bool) $flexFormData['arrows-tablet'], 
                hidePagination: (bool) $flexFormData['dots-tablet']
            );
        }

        if (isset($flexFormData['arrows-desktop']) && isset($flexFormData['dots-desktop'])) {
            $navigationConfiguration->breakpoints[Breakpoint::DESKTOP->size()] = new NavigationConfiguration(
                hideNavigation: (bool) $flexFormData['arrows-desktop'], 
                hidePagination: (bool) $flexFormData['dots-desktop']
            );
        }

        if (isset($flexFormData['arrows-widescreen']) && isset($flexFormData['dots-widescreen'])) {
            $navigationConfiguration->breakpoints[Breakpoint::WIDESCREEN->size()] = new NavigationConfiguration(
                hideNavigation: (bool) $flexFormData['arrows-widescreen'], 
                hidePagination: (bool) $flexFormData['dots-widescreen']
            );
        }

        $processedData['swiperNavigation'] = $navigationConfiguration;
        debug($navigationConfiguration->breakpoints);
        return $processedData;
    }
}
