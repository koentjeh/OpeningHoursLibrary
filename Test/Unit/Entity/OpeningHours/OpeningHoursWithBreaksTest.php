<?php

use PHPUnit\Framework\TestCase;

class OpeningHoursWithBreaksTest extends TestCase
{
    private $dateFormat = DateTimeInterface::W3C;

    public function testInitialization()
    {
        $openAt = date($this->dateFormat, strtotime('1980-01-01 09:00:00'));
        $closedAt = date($this->dateFormat, strtotime('1980-01-01 18:00:00'));

        $openingHours = new OpeningHoursWithBreaks();
        $openingHours->setOpeningTime($openAt);
        $openingHours->setClosingTime($closedAt);

        $this->assertSame($openAt, $openingHours->getOpeningTime());
        $this->assertSame($closedAt, $openingHours->getClosingTime());
        $this->assertFalse($openingHours->hasBreaks());
    }

    public function testOpeningHoursWithPause()
    {
        $pauseStart = date($this->dateFormat, strtotime('1980-01-01 12:00:00'));
        $pauseEnd = date($this->dateFormat, strtotime('1980-01-01 13:00:00'));
        $pause = new Pause($pauseStart, $pauseEnd);

        $openingHours = new OpeningHoursWithBreaks();
        $this->assertFalse($openingHours->hasBreaks());

        $openingHours->addPause($pause);
        $this->assertTrue($openingHours->hasBreaks());
        $this->assertSame($pause, $openingHours->getBreaks()[0]);
    }

    public function testOpeningHoursWithMultipleHours()
    {
        $pauseStart = date($this->dateFormat, strtotime('1980-01-01 12:00:00'));
        $pauseEnd = date($this->dateFormat, strtotime('1980-01-01 13:00:00'));
        $pause2Start = date($this->dateFormat, strtotime('1980-01-01 14:00:00'));
        $pause2End = date($this->dateFormat, strtotime('1980-01-01 16:00:00'));
        $pause = new Pause($pauseStart, $pauseEnd);
        $pause2 = new Pause($pause2Start, $pause2End);

        $openingHours = new OpeningHoursWithBreaks();
        $this->assertFalse($openingHours->hasBreaks());

        $openingHours->addPause($pause, $pause2);
        $this->assertTrue($openingHours->hasBreaks());
        $this->assertSame($pause, $openingHours->getBreaks()[0]);
        $this->assertSame($pause, $openingHours->getBreaks()[1]);
    }
}
