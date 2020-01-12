<?php

namespace EOF\Validation\RuleSet;

use \Exception;
use EOF\Validation\Picker\Picker;
use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * A Rule Set object including a target value valueLocation (immutable object).
 * Allow to apply the rules on a specific target's location.
 * ex: apply the rules "less than 666" and "greater than 123" on the result of $target->valueX().
 */
final class RuleSetWithLocation implements RuleSet
{

    /** @var string **/
    private $name;
    /** @var Rule[] **/
    private $rules;
    /** @var Picker **/
    private $valueLocation;

    /**
     * @codeCoverageIgnore
     * @param string          $name the location's name (ex: "request URI")
     * @param array           $rules
     * @param Picker $valueLocation
     */
    public function __construct(string $name, array $rules, Picker $valueLocation)
    {
        $this->name          = $name;
        $this->rules         = $rules;
        $this->valueLocation = $valueLocation;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): RuleSet
    {
        foreach ($this->rules as $rule) {
            $rule->applyOn($this->valueLocation->valueFrom($target), $this->name, $result);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function on(string $name, Picker $targetProperty): RuleSet
    {
        throw new Exception('This kind of ruleset cannot be called with the "on" method');
    }

    /**
     * @inheritDoc
     */
    public function with(Rule $rule): RuleSet
    {
        return new NestedRuleSet([ $this ], [ $rule ]);
    }

}
