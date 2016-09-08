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
 * Trait StaticCreate
 *
 * This trait makes active record classes creatable new static create method.
 *
 * @package Ansas\Propel\Helper
 * @author  Ansas Meyer <mail@ansas-meyer.de>
 */
trait StaticCreate
{
    /**
     * Create new instance.
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }
}
