<?php

namespace Koen\OpeningHoursLibrary\Entity\OpeningHours;

use DateTimeInterface;

class OpeningHours implements OpeningHoursInterface
{
    /** @var DateTimeInterface */
    private $openAt;

    /** @var DateTimeInterface */
    private $closedAt;

    public function setOpeningTime(DateTimeInterface $openAt): void
    {
        $this->openAt = $openAt;
    }

    public function getOpeningTime(): DateTimeInterface
    {
        return $this->openAt;
    }

    public function setClosingTime(DateTimeInterface $closedAt): void
    {
        $this->closedAt = $closedAt;
    }

    public function getClosingTime(): DateTimeInterface
    {
        return $this->closedAt;
    }

//        if (!$this->openingHoursValidator->validate($this)) {
//            $this->throwInvalidTimeException('Closing time bust be set after opening time', [
//                'openAt'    => $this->openAt,
//                'closedAt'  => $closedAt
//            ]);
//        }

//    protected function throwInvalidTimeException(string $message, array $data): void
//    {
//        throw new InvalidTimeException($message . print_r($data, true));
//    }
}
