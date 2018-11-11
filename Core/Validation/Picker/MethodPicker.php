<?php

namespace EOF\Validation\Picker;

use \Exception;
use EOF\Validation\Picker\Picker;

/**
 * Object Method's return Picker (immutable object).
 * Allows to pick the returned value of a specific method from a target object.
 */
final class MethodPicker implements Picker
{

    /** @var string **/
    private $method;
    /** @var array **/
    private $parameters;

    /**
     * @codeCoverageIgnore
     * @param string $method
     * @param array  $parameters
     */
    public function __construct(string $method, array $parameters = [])
    {
        $this->method     = $method;
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        if (false === method_exists($target, $this->method)) {
            throw new Exception(sprintf(
                'cannot pick the result of the method "%s": it doesn\'t exist in the target object',
                $this->method
            ));
        }

        return call_user_func_array([ $target, $this->method ], $this->parameters);
    }

}
