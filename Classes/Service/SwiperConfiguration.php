<?php

declare(strict_types=1);

/**
* Process backend Swiper configuration
* Use in fluid like this: {swiperConfiguration -> f:format.json()}
**/

namespace UniversityOfCopenhagen\KuSwiper\Service;

use UniversityOfCopenhagen\KuSwiper\Effect\EffectInterface;
use UniversityOfCopenhagen\KuSwiper\Service\BreakpointConfiguration;

class SwiperConfiguration implements \JsonSerializable
{
    // Costumizable
    public mixed $autoplay;
    public int $loop = 0;
    public int $slideSpeed = 4000;
    public int $startSlide = 0;
    public int $centeredSlides = 0;
    public int $slidesPerView = 1;
    public int $slidesPerGroup = 1;
    public EffectInterface $effect;
    public array $breakpoints = [];
    
    public function jsonSerialize(): array
    {
        return [
            'autoplay' => $this->autoplay,
            'loop' => $this->loop,
            'startSlide' => $this->startSlide,
            'centeredSlides' => $this->centeredSlides,
            'slidesPerView' => $this->slidesPerView,
            'slidesPerGroup' => $this->slidesPerGroup,
            'effect' => $this->effect,
            'breakpoints' => array_map(fn(BreakpointConfiguration $breakpoint) => json_encode($breakpoint), $this->breakpoints)
        ];
    }

    
}