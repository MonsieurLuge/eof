<?php

namespace EOF\Validation\Picker;

use \Exception;
use EOF\Validation\Picker\Picker;

/**
 * Object Property Picker (immutable object).
 * Allows to pick a property value from a target object.
 */
final class PropertyPicker implements Picker
{

    /** @var string **/
    private $property;

    /**
     * @codeCoverageIgnore
     * @param string $property
     */
    public function __construct(string $property)
    {
        $this->property = $property;
    }

    /**
     * @inheritDoc
     */
    public function valueFrom($target)
    {
        if (false === property_exists($target, $this->property)) {
            throw new Exception(sprintf(
                'cannot pick the property "%s": it doesn\'t exist in the target object',
                $this->property
            ));
        }

        return $target->{$this->property};
    }

}
