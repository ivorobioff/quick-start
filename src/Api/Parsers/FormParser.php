<?php
namespace ImmediateSolutions\Support\Api\Parsers;

use ImmediateSolutions\Support\Api\Parsers\Casters\BoolCaster;
use ImmediateSolutions\Support\Api\Parsers\Casters\CasterInterface;
use ImmediateSolutions\Support\Api\Parsers\Casters\EnumCaster;
use ImmediateSolutions\Support\Api\Parsers\Casters\EnumCollectionCaster;
use ImmediateSolutions\Support\Api\Parsers\Casters\FloatCaster;
use ImmediateSolutions\Support\Api\Parsers\Casters\IntCaster;
use ImmediateSolutions\Support\Api\Parsers\Casters\PassCaster;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class FormParser implements ParserInterface
{
    /**
     * @var array
     */
    private $schema;

    /**
     * @param array $schema
     */
    public function __construct(array $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @param string $contentType
     * @param array|string $content
     * @return bool
     */
    public function canParse($contentType, $content)
    {
        return in_array($contentType,
                ['application/x-www-form-urlencoded', 'multipart/form-data']) && is_array($content);
    }

    /**
     * @param string $contentType
     * @param string|array $content
     * @return array
     */
    public function parse($contentType, $content)
    {
        return $this->castData($content);
    }

    /**
     * @param array $data
     * @return array
     */
    private function castData($data)
    {
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
        /**
         * @var CasterInterface[] $casters
         */
        $casters = [
            new EnumCaster(),
            new EnumCollectionCaster(),
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