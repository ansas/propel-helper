# Ansas\Propel\Helper

Helper classes (traits) for Propel ORM



## Ansas\Propel\Helper\ReadOnly
This trait is a workaround for the Propel bug that you cannot use `joinWith()` methods anymore when setting tables to `readOnly="true"` in Propel's `schema.xml` file. So instead of making tables "readonly" in the scheme just add this trait to every child model you want to make readonly.

For details see https://github.com/propelorm/Propel2/issues/629

Example usage:
```php
<?php

use Base\User as BaseUser;
use PropelHelper\ReadOnly;

class User extends BaseUser
{
    use ReadOnly;
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
