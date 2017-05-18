<?php

namespace LoungeRoom\DompdfBundle\Creator;

use Symfony\Bridge\Twig\TwigEngine;

/**
 * Class to create a PDF document from a Twig template
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class Twig extends Html implements CreatorInterface
{
    /**
     * @var TwigEngine
     */
    private $renderer;

    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $templateData = [];

    /**
     * Constructor
     *
     * @param string $configFile
     * @param TwigEngine $renderer
     */
    public function __construct($configFile = null, TwigEngine $renderer)
    {
        $this->configFile = $configFile;
        $this->renderer = $renderer;
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        // check if the template exists and is readable
        if (!$this->renderer->exists($this->template)) {
            throw new \RuntimeException(sprintf('Template "%s" does not exist', $this->template));
        }

        $html = $this->renderer->render($this->template, $this->templateData);
        $this->setHtml($html);

        parent::render();
    }

    /**
     * Setter for template
     *
     * @param string $template
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Setter for templateData
     *
     * @param array $templateData
     * @return self
     */
    public function setTemplateData(array $templateData)
    {
        $this->templateData = $templateData;
        return $this;
    }
}