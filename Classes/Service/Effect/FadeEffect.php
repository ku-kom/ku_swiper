<?php

declare(strict_types=1);

/**
* Process fade effect in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\Effect;

final class FadeEffect implements EffectInterface
{
    private function __construct(
        protected string $effect = 'fade'
    ) {
    }

    public static function create(array $properties = []): self
    {
        return new self();
    }

    public function jsonSerialize(): array
    {
        return [
            'effect' => $this->effect,
            'fadeEffect' => [
                'crossFade' => true
            ]
        ];
    }
}