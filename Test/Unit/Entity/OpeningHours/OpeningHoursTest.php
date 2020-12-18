<?php

use PHPUnit\Framework\TestCase;

class OpeningHoursTest extends TestCase
{
    private $dateFormat = DateTimeInterface::W3C;

    public function testInitialization()
    {
        $openAt = date($this->dateFormat, strtotime('1980-01-01 09:00:00'));
        $closedAt = date($this->dateFormat, strtotime('1980-01-01 18:00:00'));

        $openingHours = new OpeningHours();
        $openingHours->setOpeningTime($openAt);
        $openingHours->setClosingTime($closedAt);

        $this->assertSame($openAt, $openingHours->getOpeningTime());
        $this->assertSame($closedAt, $openingHours->getClosingTime());
    }
}
