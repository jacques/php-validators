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

use Carbon\Carbon;
use Jacques\Validators\AsylumExpirationDate;

class AsylumExpirationTest extends \PHPUnit_Framework_TestCase
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
     * @expectedExceptionMessage Please pass in the date that the asylum document expires on.
     */
    public function testNullDate()
    {
        \Jacques\Validators\AsylumExpirationDate::is_valid();
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionCode    0
     * @expectedExceptionMessage Please pass in the date that the asylum document expires on.
     */
    public function testNullDateWithNull()
    {
        \Jacques\Validators\AsylumExpirationDate::is_valid(null);
    }

    public function testExpiredAsylums()
    {
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-01-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-12-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-12-06'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-01-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-12-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-12-06'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2017-01-01'));
    }

    public function testExpirationOn()
    {
        $knownDate = Carbon::create(2015, 01, 01, 12);          // create testing date
        Carbon::setTestNow($knownDate);

        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2014-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-01-01'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2017-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2018-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2019-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2020-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2021-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2022-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2023-12-31'));

        $knownDate = Carbon::create(2016, 01, 01, 12);          // create testing date
        Carbon::setTestNow($knownDate);

        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2014-12-31'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-01-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2017-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2018-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2019-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2020-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2021-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2022-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2023-12-31'));

        $knownDate = Carbon::create(2016, 12, 31, 12);          // create testing date
        Carbon::setTestNow($knownDate);

        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2014-12-31'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-01-01'));
        $this->assertFalse(\Jacques\Validators\AsylumExpirationDate::is_valid('2015-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2016-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2017-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2018-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2019-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2020-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2021-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2022-12-31'));
        $this->assertTrue(\Jacques\Validators\AsylumExpirationDate::is_valid('2023-12-31'));
        Carbon::setTestNow();
    }
}
