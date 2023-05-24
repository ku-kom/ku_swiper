<?php

declare(strict_types=1);

/**
* Process breakpoints in Swiper navigation
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\Navigation;

class NavigationConfiguration implements \JsonSerializable
{
    public function __construct(
        // Arrows
        public bool $hideNavigation = true,

        // Pagination dots
        public bool $hidePagination = false,
        public array $breakpoints = []
    ) {

    }
    
    
    public function jsonSerialize(): array
    {
        return [
          'hideNavigation' => $this->hideNavigation,
          'hidePagination' => $this->hidePagination,
        ];
    }
}
