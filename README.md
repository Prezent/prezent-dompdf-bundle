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

After this, copy the file ```Resources/files/dompdf_config.inc.php``` to the ```app/config``` directory of your project.
Change the setting to suit your specific configuration. You can also change the default Dompdf settings in this file.

## Configuration
You can set a custom location for the configuration file:

```yml
prezent_dompdf:
    config_location: locationOfTheConfigFile 
```
