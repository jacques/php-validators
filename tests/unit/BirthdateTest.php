<?php
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2016 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Birthdate;

class BirthdateTest extends \PHPUnit_Framework_TestCase {
    protected function setUp() {
    }

    protected function tearDown() {
    }

    public function testValidBirthdates() {
        $this->assertTrue(Birthdate::is_valid('1972-01-27'));
        $this->assertTrue(Birthdate::is_valid('1980-07-07'));
        $this->assertTrue(Birthdate::is_valid('1980-08-31'));
        $this->assertTrue(Birthdate::is_valid('2012-02-29'));
        $this->assertTrue(Birthdate::is_valid('2014-02-28'));
    }

    public function testInvalidBirthdates() {
        $this->assertFalse(Birthdate::is_valid('2011-02-29'));
        $this->assertFalse(Birthdate::is_valid('2013-02-29'));
        $this->assertFalse(Birthdate::is_valid('2014-02-29'));
        $this->assertFalse(Birthdate::is_valid('2015-02-29'));
        $this->assertFalse(Birthdate::is_valid('2015-08-32'));
        $this->assertFalse(Birthdate::is_valid('2015-12-33'));
    }

    public function testValidBirtdateForIds() {
        $this->assertTrue(Birthdate::is_valid_for_id('1963-11-02', '6311025071080'));
        $this->assertTrue(Birthdate::is_valid_for_id('1964-04-18', '6404185244082'));
        $this->assertTrue(Birthdate::is_valid_for_id('1962-03-28', '6203280010087'));
    }

    public function testInvalidBirtdateForIds() {
        $this->assertFalse(Birthdate::is_valid_for_id('1963-11-01', '6311025071080'));
        $this->assertFalse(Birthdate::is_valid_for_id('1963-11-03', '6311025071080'));
        $this->assertFalse(Birthdate::is_valid_for_id('1964-04-17', '6404185244082'));
        $this->assertFalse(Birthdate::is_valid_for_id('1964-04-19', '6404185244082'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-01', '6203280010087'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-27', '6203280010087'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-29', '6203280010087'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-30', '6203280010087'));
        $this->assertFalse(Birthdate::is_valid_for_id('62-99-99', '6203280010087'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-30', 'MA123456'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-30', 'MA123456'));
    }
};
