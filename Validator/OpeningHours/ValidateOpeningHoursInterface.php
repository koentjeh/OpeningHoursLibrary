<?php

interface ValidateOpeningHoursInterface
{
    public function validate(OpeningHoursInterface $openingHours): bool;
}
