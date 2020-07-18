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
 * @copyright 2015-2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators\Tests\Unit;

use \Jacques\Validators\Gender;

class GenderTest extends \PHPUnit\Framework\TestCase
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
        $this->expectExceptionMessage('Please enter a valid gender.');
        $this->assertTrue(Gender::is_valid());
    }

    public function testValidGenders(): void
    {
        $this->assertTrue(Gender::is_valid('f'));
        $this->assertTrue(Gender::is_valid('m'));
    }

    public function testInvalidGenderNumbers(): void
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
