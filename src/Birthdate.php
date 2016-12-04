<?php
/**
 * Birthdate Validation
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2016 Jacques Marneweck.  All rights strictly reserved.
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
            if ($date->toDateString() === $birthdate) {
                $bits = explode("-", $birthdate);
                if (checkdate($bits['1'], $bits['2'], $bits['0'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    public static function is_valid_for_id($birthdate, $id)
    {
        $match = preg_match("!^(\d{2})(\d{2})(\d{2})\d\d{6}$!", $id, $matches);
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
            if ($date->toDateString() === $birthdate) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
