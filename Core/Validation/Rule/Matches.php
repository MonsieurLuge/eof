<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

/**
 * Matches rule (immutable object).
 * Checks if the target matches a regular expression; if not, an error is added to the result set.
 */
final class Matches implements Rule
{

    /** @var string **/
    private $modifier;
    /** @var string **/
    private $pattern;

    /**
     * @codeCoverageIgnore
     * @param string $pattern
     * @param string $modifier
     */
    public function __construct(string $pattern, string $modifier = '#')
    {
        $this->modifier = $modifier;
        $this->pattern  = $pattern;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        $found = preg_match($this->modifier . $this->pattern . $this->modifier, $target);

        if (0 === $found) {
            $result->addError(sprintf(
                '"%s" doit correspondre au schéma "%s"',
                $name,
                print_r($this->pattern, true)
            ));
        }

        return $this;
    }

}
