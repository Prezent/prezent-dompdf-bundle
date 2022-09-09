<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\Creator;

use Twig\Environment;

/**
 * Class to create a PDF document from a Twig template
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class Twig extends Html
{
    private Environment $twig;

    private ?string $template = null;

    /**
     * @var array<string, mixed>
     */
    private array $templateData = [];

    /**
     * Constructor
     */
    public function __construct(Environment $twig, ?string $configFile = null)
    {
        $this->twig = $twig;

        parent::__construct($configFile);
    }

    /**
     * {@inheritDoc}
     */
    public function render(): void
    {
        // check if the template exists and is readable
        if (!$this->twig->getLoader()->exists($this->template)) {
            throw new \RuntimeException(sprintf('Template "%s" does not exist', $this->template));
        }

        $html = $this->twig->render($this->template, $this->templateData);
        $this->setHtml($html);

        parent::render();
    }

    /**
     * Setter for template
     */
    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Setter for templateData
     *
     * @param array<string, mixed> $templateData
     */
    public function setTemplateData(array $templateData): self
    {
        $this->templateData = $templateData;

        return $this;
    }
}
