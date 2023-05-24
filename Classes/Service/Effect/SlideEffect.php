<?php

declare(strict_types=1);

/**
* Process slide effect in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Service\Effect;

final class SlideEffect implements EffectInterface
{
    private function __construct(
        protected string $effect = 'slide'
    ) {
    }

    public static function create(array $properties = []): self
    {
        return new self();
    }

    public function jsonSerialize(): array
    {
        return [
            'effect' => $this->effect
        ];
    }
}
