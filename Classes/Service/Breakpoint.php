<?php

declare(strict_types=1);

/**
* Process breakpoints in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;

enum Breakpoint
{
    case MOBILE;
    case TABLET;
    case DESKTOP;
    case WIDESCREEN;

    public function size(): int
    {
        return match($this) {
            Breakpoint::MOBILE => 576,
            Breakpoint::TABLET => 768,
            Breakpoint::DESKTOP => 992,
            Breakpoint::WIDESCREEN => 1200
        };
    }
}
