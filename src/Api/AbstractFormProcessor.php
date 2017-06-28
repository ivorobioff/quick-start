<?php
namespace ImmediateSolutions\Support\Api;

use ImmediateSolutions\Support\Api\Casters\BoolCaster;
use ImmediateSolutions\Support\Api\Casters\CasterInterface;
use ImmediateSolutions\Support\Api\Casters\FloatCaster;
use ImmediateSolutions\Support\Api\Casters\IntCaster;
use ImmediateSolutions\Support\Api\Casters\PassCaster;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractFormProcessor extends AbstractProcessor
{
    /**
     * @var array
     */
   private $processedData;

    /**
     * @return array
     */
    public function getData()
    {
        if ($this->processedData === null){
            $this->processedData = $this->processData();
        }

        return $this->processedData;
    }

    /**
     * @return array
     */
    private function processData()
    {
        if (in_array($this->getContentType(), ['application/x-www-form-urlencoded', 'multipart/form-data'])){
            return $this->castData();
        }

        if ($this->getContentType() === 'application/json'){
            return $this->getUnprocessedData();
        }

        return [];
    }

    /**
     * @return array
     */
    private function castData()
    {
        $data = $this->getUnprocessedData();

        $result = [];

        foreach ($this->schema() as $name => $rule) {
            if (!array_has($data, $name)){
                continue ;
            }

            $value = array_get($data, $name);

            $value = $this->findCaster($value, $rule)->cast($value, $rule);

            array_set($result, $name, $value);
        }

        return $result;
    }

    /**
     * @param mixed $value
     * @param string $hint
     * @return CasterInterface
     */
    protected function findCaster($value, $hint)
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

    /**
     * @return array
     */
    abstract protected function getUnprocessedData();

    /**
     * @return string
     */
    abstract protected function getContentType();
}