# prezent/dompdf-bundle

Integrates [Dompdf](https://github.com/dompdf/dompdf) into a Symfony2 project.

## Installation
This bundle can be installed using Composer. Tell composer to install the extension:

```bash
$ php composer.phar require prezent/dompdf-bundle
```

Then, activate the bundle in your kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Prezent\DompdfBundle\PrezentDompdfBundle(),
    );
}
```

## Configuration
Since Dompdf 0.7.0, settings in the `dompdf_config.inc.php` are no longer supported. 
Set your options at runtime.
