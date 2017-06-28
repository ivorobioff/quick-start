<?php
namespace ImmediateSolutions\Support\Cast;
/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface CasterInterface
{
    /**
     * @param mixed $value
     * @param mixed $hint
     * @return int
     */
    public function canCast($value, $hint);

    /**
     * @param mixed $value
     * @param mixed $hint
     * @return mixed
     */
    public function cast($value, $hint);

}