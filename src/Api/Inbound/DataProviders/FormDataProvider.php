<?php
namespace ImmediateSolutions\Support\Api\Inbound\DataProviders;

use ImmediateSolutions\Support\Api\Inbound\Casters\CasterInterface;
use ImmediateSolutions\Support\Api\Inbound\Casters\PassCaster;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class FormDataProvider implements DataProviderInterface
{
    /**
     * @var array
     */
    private $schema;

    /**
     * @var array
     */
    private $unprocessedData;

    /**
     * @var CasterInterface[]
     */
    private $casters;

    /**
     * @param $unprocessedData
     * @param array $schema
     * @param CasterInterface[] $casters
     */
    public function __construct(array $unprocessedData, array $schema, array $casters)
    {
        $this->unprocessedData = $unprocessedData;
        $this->schema = $schema;
        $this->casters = $casters;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->castData();
    }

    /**
     * @return array
     */
    private function castData()
    {
        $data = $this->unprocessedData;

        $result = [];

        foreach ($this->schema as $name => $rule) {
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
        foreach ($this->casters as $caster){
            if ($caster->canCast($value, $hint)){
                return $caster;
            }
        }

        return new PassCaster();
    }
}