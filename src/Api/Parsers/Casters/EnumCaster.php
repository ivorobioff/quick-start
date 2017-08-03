<?php
namespace ImmediateSolutions\Support\Api\Parsers\Casters;

use ImmediateSolutions\Support\Validation\Rules\Enum;


/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EnumCaster implements CasterInterface
{
    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return $hint instanceof Enum && is_string($value);
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
       if ($value === ''){
           return null;
       }

       return $value;
    }
}