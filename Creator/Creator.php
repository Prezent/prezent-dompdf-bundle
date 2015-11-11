<?php

namespace Prezent\DompdfBundle\Creator;

use Dompdf\Dompdf;

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
    protected $paperSize;

    /**
     * Whether or not the pdf is rendered
     *
     * @var bool
     */
    protected $rendered = false;

    /**
     * Constructor
     *
     * @param string $configFile
     */
    public function __construct($configFile)
    {
        $this->configFile = $configFile;
    }

    /**
     * Initialize the configuration
     *
     * @throws \RuntimeException If the configfile does not exist
     * @return true
     */
    public function initialize()
    {
        if (file_exists($this->configFile)) {
            require_once $this->configFile;
        } else {
            throw new \RuntimeException(sprintf('Could not find config file "%s"', $this->configFile));
        }

        $this->pdf = new Dompdf();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    abstract public function render();

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
        return $this->orientation;
    }

    /**
     * Setter for orientation
     *
     * @param string $orientation
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * Getter for paperSize
     *
     * @return string
     */
    public function getPaperSize()
    {
        return $this->paperSize;
    }

    /**
     * Setter for paperSize
     *
     * @param string $paperSize
     * @return self
     */
    public function setPaperSize($paperSize)
    {
        $this->paperSize = $paperSize;
        return $this;
    }
}
