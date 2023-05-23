<?php

declare(strict_types=1);

/**
* Process breakpoints in Swiper configuration
**/

namespace UniversityOfCopenhagen\KuSwiper\Effect;

use JsonSerializable;

interface EffectInterface extends JsonSerializable
{
  public static function create(array $properties = []): self;
}
