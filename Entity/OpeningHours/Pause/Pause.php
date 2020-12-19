<?php

namespace Koen\OpeningHoursLibrary\Entity\OpeningHours\Pause;

use DateTimeInterface;

class Pause implements PauseInterface
{
    private $startTime;

    private $endTime;

    public function __construct(
        DateTimeInterface $startTime,
        DateTimeInterface $endTime
    ) {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getStartTime(): DateTimeInterface
    {
        return $this->startTime;
    }

    public function getEndTime(): DateTimeInterface
    {
        return $this->endTime;
    }
}
