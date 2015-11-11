<?php 

// these settings are required for the framwork integration, but change them as you see fit
define("DOMPDF_FONT_DIR", "../var/cache/");
define("DOMPDF_FONT_CACHE", "../var/cache/");
define("DOMPDF_ENABLE_AUTOLOAD", false);

// define your own custom setting below
//define("DOMPDF_DPI", 300);
//define("DOMPDF_DEFAULT_PAPER_SIZE", "a4");
//define("DOMPDF_ENABLE_REMOTE", true);
//define("DOMPDF_ENABLE_CSS_FLOAT", true);

// include the DOMPDF config file
include('../vendor/dompdf/dompdf/dompdf_config.inc.php');