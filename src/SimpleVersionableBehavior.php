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

/**
 * Trait SimpleVersionableBehavior
 *
 * The default behavior "versionable" does not seem to work well with relations and in combination with other behaviors.
 * Therefore I wrote a "simple trait" that does NOT consider versions of related tables. All methods can be used as
 * before.
 *
 * Three things have to be implemented to use this trait:
 *
 * 1. Use the trait in the desired class
 * <code>use Ansas\Propel\Helper\SimpleVersionableBehaviorTrait;</code>
 *
 * 2. Add the following constant with the name of the versionable behavior active records class (e. g. for an 'Account')
 * <code>const VERSIONABLE_CLASS = 'AccountVersion';</code>
 *
 * 3. Optionally add the constant for column names (in default PhpName notation) to skip when populating object
 * <code>const VERSIONABLE_POPULATE_SKIP_COLUMNS = ['UpdatedAt', 'Version'];</code>
 *
 * @package Ansas\Propel\Helper
 * @author  Ansas Meyer <mail@ansas-meyer.de>
 */
trait SimpleVersionableBehavior
{
    /**
     * @inheritDoc
     */
    public function addVersion(ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $versionClass = static::VERSIONABLE_CLASS;
        $version      = new $versionClass();

        $tableMapClass = static::TABLE_MAP;
        $columns       = $tableMapClass::getFieldNames();

        foreach ($columns as $column) {
            $version->setByName($column, $this->getByName($column));
        }

        $version->save($con);

        return $version;
    }

    /**
     * @inheritDoc
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $tableMapClass = static::TABLE_MAP;
        $tableColumns  = $tableMapClass::getFieldNames();

        $skipColumns   = [];
        if (defined('static::VERSIONABLE_POPULATE_SKIP_COLUMNS')) {
            $skipColumns = static::VERSIONABLE_POPULATE_SKIP_COLUMNS;
        };

        foreach ($tableColumns as $column) {
            if (!in_array($column, $skipColumns)) {
                $this->setByName($column, $version->getByName($column));
            }
        }

        return $this;
    }
}
