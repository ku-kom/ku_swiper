<?php

declare(strict_types=1);

/**
* Process breakpoints in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;

enum Breakpoint {
    case MOBILE;
    case TABLET;
    case DESKTOP;
    case WIDESCREEN;
}  

class BreakpointConfiguration implements \JsonSerializable
{
    public Breakpoint $breakpoint;
    public int $slidesPerView = 1;
    public int $slidesPerGroup = 1;
    
    public function jsonSerialize(): array
    {
        return [
          'slidesPerView' => $this->slidesPerView,
          'slidesPerGroup' => $this->slidesPerGroup
        ];
    }
}