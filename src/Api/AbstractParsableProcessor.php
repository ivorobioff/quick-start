<?php
namespace ImmediateSolutions\Support\Api;

use ImmediateSolutions\Support\Api\Parsers\EmptyParser;
use ImmediateSolutions\Support\Api\Parsers\FormParser;
use ImmediateSolutions\Support\Api\Parsers\JsonParser;
use ImmediateSolutions\Support\Api\Parsers\ParserInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractParsableProcessor extends AbstractProcessor
{
    /**
     * @var array
     */
    private $data;

    /**
     * @return array
     */
    public function getData()
    {
        if ($this->data === null){
            $this->data = $this->findParser()->parse($this->getContentType(), $this->getContent());
        }

        return $this->data;
    }

    /**
     * @return ParserInterface[]
     */
    protected function getParsers()
    {
        return [
            new JsonParser(),
            new FormParser($this->schema())
        ];
    }

    /**
     * @return ParserInterface
     */
    private function findParser()
    {
        foreach ($this->getParsers() as $parser){
            if ($parser->canParse($this->getContentType(), $this->getContent())){
                return $parser;
            }
        }

        return new EmptyParser();
    }

    /**
     * @return string|array
     */
    abstract protected function getContent();

    /**
     * @return string
     */
    abstract protected function getContentType();
}