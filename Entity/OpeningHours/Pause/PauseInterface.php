<?php

interface PauseInterface
{
    public function __construct(DateTimeInterface $startTime, DateTimeInterface $endTime);

    public function getStartTime(): DateTimeInterface;

    public function getEndTime(): DateTimeInterface;
}
