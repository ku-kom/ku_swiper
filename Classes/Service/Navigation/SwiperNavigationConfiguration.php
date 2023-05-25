<?php

declare(strict_types=1);

/**
* Process arrow and pagination class name settings in Swiper navigation
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\Navigation;

class SwiperNavigationConfiguration implements \JsonSerializable
{
    public function __construct(
        // Arrows class names
        public bool $hideNavSm = true,
        public bool $hideNavMd = true,
        public bool $hideNavLg = false,
        public bool $hideNavXl = false,

        // Pagination dots class names
        public bool $hidePagSm = false,
        public bool $hidePagMd = false,
        public bool $hidePagLg = false,
        public bool $hidePagXl = false
    ) {

    }
    
    
    public function jsonSerialize(): array
    {
        return [
          'hideNavSm' => $this->hideNavSm,
          'hideNavMd' => $this->hideNavMd,
          'hideNavLg' => $this->hideNavLg,
          'hideNavXl' => $this->hideNavXl,
          'hidePagSm' => $this->hidePagSm,
          'hidePagMd' => $this->hidePagMd,
          'hidePagLg' => $this->hidePagLg,
          'hidePagXl' => $this->hidePagXl
        ];
    }
}
