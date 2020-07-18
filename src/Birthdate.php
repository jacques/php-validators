<?php
/**
 * Birthdate Validation
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

namespace Jacques\Validators;

use Carbon\Carbon;

class Birthdate
{
    public static function is_valid($birthdate)
    {
        try {
            $date = Carbon::createFromFormat('Y-m-d', $birthdate, 'UTC');
            return $date->toDateString() === $birthdate;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function is_valid_for_id($birthdate, $id)
    {
        $match = preg_match("#^(\\d{2})(\\d{2})(\\d{2})\\d\\d{6}\$#", $id, $matches);
        if (!$match) {
            return false;
        }
        list(, $year, $month, $day) = $matches;
        /**
         * Check that the date is valid
         */
        if (!Birthdate::is_valid($birthdate)) {
            return false;
        }

        if ($year > 23) {
            $year += 1900;
        } else {
            $year += 2000;
        }

        try {
            $date = Carbon::createFromFormat('Y-m-d', vsprintf("%d-%d-%d", [$year, $month, $day]), 'UTC');
            return $date->toDateString() === $birthdate;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
