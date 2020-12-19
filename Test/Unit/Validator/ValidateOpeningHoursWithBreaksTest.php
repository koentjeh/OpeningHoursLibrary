<?php

namespace Koen\OpeningHoursLibrary\Test\Unit\Validator;

use DateTime;
use Koen\OpeningHoursLibrary\Entity\OpeningHours\OpeningHoursWithBreaks;
use Koen\OpeningHoursLibrary\Entity\OpeningHours\Pause\Pause;
use Koen\OpeningHoursLibrary\Validator\OpeningHoursValidator;
use Koen\OpeningHoursLibrary\Validator\Rules\PauseValidator;
use PHPUnit\Framework\TestCase;

class validateOpeningHoursWithBreaksTest extends TestCase
{

    public function testBreaksOnlyOccurWhileBeingOpen()
    {
        $openingHours = new OpeningHoursWithBreaks();
        $openingHours->setOpeningTime(new DateTime('1980-01-01 09:00'));
        $openingHours->setClosingTime(new DateTime('1980-01-01 17:00'));

        $pause1 = new Pause(
            new DateTime('1980-01-01 06:00'),
            new DateTime('1980-01-01 08:00')
        );
        $pause2 = new Pause(
            new DateTime('1980-01-01 18:30'),
            new DateTime('1980-01-01 19:00')
        );

        $openingHours->addPause($pause1, $pause2);

        $validator = new OpeningHoursValidator($openingHours,
            new PauseValidator()
        );

        $this->assertFalse($validator->isValid());
    }

    public function testOpeningHoursWithOverlappingBreaks()
    {
        $openingHours = new OpeningHoursWithBreaks();
        $openingHours->setOpeningTime(new DateTime('Y-m-d H:i'));
        $openingHours->setClosingTime(new DateTime('Y-m-d H:i'));

        $pause1 = new Pause(
            new DateTime('1980-01-01 09:00'),
            new DateTime('1980-01-01 11:00')
        );
        $pause2 = new Pause(
            new DateTime('1980-01-01 12:00'),
            new DateTime('1980-01-01 14:00')
        );
        $pause3 = new Pause(
            new DateTime('1980-01-01 13:30'),
            new DateTime('1980-01-01 16:00')
        );

        $openingHours->addPause($pause1, $pause2, $pause3);

        $validator = new OpeningHoursValidator($openingHours,
            new PauseValidator()
        );

        $this->assertFalse($validator->isValid());
    }

    public function testOpeningHoursWithoutOverlappingBreaks()
    {
        $openingHours = new OpeningHoursWithBreaks();
        $openingHours->setOpeningTime(new DateTime('Y-m-d H:i'));
        $openingHours->setClosingTime(new DateTime('Y-m-d H:i'));

        $pause1 = new Pause(
            new DateTime('1980-01-01 09:00'),
            new DateTime('1980-01-01 11:00')
        );
        $pause2 = new Pause(
            new DateTime('1980-01-01 12:00'),
            new DateTime('1980-01-01 14:00')
        );
        $pause3 = new Pause(
            new DateTime('1980-01-01 15:00'),
            new DateTime('1980-01-01 16:00')
        );

        $openingHours->addPause($pause1, $pause2, $pause3);

        $validator = new OpeningHoursValidator($openingHours,
            new PauseValidator()
        );

        $this->assertTrue($validator->isValid());
    }

}
