<?php

class OpeningHoursValidator
{
    /**
     * Validates if opening time occurs before closing time and vice versa.
     * @param OpeningHoursInterface $openingHours
     * @return bool
     */
    public function validate(OpeningHoursInterface $openingHours): bool
    {
        return $openingHours->getOpeningTime() > $openingHours->getClosingTime();
    }
}
