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
 * Readonly
 *
 * This trait is an other (more flexible, easier to use) approach to the
 * new validate behavior in Propel 2.x
 *
 * @see: http://propelorm.org/documentation/behaviors/validate.html
 *
 * @author Ansas Meyer <webmaster@ansas-meyer.de>
 */
trait Validation
{
    /**
     * The error list.
     * @var array
     */
    private $validationErrors = array();

    /**
     * Add an error to error list
     *
     * @param $key
     * @param $value
     * @param $overwrite (optional)
	 * @return $this (for fluent API support)
     */
    protected function addValidationError($key, $value, $overwrite = true)
    {
    	if ($overwrite or !isset($this->validationErrors[$key])) {
        	$this->validationErrors[$key] = $value;
        }
        return $this;
	}

    /**
     * resets validation errors
     *
     * @return void
     */
	protected function clearValidationErrors()
	{
		$this->validationErrors = array();
	}

    /**
     * Get an error list
     *
     * @return array error list
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
	}

    /**
     * Check if there are validation errors
     *
     * @return bool
     */
	public function hasValidationErrors()
	{
		return count($this->getValidationErrors()) != 0;
	}

    /**
     * In this method we check for errors
     *
     * @return bool
     */
    abstract public function isValid();
}
