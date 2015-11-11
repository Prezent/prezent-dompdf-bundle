<?php

namespace Prezent\DompdfBundle\Wrapper;

use Symfony\Bundle\TwigBundle\TwigEngine;

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
    private $pdf;

    /**
     * @var string
     */
    private $configFile;

    /**
     * @var TwigEngine
     */
    private $renderer;

    /**
     * Constructor
     *
     * @param string $configFile
     * @param TwigEngine $renderer
     */
    public function __construct($configFile, TwigEngine $renderer)
    {
        $this->configFile = $configFile;
        $this->renderer = $renderer;
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
     * Create a pdf document from an HTML string
     *
     * @param string $html The html to be rendered
     * @param string $orientation
     * @param string $paperSize
     * @return bool
     */
    public function createFromHtml($html, $orientation = 'portrait', $paperSize = null)
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
     * Create a pdf document from a twig template
     *
     * @param string $template
     * @param array $data
     * @param string $orientation
     * @param string $paperSize
     * @return bool
     */
    public function createFromTemplate($template, array $data = [], $orientation = 'portrait', $paperSize = null)
    {
        // check if the template exists and is readable
        if (!$this->renderer->exists($template)) {
            throw new \RuntimeException('Template "%s" does not exist', $template);
        }
        $html = $this->renderer->render($template, $data);

        return $this->createFromHtml($html, $orientation, $paperSize);
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
