<?php declare(strict_types=1);
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Identification;

class IdentificationTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testWithoutPassingArguments(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please enter a valid id document number.');
        $this->assertTrue(Identification::is_valid());
    }

    public function testWithoutPassingIdType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please pass in a valid id type for the id document number you are testing.');
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM'));
    }

    public function testWithNonNumericIdType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please pass in a numeric value for the id type wanting to be tested.');
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', 'SOMETHINGRANDOM'));
    }

    public function testWithNumericIdTypeOfZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum');
        Identification::is_valid('SOMETHINGRANDOM', '0');
    }

    public function testWithNumericIdTypeOfFour(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum');
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', '4'));
    }

    public function testWithNumericIdTypeOfNine(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode('0');
        $this->expectExceptionMessage('Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum');
        $this->assertTrue(Identification::is_valid('SOMETHINGRANDOM', '9'));
    }

    public function testValidSouthAfricanIdentificationNumbers(): void
    {
        $this->assertTrue(Identification::is_valid('8510290194083', 1), 'Natalie Faye Webb - from EWN');
    }

    public function testInvalidIdentificationNumbers(): void
    {
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
