<?php
namespace ImmediateSolutions\Support\Api\Inbound\DataProviders;

use ImmediateSolutions\Support\Api\Inbound\DataProviders\DataProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class EmptyDataProvider implements DataProviderInterface
{
    /**
     * @return array
     */
    public function getData()
    {
        return [];
    }
}