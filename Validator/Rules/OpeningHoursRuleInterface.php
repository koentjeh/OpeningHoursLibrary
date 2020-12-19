<?php

namespace Koen\OpeningHoursLibrary\Validator\Rules;

use Koen\OpeningHoursLibrary\Entity\OpeningHours\OpeningHoursInterface;

interface OpeningHoursRuleInterface
{
    public function isSatisfiedBy(OpeningHoursInterface $openingHours): bool;
}
