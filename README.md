# loungeroom/dompdf-bundle

Integrates [Dompdf](https://github.com/dompdf/dompdf) into a Symfony2 project, forked from [prezent/dompdf-bundle](https://github.com/Prezent/prezent-dompdf-bundle).

## Note
If you're looking to use **DomPDF 0.6.2** or older, see the [dompdf-bundle by Prezent](https://github.com/Prezent/prezent-dompdf-bundle). 
This is just an adapted fork to work with DomPDF 0.8.0. All credits go to [Prezent](http://www.prezent.nl).

## Installation
This bundle can be installed using Composer:

```bash
$ php composer.phar require loungeroom/dompdf-bundle
```

Then, activate the bundle in your kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LoungeRoom\DompdfBundle\LoungeroomDompdfBundle(),
    );
}
```

## Configuration
Since Dompdf 0.7.0, settings in the `dompdf_config.inc.php` are no longer supported. 
Set your options at runtime:

```php
$pdf = $this->get('dompdf.twig');

$options = $pdf->getOptions();
$options->setFontDir($customDirectory);

$pdf->setOrientation('portrait');
$pdf->setPaperSize('a4');
```

If you have defined one of the following old settings, they will be mapped to the following Options:
```
DOMPDF_CHROOT
-> Options->setChroot(DOMPDF_CHROOT);
DOMPDF_DIR
-> Options->setRootDir(DOMPDF_DIR);
DOMPDF_TEMP_DIR
-> Options->setTempDir(DOMPDF_TEMP_DIR);
DOMPDF_FONT_DIR
-> Options->setFontDir(DOMPDF_FONT_DIR);
DOMPDF_FONT_CACHE
-> Options->setFontCache(DOMPDF_FONT_CACHE);
DOMPDF_LOG_OUTPUT_FILE
-> Options->setLogOutputFile(DOMPDF_LOG_OUTPUT_FILE);
DOMPDF_DPI
-> Options->setDpi(DOMPDF_DPI);
DOMPDF_DEFAULT_PAPER_SIZE
-> Options->setDefaultPaperSize(DOMPDF_DEFAULT_PAPER_SIZE);
DOMPDF_ENABLE_REMOTE
-> Options->setIsRemoteEnabled(DOMPDF_ENABLE_REMOTE);
DOMPDF_ENABLE_PHP
-> Options->setIsPhpEnabled(DOMPDF_ENABLE_PHP);
DOMPDF_DEFAULT_FONT
-> Options->setDefaultFont(DOMPDF_DEFAULT_FONT);
DOMPDF_FONT_HEIGHT_RATIO
-> Options->setFontHeightRatio(DOMPDF_FONT_HEIGHT_RATIO);
```