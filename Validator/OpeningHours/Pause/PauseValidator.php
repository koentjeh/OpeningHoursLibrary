<?php

class PauseValidator implements ValidatePauseInterface
{
    public function validate(OpeningHoursInterface $openingHours, PauseInterface $pause): bool
    {
        $openAt = $openingHours->getOpeningTime();
        $pauseStart = $pause->getStartTime();
        $pauseEnd = $pause->getEndTime();
        $closedAt = $openingHours->getClosingTime();

        return  $this->validatePauseStartBeforeEnd($pauseStart, $pauseEnd) &&
                $this->validatePauseOccursWhileOpen($openAt, $pauseStart, $pauseEnd, $closedAt);

    }

    private function validatePauseStartBeforeEnd(
        DateTimeInterface $pauseStart,
        DateTimeInterface $pauseEnd): bool
    {
        return $pauseStart < $pauseEnd;
    }

    private function validatePauseOccursWhileOpen(
        DateTimeInterface $openAt,
        DateTimeInterface $pauseStart,
        DateTimeInterface $pauseEnd,
        DateTimeInterface $closedAt): bool
    {
        return $pauseStart > $openAt && $pauseEnd < $closedAt;
    }
}
