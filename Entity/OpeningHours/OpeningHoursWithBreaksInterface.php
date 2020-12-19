<?php

namespace Koen\OpeningHoursLibrary\Entity\OpeningHours;

use Koen\OpeningHoursLibrary\Entity\OpeningHours\Pause\PauseInterface;

interface OpeningHoursWithBreaksInterface extends OpeningHoursInterface
{
    public function addPause(PauseInterface ...$pause): void;

    public function hasBreaks(): bool;

    public function getBreaks(): array;
}
