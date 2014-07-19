PropelHelper
============

Helper classes for Propel ORM

## ReadOnly
This trait is a workaround for the bug when setting tables to `readOnly="true"` in Propel's schema.xml and still wanting to use the `joinWith()` methods.

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