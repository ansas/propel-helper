<?php

/**
 * This file is part of the PropelHelper package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Ansas\Propel\Helper;

use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Readonly
 *
 * This trait is a workaround for the bug when setting tables to
 * <code>readOnly="true"</code> in Propel's schema.xml and still
 * wanting to use the <code>joinWith()</code> methods
 *
 * @see: https://github.com/propelorm/Propel2/issues/629
 *
 * @author Ansas Meyer <webmaster@ansas-meyer.de>
 */
trait Readonly
{
    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws PropelException
     */
    public function delete(ConnectionInterface $con = null)
    {
        throw new PropelException("This is a readonly object.");
    }

    /**
     * Persists this object to the database.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     */
    public function save(ConnectionInterface $con = null)
    {
        throw new PropelException("This is a readonly object.");
    }
}
