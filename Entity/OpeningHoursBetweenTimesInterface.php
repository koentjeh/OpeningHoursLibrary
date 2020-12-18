<?php

interface OpeningHoursBetweenTimesInterface
{
    public function getOpeningHours(DateTimeInterface $now, DateTimeInterface $until): array;
}
