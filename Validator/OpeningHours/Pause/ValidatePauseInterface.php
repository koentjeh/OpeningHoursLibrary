<?php

interface ValidatePauseInterface
{
    public function validate(OpeningHoursInterface $openingHours, PauseInterface $pause): bool;
}
