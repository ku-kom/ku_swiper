<?php

declare(strict_types=1);

/**
* Process backend Swiper configuration
* Use in fluid like this: {swiperConfiguration -> f:format.json()}
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;

use UniversityOfCopenhagen\KuSwiper\Service\BreakpointConfiguration;

class SwiperConfiguration implements \JsonSerializable
{
    // Default
    public int $loopPreventsSliding = 0;
    public int $spaceBetween = 20;
    // Costumizable
    public int $autoplay = 0;
    public int $loop = 0;
    public int $slideSpeed = 4000;
    public int $initialSlide = 0;
    public int $centeredSlides = 0;
    // breakpoints
    public array $breakpoints = [
        Breakpoint::MOBILE => '576',
        Breakpoint::TABLET => '768',
        Breakpoint::DESKTOP => '992',
        Breakpoint::WIDESCREEN => '1200'
    ];
    
    public function jsonSerialize(): array
    {
        return [
            'loopPreventsSliding' => $this->loopPreventsSliding,
            'spaceBetween' => $this->spaceBetween,
            'autoplay' => $this->autoplay,
            'loop' => $this->loop,
            'slideSpeed' => $this->slideSpeed,
            'initialSlide' => $this->initialSlide,
            'centeredSlides' => $this->centeredSlides,
            'breakpoints' => array_map(BreakpointConfiguration $breakpoint => [json_encode($breakpoints)], $this->breakpoints)
        ];
    }

    
}