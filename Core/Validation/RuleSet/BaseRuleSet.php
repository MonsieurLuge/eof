<?php

namespace EOF\Validation\RuleSet;

use \Exception;
use EOF\Validation\Picker\Picker;
use EOF\Validation\Rule\Rule;
use EOF\Validation\RuleSet\RuleSet;
use EOF\Validation\ValidationResult;

/**
 * A base Rule Set object (immutable object).
 * Allows to add multiples rules to the set and exposes the same "applyOn" method
 * as in the Rules objects.
 */
final class BaseRuleSet implements RuleSet
{

    /** @var Rule[] **/
    private $rules;

    /**
     * @codeCoverageIgnore
     * @param Rule[] $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): RuleSet
    {
        foreach ($this->rules as $rule) {
            $rule->applyOn($target, $name, $result);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function on(string $name, Picker $targetProperty): RuleSet
    {
        if (empty($this->rules)) {
            throw new Exception('there must be at least one rule in the set to call the "on" method');
        }

        return new RuleSetWithLocation($name, $this->rules, $targetProperty);
    }

    /**
     * @inheritDoc
     */
    public function with(Rule $rule): RuleSet
    {
        return new self(array_merge($this->rules, [ $rule ]));
    }

}
