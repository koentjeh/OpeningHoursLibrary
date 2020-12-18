<?php

use PHPUnit\Framework\TestCase;

class PauseTest extends TestCase
{
    private $dateFormat = DateTimeInterface::W3C;

    public function testInitialization()
    {
        $pauseStart = date($this->dateFormat, strtotime('1980-01-01 12:00:00'));
        $pauseEnd = date($this->dateFormat, strtotime('1980-01-01 13:00:00'));

        $pause = new Pause($pauseStart, $pauseEnd);
        $this->assertSame($pauseStart, $pause->getStartTime());
        $this->assertSame($pauseEnd, $pause->getEndTime());
    }
}
