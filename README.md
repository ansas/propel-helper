PropelHelper
============

Helper classes (traits) for Propel ORM

## ConvertToNull
This trait can be used to "sanitize values" by setting empty values to null.

It holds methods which can be called in order to check if a field is empty and set it to "null" before calling the parent setter method. By doing this we have a more cleaned up object and also prevent e. g. the "versionable" behavior from adding a new version (as "" !== null).

Methods:
```php
protected function convertEmptyToNull($value, array $considerNull = [''])
protected function convertToNull($value, array $considerNull)
protected function trimAndConvertEmptyToNull($value, array $considerNull = [''])
protected function trimAndConvertToNull($value, array $considerNull)
```

-----

## ReadOnly
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

-----

## Validation
This trait makes validation of an object quite easy.

Methods:
```php
protected function addValidationError($key, $value, $overwrite = true)
protected function clearValidationErrors()
public function getValidationErrors()
public function hasValidationErrors()
abstract public function isValid();
```
