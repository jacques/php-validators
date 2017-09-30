<?php
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
 * @copyright 2002-2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators;

use Carbon\Carbon;

class AsylumExpirationTest
{
    public static function is_valid($asylum_expiration_date = null)
    {
        if (is_null($asylum_expiration_date)) {
            throw new \InvalidArgumentException('Please pass in the date that the asylum document expires on.');
        }

        if (empty(trim($asylum_expiration_date))) {
            throw new \InvalidArgumentException('Please pass in the date that the asylum document expires on.');
        }

        /**
         * Rule from Tim here is that he wants a asylum document to still be used
         * to register a user on the date their asylum document expires.
         */
        try {
            $date = Carbon::createFromFormat('Y-m-d', $asylum_expiration_date, 'UTC')->startOfDay();
            if ($date->toDateString() === $asylum_expiration_date) {
                $now = Carbon::now()->startOfDay();
                if ($date->gte($now)) {
                    return true;
                }
            }
        } catch (\Exception $e) {
            if ('Data missing' == $e->getMessage()) {
                throw new \Exception('Please provide a asylum expiration data in YYYY-MM-DD format.');
            }
        }

        return false;
    }
}
