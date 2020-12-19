<?php

namespace Koen\OpeningHoursLibrary\Entity;

use DateTimeInterface;

interface OpeningHoursBetweenTimesInterface
{
    public function getOpeningHours(DateTimeInterface $now, DateTimeInterface $until): array;
}
