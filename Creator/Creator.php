<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\Creator;

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Abstract creator class. Initializes the Dompdf instance
 *
 * @author Robert-Jan Bijl<robert-jan@prezent.nl>
 */
abstract class Creator implements CreatorInterface
{
    protected Dompdf $pdf;

    protected Options $options;

    protected ?string $configFile;

    protected string $orientation = 'portrait';

    protected string $paperSize = 'a4';

    /**
     * Whether the pdf is rendered
     */
    protected bool $rendered = false;

    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
    }

    /**
     * Initialize the configuration
     */
    public function initialize(): void
    {
        if (file_exists($this->configFile)) {
            require_once $this->configFile;
        }

        $this->options = new Options();

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
    }

    /**
     * {@inheritDoc}
     */
    abstract public function render(): void;

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * Stream the pdf document
     *
     * @param string $fileName The name of the document
     */
    public function stream(string $fileName): void
    {
        if (!$this->rendered) {
            $this->render();
        }

        $this->pdf->stream($fileName);
    }

    /**
     * Get the raw pdf output
     */
    public function output(): string
    {
        if (!$this->rendered) {
            $this->render();
        }

        return $this->pdf->output();
    }

    /**
     * Getter for orientation
     */
    public function getOrientation(): string
    {
        return $this->options->getDefaultPaperOrientation();
    }

    /**
     * Setter for orientation
     */
    public function setOrientation(string $orientation): self
    {
        $this->options->setDefaultPaperOrientation($orientation);

        return $this;
    }

    /**
     * Getter for paperSize
     */
    public function getPaperSize(): string
    {
        return $this->options->getDefaultPaperSize();
    }

    /**
     * Setter for paperSize
     */
    public function setPaperSize(string $paperSize): self
    {
        $this->options->setDefaultPaperSize($paperSize);

        return $this;
    }
}
