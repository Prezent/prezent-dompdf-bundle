<?php

namespace Prezent\DompdfBundle\Wrapper;

/**
 * A wrapper class for DOMPDF, to initialize the class, and use it a Symfony application
 *
 * @author Robert-Jan Bijl<robert-jan@prezent.nl>
 */
class DompdfWrapper
{
    /**
     * @var \DOMPDF
     */
    public $pdf;

    /**
     * @var string
     */
    private $configFile;

    /**
     * @param string $configFile
     */
    public function __construct($configFile)
    {
        $this->configFile = $configFile;
    }

    /**
     * Create a pdf document
     *
     * @param string $html The html to be rendered
     * @param string $orientation
     * @param string $paperSize
     * @return bool
     */
    public function createPdf($html, $orientation = 'portrait', $paperSize = null)
    {
        $this->initializeConfig();

        if (null === $paperSize) {
            $paperSize = DOMPDF_DEFAULT_PAPER_SIZE;
        }

        $this->pdf = new \DOMPDF();

        $this->pdf->set_paper($paperSize, $orientation);
        $this->pdf->load_html($html);
        $this->pdf->render();

        return true;
    }

    /**
     * Initialize the configuration
     *
     * @throws \RuntimeException If the configfile does not exist
     * @return true
     */
    private function initializeConfig()
    {
        if (file_exists($this->configFile)) {
            require_once $this->configFile;
        } else {
            throw new \RuntimeException(sprintf('Could not find config file "%s"', $this->configFile));
        }

        return true;
    }

    /**
     * Stream the pdf document
     *
     * @param  string $fileName The name of the document
     * @return bool
     */
    public function stream($fileName)
    {
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
        return $this->pdf->output();
    }
}
