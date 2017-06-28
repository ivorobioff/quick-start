<?php
namespace ImmediateSolutions\Support\Api\Inbound;

use ImmediateSolutions\Support\Api\Inbound\Casters\BoolCaster;
use ImmediateSolutions\Support\Api\Inbound\Casters\CasterInterface;
use ImmediateSolutions\Support\Api\Inbound\Casters\FloatCaster;
use ImmediateSolutions\Support\Api\Inbound\Casters\IntCaster;
use ImmediateSolutions\Support\Api\Inbound\DataProviders\DataProviderInterface;
use ImmediateSolutions\Support\Api\Inbound\DataProviders\EmptyDataProvider;
use ImmediateSolutions\Support\Api\Inbound\DataProviders\FormDataProvider;
use ImmediateSolutions\Support\Api\Inbound\DataProviders\JsonDataProvider;


/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class AbstractFormProcessor extends AbstractDataProviderProcessor
{
    /**
     * @return DataProviderInterface
     */
   protected function getDataProvider()
   {
       if (in_array($this->getContentType(), ['application/x-www-form-urlencoded', 'multipart/form-data'])){
           return new FormDataProvider($this->getUnprocessedData(), $this->schema(), $this->getCasters());
       }

       if ($this->getContentType() === 'application/json'){
           return new JsonDataProvider($this->getUnprocessedData());
       }

       return new EmptyDataProvider();
   }

    /**
     * @return CasterInterface[]
     */
   protected function getCasters()
   {
       return [
           new BoolCaster(),
           new FloatCaster(),
           new IntCaster()
       ];
   }

    /**
     * @return array|string
     */
    abstract protected function getUnprocessedData();

    /**
     * @return string
     */
    abstract protected function getContentType();
}