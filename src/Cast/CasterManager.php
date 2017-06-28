<?php
namespace ImmediateSolutions\Support\Cast;

use ImmediateSolutions\Support\Cast\Casters\BoolCaster;
use ImmediateSolutions\Support\Cast\Casters\FloatCaster;
use ImmediateSolutions\Support\Cast\Casters\IntCaster;
use ImmediateSolutions\Support\Cast\Casters\PassCaster;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class CasterManager
{
    /**
     * @param mixed $value
     * @param string $hint
     * @return mixed
     */
    public function cast($value, $hint)
    {
        $caster = $this->findCaster($value, $hint);

        return $caster->cast($value, $hint);
    }

    /**
     * @param mixed $value
     * @param string $hint
     * @return CasterInterface
     */
    private function findCaster($value, $hint)
    {
        /**
         * @var CasterInterface[] $casters
         */
        $casters = [
            new BoolCaster(),
            new FloatCaster(),
            new IntCaster()
        ];

        foreach ($casters as $caster){
            if ($caster->canCast($value, $hint)){
                return $caster;
            }
        }

        return new PassCaster();
    }
}