<?php
/**
 * Validations reworked for use with Valitron.
 *
 * @author Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2002-2018 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\Validators;

use Carbon\Carbon;

class Valitron
{
    public function addrules()
    {
        /**
         * Validate the possibility of the South African Identity Number beng a valid South
         * African identity number.
         */
        \Valitron\Validator::addRule('za_identity_number', function($field, $value, array $params, array $fields) {
            if (!ctype_digit($value)) {
                return false;
            }

            $match = preg_match("!^(\d{2})(\d{2})(\d{2})\d\d{6}$!", $value, $matches);
            if (!$match) {
                return false;
            }
            list (, $year, $month, $day) = $matches;

            /**
             * Check citizenship of the users id (0 = .za, 1 = permanent resident)
             */
            if (!in_array($value{10}, array(0, 1))) {
                return false;
            }

            /**
             * Seen 8 or 9 here.
             */
            if (!in_array($value{11}, [8, 9])) {
                return false;
            }

            $idvalid = \PayBreak\Luhn\Luhn::validateNumber($value);

            return ($idvalid);
        }, 'must be a valid South African Identity Number');

        /**
         * Validate the possibility of a mobile number being a valid South African Mobile Number.
         */
        \Valitron\Validator::addRule('za_mobile_number', function($field, $value, array $params, array $fields) {
            $msisdn = str_replace(array(' ', '-', '(', ')'), '', $value);
            $country = 'ZA';

            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            try {
                $phoneNumberProto = $phoneUtil->parse($msisdn, $country);
            } catch (\libphonenumber\NumberParseException $e) {
                return false;
            }

            if (!$phoneUtil->isValidNumber($phoneNumberProto)) {
                return false;
            }

            if (
                !in_array(
                    $phoneUtil->getNumberType($phoneNumberProto),
                    [
                        1,
                        2,
                    ]
                )
            ) {
                return false;
            }

            if (
                !is_null($country)
            ) {
                if ($country == $phoneUtil->getRegionCodeForNumber($phoneNumberProto)) {
                    return true;
                }

                return false;
            }

            return true;
        }, 'must be a valid South African Mobile Number');
    }
}
