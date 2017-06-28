<?php
namespace ImmediateSolutions\Support\Api\Parsers\Casters;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class FloatCaster implements CasterInterface
{
    const HINT = 'float';

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return $hint === self::HINT && preg_match('/^[0-9]+(\.[0-9]+)?$/', $value) > 0;
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        return (float) $value;
    }
}