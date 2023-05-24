<?php

declare(strict_types=1);

/**
* Process backend Swiper configuration
* Use in fluid like this: {swiperConfiguration -> f:format.json()}
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\GeneralConfiguration;

use UniversityOfCopenhagen\KuSwiper\Service\Effect\EffectInterface;
use UniversityOfCopenhagen\KuSwiper\Service\Breakpoints\BreakpointConfiguration;

class SwiperConfiguration implements \JsonSerializable
{
    public mixed $autoplay;
    public bool $loop = false;
    public int $slideSpeed = 4000;
    public int $initialSlide = 0;
    public int $centeredSlides = 0;
    public float $slidesPerView = 1;
    public int $slidesPerGroup = 1;
    public EffectInterface $effect;
    public array $breakpoints = [];
    
    public function jsonSerialize(): array
    {
        return [
            'autoplay' => $this->autoplay,
            'loop' => $this->loop,
            'initialSlide' => $this->initialSlide,
            'centeredSlides' => $this->centeredSlides,
            'slidesPerView' => $this->slidesPerView,
            'slidesPerGroup' => $this->slidesPerGroup,
            'effect' => $this->effect,
            'breakpoints' => array_map(fn (BreakpointConfiguration $breakpoint) => $breakpoint, $this->breakpoints)
        ];
    }
}
