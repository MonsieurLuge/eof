<?php

namespace EOF\Validation\Rule;

use EOF\Validation\Rule\Rule;
use EOF\Validation\ValidationResult;

final class MetaRule implements Rule
{

    /** @var string **/
    private $method;
    /** @var Rule **/
    private $origin;
    /** @var array **/
    private $parameters;

    /**
     * @codeCoverageIgnore
     * @param Rule $origin
     * @param string        $method
     * @param array         $parameters
     */
    public function __construct(Rule $origin, string $method, array $parameters = [])
    {
        $this->method     = $method;
        $this->origin     = $origin;
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function applyOn($target, string $name, ValidationResult $result): Rule
    {
        $this->origin->applyOn(
            call_user_func_array([$target, $this->method], $this->parameters),
            $name,
            $result
        );

        return $this;
    }

}
