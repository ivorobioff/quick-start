<?php
namespace ImmediateSolutions\Support\Tests\Api;

use ImmediateSolutions\Support\Api\AbstractParsableProcessor;
use ImmediateSolutions\Support\Validation\Rules\Enum;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class ParsableProcessorTest extends TestCase
{
    public function testCastData()
    {
        $processor = $this->createProcessorMock([
            'field1' => 'some text',

            'field2a' => 'yes',
            'field2b' => 'no',
            'field2c' => '1',
            'field2d' => '0',
            'field2e' => 'true',
            'field2f' => 'false',

            'field3' => '2017-06-21T02:47:44-04:00',
            'field4' => '56',
            'field5' => '7.99',
            'field6' => 'value2',
            'field7' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
        ], 'application/x-www-form-urlencoded');

        $data = $processor->getData();

        Assert::assertEquals('some text', $data['field1']);
        Assert::assertEquals(true, $data['field2a']);
        Assert::assertEquals(false, $data['field2b']);
        Assert::assertEquals(true, $data['field2c']);
        Assert::assertEquals(false, $data['field2d']);
        Assert::assertEquals(true, $data['field2e']);
        Assert::assertEquals(false, $data['field2f']);

        Assert::assertEquals('2017-06-21T02:47:44-04:00', $data['field3']);
        Assert::assertTrue($data['field4'] === 56);
        Assert::assertTrue($data['field5'] === 7.99);
        Assert::assertEquals('value2', $data['field6']);
        Assert::assertEquals('test1', $data['field7']['test1']);
        Assert::assertEquals('test2', $data['field7']['test2']);

        $processor = $this->createProcessorMock(json_encode([
            'field1' => 'some text',
            'field2a' => true,
            'field2b' => false,
            'field3' => '2017-06-21T02:47:44-04:00',
            'field4' => 56,
            'field5' => 7.99,
            'field6' => 'value2',
            'field7' => [
                'test1' => 'test1',
                'test2' => 'test2'
            ]
        ]), 'application/json');

        $data = $processor->getData();

        Assert::assertEquals('some text', $data['field1']);
        Assert::assertEquals(true, $data['field2a']);
        Assert::assertEquals(false, $data['field2b']);

        Assert::assertEquals('2017-06-21T02:47:44-04:00', $data['field3']);
        Assert::assertTrue($data['field4'] === 56);
        Assert::assertTrue($data['field5'] === 7.99);
        Assert::assertEquals('value2', $data['field6']);
        Assert::assertEquals('test1', $data['field7']['test1']);
        Assert::assertEquals('test2', $data['field7']['test2']);
    }


    /**
     * @param array|string $content
     * @return AbstractParsableProcessor
     */
    private function createProcessorMock($content, $contentType)
    {
        return new class($content, $contentType) extends AbstractParsableProcessor {

            /**
             * @var array|string
             */
            private $content;

            /**
             * @var string
             */
            private $contentType;

            public function __construct($content, $contentType)
            {
                $this->content = $content;
                $this->contentType = $contentType;
            }

            protected function schema()
            {
                return [
                    'field1' => 'string',
                    'field2a' => 'bool',
                    'field2b' => 'bool',
                    'field2c' => 'bool',
                    'field2d' => 'bool',
                    'field2e' => 'bool',
                    'field2f' => 'bool',
                    'field3' => 'datetime',
                    'field4' => 'int',
                    'field5' => 'float',
                    'field6' => new Enum(get_class(new class('value2') extends \ImmediateSolutions\Support\Other\Enum {
                        const VALUE_1 = 'value1';
                        const VALUE_2 = 'value2';
                    })),
                    'field7' => 'array'
                ];
            }

            /**
             * @return string|array
             */
            protected function getContent()
            {
                return $this->content;
            }

            /**
             * @return string
             */
            protected function getContentType()
            {
                return $this->contentType;
            }
        };
    }
}