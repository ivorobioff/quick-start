<?php
namespace ImmediateSolutions\Support\Api\Parsers\Casters;

use ImmediateSolutions\Support\Validation\Rules\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EnumCollectionCaster implements CasterInterface
{
    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return is_array($hint) && count($hint) == 1 && isset($hint[0]) && $hint[0] instanceof Enum && is_array($value);
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        return array_values(array_filter($value, function($value){
            return $value !== '';
        }));
    }
}