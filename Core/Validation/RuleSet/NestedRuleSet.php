<?php

namespace EOF\Validation\RuleSet;

use EOF\Validation\Picker\Picker;
use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * A Nested Rule Set (immutable object).
 * Allows to apply multiple rule sets on a target.
 */
final class NestedRuleSet implements RuleSet
{

    /** @var Rule[] **/
    private $rules;
    /** @var RuleSet[] **/
    private $ruleSets;

    /**
     * @codeCoverageIgnore
     * @param array $ruleSets
     * @param array $rules
     */
    public function __construct(array $ruleSets = [], array $rules = [])
    {
        $this->rules    = $rules;
        $this->ruleSets = $ruleSets;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): RuleSet
    {
        // apply the rules to the target
        foreach ($this->rules as $rule) {
            $rule->applyOn($target, $name, $result);
        }

        // then let each rule set handle the target
        foreach ($this->ruleSets as $ruleSet) {
            $ruleSet->applyOn($target, $name, $result);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function on(string $name, Picker $targetProperty): RuleSet
    {
        return new NestedRuleSet(array_merge(
            $this->ruleSets,
            [ new RuleSetWithLocation($name, $this->rules, $targetProperty) ]
        ));
    }

    /**
     * @inheritDoc
     */
    public function with(Rule $rule): RuleSet
    {
        return new self($this->ruleSets, array_merge($this->rules, [ $rule ]));
    }

}
