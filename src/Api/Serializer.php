<?php
namespace ImmediateSolutions\Support\Api;

use DateTime;
use ImmediateSolutions\Support\Other\Enum;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class Serializer
{
    /**
     * @param DateTime $datetime
     * @return string
     */
    protected function datetime(DateTime $datetime = null)
    {
        if ($datetime === null){
            return $datetime;
        }

        return $datetime->format(DateTime::ATOM);
    }

    /**
     * @param Enum $enum
     * @return string|integer
     */
    protected function enum(Enum $enum = null)
    {
        if ($enum === null){
            return $enum;
        }

        return $enum->value();
    }
}