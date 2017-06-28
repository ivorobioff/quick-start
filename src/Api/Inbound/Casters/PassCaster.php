<?php
namespace ImmediateSolutions\Support\Api\Inbound\Casters;

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