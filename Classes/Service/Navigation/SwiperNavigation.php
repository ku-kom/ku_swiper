<?php

declare(strict_types=1);

/**
* Process backend Swiper configuration
* Use in fluid like this: {SwiperNavigation -> f:format.json()}
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;


use UniversityOfCopenhagen\KuSwiper\Service\Navigation\NavigationConfiguration;

class SwiperNavigation implements \JsonSerializable
{
    public array $breakpoints = [];
    
    public function jsonSerialize(): array
    {
        return [
            'breakpoints' => array_map(fn (NavigationConfiguration $breakpoint) => $breakpoint, $this->breakpoints)
        ];
    }
}
