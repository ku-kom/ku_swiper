<?php

declare(strict_types=1);

/**
* Process arrow and pagination class name settings in Swiper navigation
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\Navigation;

class SwiperNavigationConfiguration implements \JsonSerializable
{
    public function __construct(
        // Arrows
        public bool $hideNavigationSm = true,
        public bool $hideNavigationMd = true,
        public bool $hideNavigationLg = false,
        public bool $hideNavigationXl = false,

        // Pagination dots
        public bool $hidePaginationSm = false,
        public bool $hidePaginationMd = false,
        public bool $hidePaginationLg = false,
        public bool $hidePaginationXl = false
    ) {

    }
    
    
    public function jsonSerialize(): array
    {
        return [
          'hideNavigationSm' => $this->hideNavigationSm,
          'hideNavigationMd' => $this->hideNavigationMd,
          'hideNavigationLg' => $this->hideNavigationLg,
          'hideNavigationXl' => $this->hideNavigationXl,
          'hidePaginationSm' => $this->hidePaginationSm,
          'hidePaginationMd' => $this->hidePaginationMd,
          'hidePaginationLg' => $this->hidePaginationLg,
          'hidePaginationXl' => $this->hidePaginationXl
        ];
    }
}
