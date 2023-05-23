<?php

declare(strict_types=1);

/**
* Process breakpoints in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;

class BreakpointConfiguration implements \JsonSerializable
{
    public function __construct(
        public float $slidesPerView = 1,
        public float $slidesPerGroup = 1
    ) {

    }
    
    
    public function jsonSerialize(): array
    {
        return [
          'slidesPerView' => $this->slidesPerView,
          'slidesPerGroup' => $this->slidesPerGroup
        ];
    }
}
