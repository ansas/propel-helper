<?php
/**
 * This file is part of the Propel helper.
 *
 * For the full copyright and license information, please view the LICENSE.md file distributed with this source code.
 *
 * @license MIT License
 * @link    https://github.com/ansas/propel-helper
 */

namespace Ansas\Propel\Helper;

/**
 * Trait Validation
 *
 * This trait is an other (more flexible, easier to use) approach to the new validate behavior in Propel 2.x
 *
 * @see     http://propelorm.org/documentation/behaviors/validate.html
 *
 * @package Ansas\Propel\Helper
 * @author  Ansas Meyer <mail@ansas-meyer.de>
 */
trait Validation
{
    /**
     * @var array The error list
     */
    private $validationErrors = [];

    /**
     * Get the error list.
     *
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * Check if there are validation errors.
     *
     * @return bool
     */
    public function hasValidationErrors()
    {
        return !!count($this->getValidationErrors());
    }

    /**
     * In this method we check for errors.
     *
     * This method adds errors to the list via <code>$this->addValidationError('name', 'invalid');<code> and the
     * implemented method should return <code>return !$this->hasValidationErrors();<code>.
     *
     * @return bool
     */
    abstract public function isValid();

    /**
     * Add an error to error list
     *
     * @param $key
     * @param $value
     * @param $overwrite [optional]
     *
     * @return $this
     */
    protected function addValidationError($key, $value, $overwrite = true)
    {
        if ($overwrite || !isset($this->validationErrors[$key])) {
            $this->validationErrors[$key] = $value;
        }

        return $this;
    }

    /**
     * Resets validation errors.
     *
     * @return $this
     */
    protected function clearValidationErrors()
    {
        $this->validationErrors = [];

        return $this;
    }
}
