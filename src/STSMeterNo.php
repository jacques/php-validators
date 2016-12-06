<?php
/**
 * STS Meter Number Validation
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2016 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators;

class SMSMeterNo
{
    public static function is_valid($meter_no)
    {
        $metervalid = \PayBreak\Luhn\Luhn::validateNumber($meter_no);

        return ($metervalid);
    }
}
