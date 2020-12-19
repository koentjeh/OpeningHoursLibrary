<?php

namespace Koen\OpeningHoursLibrary\Entity\OpeningHours;

use Koen\OpeningHoursLibrary\Entity\OpeningHours\Pause\PauseInterface;

class OpeningHoursWithBreaks extends OpeningHours implements OpeningHoursWithBreaksInterface
{
    /** @var PauseInterface[]  */
    private $breaks = [];

    public function addPause(PauseInterface ...$pause): void
    {
        $this->breaks[] = $pause;
    }

    public function hasBreaks(): bool
    {
        return count($this->breaks) >= 0;
    }

    /**
     * @return PauseInterface[]
     */
    public function getBreaks(): array
    {
        return $this->hasBreaks()
            ? $this->breaks
            : [];
    }
}
