<?php

/**
 * This file is part of the PropelHelper package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace PropelHelper;

/**
 * ConvertToNull
 *
 * This trait can be used to "sanitize values" by setting empty values to null.
 *
 * It holds methods which can be called in order to check if a field is empty 
 * and set it to "null" before calling the parent setter method. By doing this
 * we have a more cleaned up object and also prevent e. g. the "versionable"
 * behavior from adding a new version (as "" !== null).
 *
 * @author Ansas Meyer <webmaster@ansas-meyer.de>
 */
trait ConvertToNull
{
    /**
     * Set empty $value to null 
     *
     * @param mixed $value Value to sanitize
     * @param array $considerNull (optional) Values to convert to null
     * @return mixed Sanitized value
     */
    protected function convertEmptyToNull($value, array $considerNull = [''])
    {
        return $this->convertToNull($value, $considerNull);
    }

    /**
     * Set $value to null if matching one of the values of $considerNull list
     *
     * Check on string values is case insensitive (so 'Null' is seen as 'null').
     *
     * @param mixed $value Value to sanitize
     * @param array $considerNull Values to convert to null
     * @return mixed Sanitized value
     */
    protected function convertToNull($value, array $considerNull)
    {
        if ($value !== null) {
            $compareOriginal = $value;
            if (is_string($compareOriginal)) {
                $compareOriginal = mb_strtolower($compareOriginal);
            }
            foreach ($considerNull as $compareNull) {
                if (is_string($compareNull)) {
                    $compareNull = mb_strtolower($compareNull);
                }
                if ($compareOriginal === $compareNull) {
                    $value = null;
                    break;
                }
            }
        }
        return $value;
    }

    /**
     * Trim $value and also set empty $value to null
     *
     * @param mixed $value Value to sanitize
     * @param array $considerNull (optional) Values to convert to null
     * @return mixed Sanitized value
     */
        protected function trimAndConvertEmptyToNull($value, array $considerNull = [''])
    {
        return $this->trimAndConvertToNull($value, $considerNull);
    }

    /**
     * Trim $value and set to null if matching one of the values of $considerNull list
     *
     * @param mixed $value Value to sanitize
     * @param array $considerNull Values to convert to null
     * @return mixed Sanitized value
     */
    protected function trimAndConvertToNull($value, array $considerNull)
    {
        if (is_string($value)) {
            $value = trim($value);
        }
        return $this->convertToNull($value, $considerNull);
    }
}
