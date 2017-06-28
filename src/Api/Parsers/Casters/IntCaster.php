<?php
namespace ImmediateSolutions\Support\Api\Parsers\Casters;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class IntCaster implements CasterInterface
{
    const HINT = 'int';

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return $hint === self::HINT && ctype_digit($value);
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        return (int) $value;
    }
}