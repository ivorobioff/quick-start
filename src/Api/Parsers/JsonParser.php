<?php
namespace ImmediateSolutions\Support\Api\Parsers;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class JsonParser implements ParserInterface
{
    /**
     * @param string $contentType
     * @param string|array $content
     * @return bool
     */
    public function canParse($contentType, $content)
    {
        return $contentType === 'application/json' && is_string($content);
    }

    /**
     * @param string $contentType
     * @param string|array $content
     * @return array
     */
    public function parse($contentType, $content)
    {
        $json = json_decode($content, true);

        return $json ? $json : [];
    }
}