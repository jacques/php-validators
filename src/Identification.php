<?php
/**
 * Identification Validation
 *
 * @author    Jacques Marneweck <jacques@powertrip.co.za>
 * @copyright 2015-2016 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Validators;

use Carbon\Carbon;

class Identification
{
    /**
     * Checks that a identification number is theoretically valid.  It does not
     * validate that the identification number actually belongs to a human.
     *
     * id_type is either:
     *   - 1 - South African Identification Number
     *   - 2 - Passport
     *   - 3 - South African Asylum Document Number
     *
     * @param string  $id_document_number Document Number of the document
     * @param integer $id_type Identification Document Type
     *
     * @throws \InvalidArgumentException
     *
     * @return bool   true if is theoretically valid else false
     */
    public static function is_valid($id_document_number = null, $id_type = null)
    {
        if (is_null($id_document_number)) {
            throw new \InvalidArgumentException('Please enter a valid id document number.');
        }

        if (is_null($id_type)) {
            throw new \InvalidArgumentException('Please pass in a valid id type for the id document number you are testing.');
        }

        if (!is_numeric($id_type)) {
            throw new \InvalidArgumentException('Please pass in a numeric value for the id type wanting to be tested.');
        }

        $id_type = (int)$id_type;

        if ($id_type < 1 || $id_type > 3) {
            throw new \InvalidArgumentException('Please enter a numeric value for the id type.  1 == ZA ID / 2 == Passport / 3 == ZA Asylum');
        }

        if (1 == $id_type) {
            if (!ctype_digit($id_document_number)) {
                return false;
            }

            $idvalid = \PayBreak\Luhn\Luhn::validateNumber($id_document_number);

            return ($idvalid);
        }

        /**
         * Passport numbers are either like MA123456 or 12345678.
         */
        if (2 == $id_type) {
            if (mb_strlen($id_document_number) < 8) {
                return false;
            }

            return true;
        }

        /**
         * South African Asylum Document Numbers
         */
        if (3 == $id_type) {
            if (mb_strlen($id_document_number) < 8) {
                return false;
            }

            return true;
        }
        return false;
    }
}
