# prezent/dompdf-bundle

Integrate [DOMPDF](https://github.com/dompdf/dompdf) in Symfony2.

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

After this, copy the file ```Resources/files/dompdf_config.inc.php``` to the ```app/config``` directory of your project.
You can change the default DOMPDF setting in this file.

## Configuration
You can set a custom location for the configuration file:

```yml
prezent_dompdf:
    config_location: locationOfTheConfigFile 
```
