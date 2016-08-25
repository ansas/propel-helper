<?php
/**
 * This file is part of the "Propel Helper" package.
 *
 * For the full copyright and license information, please view the LICENSE.md file distributed with this source code.
 *
 * @license MIT License
 * @link    https://github.com/ansas/propel-helper
 */

namespace Ansas\Propel\Helper;

use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Trait Readonly
 *
 * This trait is a workaround for the bug when setting tables to <code>readOnly="true"</code> in Propel's schema.xml
 * and still wanting to use the <code>joinWith()</code> methods
 *
 * @see     https://github.com/propelorm/Propel2/issues/629
 *
 * @package Ansas\Propel\Helper
 * @author  Ansas Meyer <mail@ansas-meyer.de>
 */
trait Readonly
{
    /**
     * @inheritDoc
     */
    public function delete(ConnectionInterface $con = null)
    {
        throw new PropelException("This is a readonly object.");
    }

    /**
     * @inheritDoc
     */
    public function save(ConnectionInterface $con = null)
    {
        throw new PropelException("This is a readonly object.");
    }
}
