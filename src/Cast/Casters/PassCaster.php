<?php
namespace ImmediateSolutions\Support\Cast\Casters;

use ImmediateSolutions\Support\Cast\CasterInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class PassCaster implements CasterInterface
{
    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint)
    {
        return true;
    }

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        return $value;
    }
}