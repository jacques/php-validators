<?php
/**
 * Identification Validation
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators;

use Carbon\Carbon;

class Gender
{
    /**
     * Checks that the users gender matches either f or m.
     *
     * gender is either:
     *   - f - female
     *   - m - gender
     *
     * @param string  $gender
     *
     * @throws \InvalidArgumentException
     *
     * @return bool   true if is valid else false
     */
    public static function is_valid($gender = null)
    {
        if (is_null($gender)) {
            throw new \InvalidArgumentException('Please enter a valid gender.');
        }

        if (empty($gender) || strlen($gender) > 1) {
            return false;
        }

        if (is_numeric($gender)) {
            return false;
        }

        return in_array($gender, ['f', 'm']);
    }
}
