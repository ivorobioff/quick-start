<?php
namespace ImmediateSolutions\Support\Api\Parsers;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EmptyParser implements ParserInterface
{
    /**
     * @param string $contentType
     * @param array|string $content
     * @return bool
     */
    public function canParse($contentType, $content)
    {
        return true;
    }

    /**
     * @param string $contentType
     * @param string|array $content
     * @return array
     */
    public function parse($contentType, $content)
    {
        return [];
    }
}