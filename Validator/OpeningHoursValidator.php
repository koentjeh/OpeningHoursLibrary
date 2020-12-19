<?php

namespace Koen\OpeningHoursLibrary\Validator;

use Koen\OpeningHoursLibrary\Entity\OpeningHours\OpeningHoursInterface;
use Koen\OpeningHoursLibrary\Validator\Rules\OpeningHoursRuleInterface;

class OpeningHoursValidator implements OpeningHoursValidatorInterface
{
    /** @var OpeningHoursInterface */
    private $openingHours;

    /** @var OpeningHoursRuleInterface[] */
    private $rules;

    /**
     * OpeningHoursValidator constructor.
     * @param OpeningHoursInterface $openingHours
     * @param OpeningHoursRuleInterface ...$rules
     */
    public function __construct(
        OpeningHoursInterface $openingHours,
        OpeningHoursRuleInterface ...$rules
    ) {
        $this->openingHours = $openingHours;
        $this->rules = $rules;
    }

    /**
     * Will return false if one requirement is not satisfied.
     * Like the && operator all rules should be satisfied.
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->isSatisfiedBy($this->openingHours)) {
                return false;
            }
        }

        return true;
    }
}
