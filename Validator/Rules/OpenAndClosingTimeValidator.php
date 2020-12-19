<?php

namespace Koen\OpeningHoursLibrary\Validator\Rules;

use Koen\OpeningHoursLibrary\Entity\OpeningHours\OpeningHoursInterface;

class OpenAndClosingTimeValidator implements OpeningHoursRuleInterface
{
    /**
     * Validates if openings time occurs before closing time
     * @param OpeningHoursInterface $openingHours
     * @return bool
     */
    public function isSatisfiedBy(OpeningHoursInterface $openingHours): bool
    {
        return $openingHours->getOpeningTime() < $openingHours->getClosingTime();
    }
}
