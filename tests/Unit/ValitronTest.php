<?php declare(strict_types=1);
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Valitron;
use \Valitron\Validator;

class ValitronTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testValitron(): void
    {
        Valitron::addRules();

        $expected = [
            'msisdn' => [
                'Msisdn must be a valid Namibian Mobile Number',
            ],
        ];
        $v = new Validator(array('msisdn' => '27111234567'));
        $v->rule('na_mobile_number', 'msisdn');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('msisdn' => '27831234567'));
        $v->rule('na_mobile_number', 'msisdn');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('msisdn' => '26461123456'));
        $v->rule('na_mobile_number', 'msisdn');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [];
        $v = new Validator(array('msisdn' => '264601234567'));
        $v->rule('na_mobile_number', 'msisdn');
        self::assertTrue($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('msisdn' => '264811234567'));
        $v->rule('na_mobile_number', 'msisdn');
        self::assertTrue($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => 'SOMETHING'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());

        $expected = [
            'id_document_number' => [
                'Id Document Number must be a valid South African Identity Number',
            ],
        ];
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => 'MA123456'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => 'CTRPTA123456'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        /**
         * Natalie Faye Webb's ID with a invalid check digit.
         */
        $v = new Validator(array('id_document_number' => '8510290194080'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194081'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194082'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194084'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194085'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194086'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194087'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194088'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '8510290194089'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('id_document_number' => '9007263637083'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [];
        $v = new Validator(array('id_document_number' => '8510290194083'));
        $v->rule('za_identity_number', 'id_document_number');
        self::assertTrue($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [
            'msisdn' => [
                'Msisdn must be a valid South African Mobile Number',
            ],
        ];
        $v = new Validator(array('msisdn' => '27111234567'));
        $v->rule('za_mobile_number', 'msisdn');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [];
        $v = new Validator(array('msisdn' => '27831234567'));
        $v->rule('za_mobile_number', 'msisdn');
        self::assertTrue($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [
            'street1' => [
                'Street1 must be a physical street address',
            ],
        ];
        $v = new Validator(array('street1' => 'P.O. Box 9'));
        $v->rule('street_address', 'street1');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('street1' => 'PO. Box 70'));
        $v->rule('street_address', 'street1');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('street1' => 'PO Box 33'));
        $v->rule('street_address', 'street1');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $v = new Validator(array('street1' => 'Private Bag X123'));
        $v->rule('street_address', 'street1');
        self::assertFalse($v->validate());
        self::assertEquals($expected, $v->errors());

        $expected = [];
        $v = new Validator(array('street1' => '1 Main Road'));
        $v->rule('street_address', 'street1');
        self::assertTrue($v->validate());
        self::assertEquals($expected, $v->errors());
    }
}
