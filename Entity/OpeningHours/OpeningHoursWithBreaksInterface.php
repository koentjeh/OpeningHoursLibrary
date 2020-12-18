<?php

interface OpeningHoursWithBreaksInterface extends OpeningHoursInterface
{
    public function addPause(PauseInterface ...$pause): void;

    public function hasBreaks(): bool;

    public function getBreaks(): array;
}
