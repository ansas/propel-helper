# Propel helper

[![Latest Stable Version](https://poser.pugx.org/ansas/propel-helper/v/stable)](https://packagist.org/packages/ansas/propel-helper)
[![Total Downloads](https://poser.pugx.org/ansas/propel-helper/downloads)](https://packagist.org/packages/ansas/propel-helper)
[![Latest Unstable Version](https://poser.pugx.org/ansas/propel-helper/v/unstable)](https://packagist.org/packages/ansas/propel-helper)
[![License](https://poser.pugx.org/ansas/propel-helper/license)](https://packagist.org/packages/ansas/propel-helper)

Helper classes (traits) for [Propel2](https://github.com/propelorm/Propel2) ORM.


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
2. Add the following constant with the name of the versionable behavior active records class (e. g. for an 'Account')
3. Optionally add the constant for column names (in default PhpName notation) to skip when populating object

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
protected function resetValidation()
public function getValidationErrors()
public function hasValidationErrors()
abstract protected function doValidate();
```

## TODO
- Write tests


## Contribute

Everybody can contribute to this package. Just:

1. fork it,
2. make your changes and
3. send a pull request.

Please make sure to follow [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding conventions.


## License

__MIT license__ (see the [LICENSE](LICENSE.md) file for more information).
