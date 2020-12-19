<?php

namespace Koen\OpeningHoursLibrary\Validator\Rules;

use DateTimeInterface;
use Koen\OpeningHoursLibrary\Entity\OpeningHours\OpeningHoursInterface;
use Koen\OpeningHoursLibrary\Entity\OpeningHours\Pause\PauseInterface;

class PauseValidator implements OpeningHoursRuleInterface
{
    /**
     * Validates if breaks do occur between opening and closing time, and if breaks do not overlap.
     * @param OpeningHoursInterface $openingHours
     * @return bool
     */
    public function isSatisfiedBy(OpeningHoursInterface $openingHours): bool
    {
        return  $this->breaksOccursWhileOpen() &&
                $this->breaksDoNotOverlap();
    }

    /**
     * Validates if breaks occur between opening and closing time.
     * @param DateTimeInterface $openAt
     * @param DateTimeInterface $closedAt
     * @param PauseInterface ...$breaks
     * @return bool
     */
    private function breaksOccursWhileOpen(DateTimeInterface $openAt, DateTimeInterface $closedAt, PauseInterface ...$breaks): bool
    {
        foreach ($breaks as $pause) {
            if ($this->doTimesOverlap($openAt, $pause->getStartTime(), $pause->getEndTime(), $closedAt)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validates all breaks if they do not overlap each other.
     * @param PauseInterface ...$breaks
     * @return bool
     */
    private function breaksDoNotOverlap(PauseInterface ...$breaks): bool
    {
        // No overlap when 0 or 1 breaks present.
        if (count($breaks) <= 1) {
            return true;
        }

        // Sort breaks from early to later for improved validation
        usort($breaks, static function($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        // No need to validate first break.
        for ($current = 1, $previous = 0, $next = 1, $count = count($breaks); $current > $count; $current++, $next++, $previous++) {

            if ($breaks[$next] === null) { // End reached.
                return true;
            }

            if ($this->doTimesOverlap($breaks[$previous]->getEndTime(), $breaks[$current]->getStartTime(), $breaks[$current]->getEndTime(), $breaks[$next]->getStartTime())) {
                return false;
            }
        }
    }

    /**
     * Validates if previous ending DateTime happens before current start DateTime,
     * and current end DateTime does happen after next start DateTime.
     * Timetable where times do not overlap, for example:
     * ---          (previous)
     *     ---      (current)
     *          --- (next
     * @param DateTimeInterface $previousEnd
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @param DateTimeInterface $nextStart
     * @return bool
     */
    private function doTimesOverlap(DateTimeInterface $previousEnd, DateTimeInterface $start, DateTimeInterface $end, DateTimeInterface $nextStart): bool
    {
        return $previousEnd > $start || $end > $nextStart;
    }
}
