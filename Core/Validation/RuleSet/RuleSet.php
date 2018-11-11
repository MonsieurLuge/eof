<?php

namespace EOF\Validation\RuleSet;

use \Exception;
use EOF\Validation\Picker\Picker;
use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * Rule Set interface
  * @codeCoverageIgnore
 */
interface RuleSet
{

    /**
     * Applies the rules to the given target.
     * If one or more rules fails, the corresponding errors are added to the result set.
     * @param mixed            $target
     * @param string           $name
     * @param ValidationResult $result
     * @return RuleSet
     */
    public function applyOn($target, string $name, ValidationResult $result): RuleSet;

    /**
     * Adds a "location" to the last rule added to the set.
     * @param string $name
     * @param Picker $targetProperty
     * @return RuleSet
     * @throws Exception if there is no rule in the set
     */
    public function on(string $name, Picker $targetProperty): RuleSet;

    /**
     * Adds a rule to the set.
     * @param Rule $rule
     * @return RuleSet
     */
    public function with(Rule $rule): RuleSet;

}
