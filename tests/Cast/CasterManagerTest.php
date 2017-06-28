<?php
namespace ImmediateSolutions\Support\Tests\Cast;

use ImmediateSolutions\Support\Cast\CasterManager;
use ImmediateSolutions\Support\Cast\Casters\BoolCaster;
use ImmediateSolutions\Support\Cast\Casters\FloatCaster;
use ImmediateSolutions\Support\Cast\Casters\IntCaster;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class CasterManagerTest extends TestCase
{
    public function testCasters()
    {
        $manager = new CasterManager();

        Assert::assertTrue(is_int($manager->cast('10', IntCaster::HINT)));
        Assert::assertEquals(10, $manager->cast('10', IntCaster::HINT));

        Assert::assertTrue(is_float($manager->cast('0.99', FloatCaster::HINT)));
        Assert::assertEquals(0.99, $manager->cast('0.99', FloatCaster::HINT));

        Assert::assertTrue($manager->cast('1', BoolCaster::HINT));
        Assert::assertFalse($manager->cast('0', BoolCaster::HINT));

        Assert::assertTrue($manager->cast(1, BoolCaster::HINT));
        Assert::assertFalse($manager->cast(0, BoolCaster::HINT));

        Assert::assertTrue($manager->cast('true', BoolCaster::HINT));
        Assert::assertFalse($manager->cast('false', BoolCaster::HINT));

        Assert::assertTrue($manager->cast('yes', BoolCaster::HINT));
        Assert::assertFalse($manager->cast('no', BoolCaster::HINT));

        Assert::assertTrue($manager->cast(true, BoolCaster::HINT));
        Assert::assertFalse($manager->cast(false, BoolCaster::HINT));

        Assert::assertEquals('test', $manager->cast('test', null));
    }
}