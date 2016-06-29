<?php
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2016 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Identification;

class IdentificationTest extends \PHPUnit_Framework_TestCase {
    protected function setUp() {
    }

    protected function tearDown() {
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please enter a valid id document number.
     */
    public function testWithoutPassingArguments() {
        $this->assertTrue(Identification::is_valid());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please pass in a valid id type for the id document number you are testing.
     */
    public function testWithoutPassingIdType() {
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM'));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please pass in a numeric value for the id type wanting to be tested.
     */
    public function testWithNonNumericIdType() {
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', 'SOMETHINGRANDOM'));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum
     */
    public function testWithNumericIdTypeOfZero() {
        Identification::is_valid('SOMETHINGRANDOM', '0');
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum
     */
    public function testWithNumericIdTypeOfFour() {
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', '4'));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum
     */
    public function testWithNumericIdTypeOfNine() {
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', '9'));
    }

    public function testValidSouthAfricanIdentificationNumbers() {
        $this->assertTrue(Identification::is_valid('8510290194083', 1), 'Natalie Faye Webb - from EWN');
    }

    public function testInvalidIdentificationNumbers() {
        $this->assertFalse(Identification::is_valid('2015-12-33', 1));
        $this->assertFalse(Identification::is_valid('2015-12-33', 1));
        $this->assertFalse(Identification::is_valid('MA123456', 1));

        $this->assertFalse(Identification::is_valid('8510290194080', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194081', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194082', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194084', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194085', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194086', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194087', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194088', 1), 'Natalie Faye Webb - invalid check digit');
        $this->assertFalse(Identification::is_valid('8510290194089', 1), 'Natalie Faye Webb - invalid check digit');

        $this->assertFalse(Identification::is_valid('9007263637083', 1), 'Fake ID from Compuscan');
    }
};
