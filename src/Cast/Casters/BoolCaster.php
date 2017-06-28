<?php
namespace ImmediateSolutions\Support\Cast\Casters;

use ImmediateSolutions\Support\Cast\CasterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class BoolCaster implements CasterInterface
{
    const TRUE_VALUES = [1, '1', true, 'true', 'yes'];
    const FALSE_VALUES = [0, '0', false, 'false', 'no'];
    const HINT = 'bool';

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return $hint === self::HINT && in_array($value, array_merge(self::TRUE_VALUES, self::FALSE_VALUES), true);
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        return in_array($value, self::TRUE_VALUES, true) ? true : false;
    }
}