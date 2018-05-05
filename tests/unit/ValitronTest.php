<?php
/**
 * PHP Validators
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2018 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Valitron;
use \Valitron\Validator;

class ValitronTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testValitron()
    {
        Valitron::addRules();

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
    }
}
