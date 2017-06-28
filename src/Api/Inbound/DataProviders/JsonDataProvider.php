<?php
namespace ImmediateSolutions\Support\Api\Inbound\DataProviders;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class JsonDataProvider implements DataProviderInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $json = json_decode($this->content, true);

        return $json ? $json : [];
    }
}