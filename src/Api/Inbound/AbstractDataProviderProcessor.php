<?php
namespace ImmediateSolutions\Support\Api\Inbound;

use ImmediateSolutions\Support\Api\AbstractProcessor;
use ImmediateSolutions\Support\Api\Inbound\DataProviders\DataProviderInterface;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractDataProviderProcessor extends AbstractProcessor
{
    /**
     * @var array
     */
    private $providedData;

    /**
     * @return array
     */
    public function getData()
    {
        if ($this->providedData === null){
            $this->providedData = $this->getDataProvider()->getData();
        }

        return $this->providedData;
    }

    /**
     * @return DataProviderInterface
     */
    abstract protected function getDataProvider();
}