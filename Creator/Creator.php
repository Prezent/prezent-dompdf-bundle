<?php

namespace LoungeRoom\DompdfBundle\Creator;

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Abstract creator class. Initializes the Dompdf instance
 *
 * @author Robert-Jan Bijl<robert-jan@prezent.nl>
 */
abstract class Creator implements CreatorInterface
{
    /**
     * @var Dompdf
     */
    protected $pdf;

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var string
     */
    protected $configFile;

    /**
     * @var string
     */
    protected $orientation = 'portrait';

    /**
     * @var string
     */
    protected $paperSize = 'a4';

    /**
     * Whether or not the pdf is rendered
     *
     * @var bool
     */
    protected $rendered = false;

    /**
     * Constructor
     * @param $configFile
     */
    public function __construct($configFile = null)
    {
        $this->configFile = $configFile;
    }

    /**
     * Initialize the configuration
     *
     * @return true
     */
    public function initialize()
    {
        if (file_exists($this->configFile)) {
            require_once $this->configFile;
        }

        $this->pdf = new Dompdf();
        $this->options = $this->pdf->getOptions();

        // legacy 0.6.2 support, WARNING: not all old properties are supported
        if (defined('DOMPDF_CHROOT')) {
            $this->options->setChroot(DOMPDF_CHROOT);
        }
        if (defined('DOMPDF_DIR')) {
            $this->options->setRootDir(DOMPDF_DIR);
        }
        if (defined('DOMPDF_TEMP_DIR')) {
            $this->options->setTempDir(DOMPDF_TEMP_DIR);
        }
        if (defined('DOMPDF_FONT_DIR')) {
            $this->options->setFontDir(DOMPDF_FONT_DIR);
        }
        if (defined('DOMPDF_FONT_CACHE')) {
            $this->options->setFontCache(DOMPDF_FONT_CACHE);
        }
        if (defined('DOMPDF_LOG_OUTPUT_FILE')) {
            $this->options->setLogOutputFile(DOMPDF_LOG_OUTPUT_FILE);
        }
        if (defined('DOMPDF_DPI')) {
            $this->options->setDpi(DOMPDF_DPI);
        }
        if (defined('DOMPDF_DEFAULT_PAPER_SIZE')) {
            $this->options->setDefaultPaperSize(DOMPDF_DEFAULT_PAPER_SIZE);
        }
        if (defined('DOMPDF_DEFAULT_PAPER_SIZE')) {
            $this->options->setDefaultPaperOrientation(DOMPDF_DEFAULT_PAPER_SIZE);
        }
        if (defined('DOMPDF_ENABLE_REMOTE')) {
            $this->options->setIsRemoteEnabled(DOMPDF_ENABLE_REMOTE);
        }
        if (defined('DOMPDF_ENABLE_PHP')) {
            $this->options->setIsPhpEnabled(DOMPDF_ENABLE_PHP);
        }
        if (defined('DOMPDF_DEFAULT_FONT')) {
            $this->options->setDefaultFont(DOMPDF_DEFAULT_FONT);
        }
        if (defined('DOMPDF_FONT_HEIGHT_RATIO')) {
            $this->options->setFontHeightRatio(DOMPDF_FONT_HEIGHT_RATIO);
        }
        return true;
    }

    /**
     * {@inheritDoc}
     */
    abstract public function render();

    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Stream the pdf document
     *
     * @param  string $fileName The name of the document
     * @return bool
     */
    public function stream($fileName)
    {
        if (!$this->rendered) {
            $this->render();
        }

        $this->pdf->stream($fileName);
        return true;
    }

    /**
     * Get the raw pdf output
     *
     * @return string
     */
    public function output()
    {
        if (!$this->rendered) {
            $this->render();
        }

        return $this->pdf->output();
    }

    /**
     * Getter for orientation
     *
     * @return string
     */
    public function getOrientation()
    {
        return $this->options->getDefaultPaperOrientation();
    }

    /**
     * Setter for orientation
     *
     * @param string $orientation
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->options->setDefaultPaperOrientation($orientation);
        return $this;
    }

    /**
     * Getter for paperSize
     *
     * @return string
     */
    public function getPaperSize()
    {
        return $this->options->getDefaultPaperSize();
    }

    /**
     * Setter for paperSize
     *
     * @param string $paperSize
     * @return self
     */
    public function setPaperSize($paperSize)
    {
        $this->options->setDefaultPaperSize($paperSize);
        return $this;
    }
}
