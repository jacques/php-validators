<?php
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Gender;

class GenderTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please enter a valid gender.
     */
    public function testWithoutPassingArguments()
    {
        $this->assertTrue(Gender::is_valid());
    }

    public function testValidGenders()
    {
        $this->assertTrue(Gender::is_valid('f'));
        $this->assertTrue(Gender::is_valid('m'));
    }

    public function testInvalidGenderNumbers()
    {
        foreach (range(0, 100) as $number) {
            $this->assertFalse(Gender::is_valid($number));
        }
        foreach (range('a', 'e') as $letter) {
            $this->assertFalse(Gender::is_valid($letter));
        }
        foreach (range('g', 'l') as $letter) {
            $this->assertFalse(Gender::is_valid($letter));
        }
        foreach (range('n', 'z') as $letter) {
            $this->assertFalse(Gender::is_valid($letter));
        }
        $this->assertFalse(Gender::is_valid(''));
        $this->assertFalse(Gender::is_valid('male'));
        $this->assertFalse(Gender::is_valid('female'));
    }
};
