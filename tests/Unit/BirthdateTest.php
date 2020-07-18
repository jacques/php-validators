<?php declare(strict_types=1);
/**
 * PHP Validators
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Birthdate;

class BirthdateTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testValidBirthdates(): void
    {
        $this->assertTrue(Birthdate::is_valid('1972-01-27'));
        $this->assertTrue(Birthdate::is_valid('1980-07-07'));
        $this->assertTrue(Birthdate::is_valid('1980-08-31'));
        $this->assertTrue(Birthdate::is_valid('2012-02-29'));
        $this->assertTrue(Birthdate::is_valid('2014-02-28'));
    }

    public function testInvalidBirthdates(): void
    {
        $this->assertFalse(Birthdate::is_valid('2011-02-29'));
        $this->assertFalse(Birthdate::is_valid('2013-02-29'));
        $this->assertFalse(Birthdate::is_valid('2014-02-29'));
        $this->assertFalse(Birthdate::is_valid('2015-02-29'));
        $this->assertFalse(Birthdate::is_valid('2015-08-32'));
        $this->assertFalse(Birthdate::is_valid('2015-12-33'));
        $this->assertFalse(Birthdate::is_valid('2015/01/33'));
    }

    public function testValidBirtdateForIds(): void
    {
        $this->assertTrue(Birthdate::is_valid_for_id('1963-11-02', '6311025071080'));
        $this->assertTrue(Birthdate::is_valid_for_id('1964-04-18', '6404185244082'));
        $this->assertTrue(Birthdate::is_valid_for_id('1962-03-28', '6203280010087'));
        $this->assertTrue(Birthdate::is_valid_for_id('2008-12-28', '0812280118082'));
    }

    public function testInvalidBirtdateForIds(): void
    {
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
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-30', '033333123413134'));
        $this->assertFalse(Birthdate::is_valid_for_id('1962-03-30', '03ZZ333123413134'));
    }
};
