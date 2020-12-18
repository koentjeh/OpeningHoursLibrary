<?php

interface OpeningHoursByDayInterface
{
    public function getOpeningHours(DateTimeInterface $now): OpeningHoursInterface;
}
