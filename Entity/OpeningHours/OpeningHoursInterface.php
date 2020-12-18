<?php

interface OpeningHoursInterface
{
    public function setOpeningTime(DateTimeInterface $openAt): void;

    public function getOpeningTime(): DateTimeInterface;

    public function setClosingTime(DateTimeInterface $closedAt): void;

    public function getClosingTime(): DateTimeInterface;
}
