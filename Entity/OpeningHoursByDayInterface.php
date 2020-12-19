<?php

namespace Koen\OpeningHoursLibrary\Entity;

use DateTimeInterface;

interface OpeningHoursByDayInterface
{
    public function getOpeningHours(DateTimeInterface $now): OpeningHoursInterface;
}
