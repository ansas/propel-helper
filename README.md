# Ansas\Propel\Helper

The "__Propel Helper__" package: Helper classes (traits) for Propel2 ORM



## Ansas\Propel\Helper\ReadOnly
This trait is a workaround for the Propel bug that you cannot use `joinWith()` methods anymore when setting tables to `readOnly="true"` in Propel's `schema.xml` file. So instead of making tables "readonly" in the scheme just add this trait to every child model you want to make readonly.

For details see https://github.com/propelorm/Propel2/issues/629

Example usage:
```php
<?php

use Base\User as BaseUser;
use Ansas\Propel\Helper\ReadOnly;

class User extends BaseUser
{
    use ReadOnly;
}
```


## Ansas\Propel\Helper\SimpleVersionableBehavior
The default behavior "versionable" does not seem to work well with relations and in combination with other behaviors.
Therefore I wrote a "simple trait" that does NOT consider versions of related tables. All methods can be used as
before.

Three things have to be implemented to use this trait:

1. Use the trait in the desired class
<code>use Ansas\Propel\Helper\SimpleVersionableBehaviorTrait;</code>

2. Add the following constant with the name of the versionable behavior active records class (e. g. for an 'Account')
<code>const VERSIONABLE_CLASS = 'AccountVersion';</code>

3. Optionally add the constant for column names (in default PhpName notation) to skip when populating object
code>const VERSIONABLE_POPULATE_SKIP_COLUMNS = ['UpdatedAt', 'Version'];</code>

Example usage:
```php
<?php

use Base\User as BaseUser;
use Ansas\Propel\Helper\SimpleVersionableBehavior;

class User extends BaseUser
{
    use SimpleVersionableBehavior;

    /**
     * Class name for versionable behavior active records
     */
    const VERSIONABLE_CLASS = 'UserVersion';

    /**
     * Column names (in default PhpName notation) to skip when populating this with version entry
     */
    const VERSIONABLE_POPULATE_SKIP_COLUMNS = ['UpdatedAt', 'Version'];
}
```


## Ansas\Propel\Helper\Validation
This trait makes validation of an object quite easy.

Methods:
```php
protected function addValidationError($key, $value, $overwrite = true)
protected function clearValidationErrors()
public function getValidationErrors()
public function hasValidationErrors()
abstract public function isValid();
```


# TODO
- Write tests
