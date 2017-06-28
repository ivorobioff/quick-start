<?php
namespace ImmediateSolutions\Support\Api\Inbound\DataProviders;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface DataProviderInterface
{
    /**
     * @return array
     */
    public function getData();
}