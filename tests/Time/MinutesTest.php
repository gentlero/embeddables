<?php
/**
 * Copyright 2016 Alexandru Guzinschi <alex@gentle.ro>.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */
namespace Gentle\Embeddable\Test\Time;

use Gentle\Embeddable\Time\Minutes;
use Gentle\Embeddable\Test\TestCase;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
class MinutesTest extends TestCase
{
    /**
     * @param string|int $value
     *
     * @dataProvider validMinutesProvider
     */
    public function testInstantiateSuccess($value)
    {
        $minutes = new Minutes($value);
        $this->assertInstanceOf('Gentle\Embeddable\Time\Minutes', $minutes);
    }

    /**
     * @param string|int $value
     *
     * @dataProvider invalidMinutesProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInstantiateError($value)
    {
        new Minutes($value);
    }

    /**
     * @param string|int $value
     *
     * @dataProvider invalidMinutesRangeProvider
     * @expectedException \OutOfRangeException
     */
    public function testMinutesRangeError($value)
    {
        new Minutes($value);
    }

    /**
     * @param string|int $value
     *
     * @dataProvider validMinutesProvider
     */
    public function testEqualityByValue($value)
    {
        $minutes1 = new Minutes($value);
        $minutes2 = new Minutes($value);

        $this->assertTrue($minutes1->equals($minutes2));
        $this->assertNotSame($minutes1, $minutes2);
    }

    /**
     * @return array
     */
    public function validMinutesProvider()
    {
        return [
            ['04'], [2], ['12'], ['8'], ['09'], ['00'], [0]
        ];
    }

    /**
     * @return array
     */
    public function invalidMinutesProvider()
    {
        return [
            ['aa4b'], ['not valid'], ['43.12'], ['14.1'], ['43,01'], [new \stdClass()], ['4321a'], [['3412']], ['3.14']
        ];
    }

    public function invalidMinutesRangeProvider()
    {
        return [
            [999], [312], ['034'], ['100'], [60], ['61']
        ];
    }
}