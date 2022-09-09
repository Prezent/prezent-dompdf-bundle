<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\Creator;

use Dompdf\Dompdf;

/**
 * Class to create a PDF document from an HTML string
 *
 * @author Terry Duivesteijn <terry@loungeroom.nl>
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class Html extends Creator
{
    protected ?string $html = null;

    /**
     * {@inheritDoc}
     */
    public function render(): void
    {
        if (null === $this->html) {
            throw new \RuntimeException('You need to set the HTML, before rendering a PDF');
        }

        $this->options->setDefaultPaperOrientation($this->getOrientation());
        $this->options->setDefaultPaperSize($this->getPaperSize());

        $this->pdf = new Dompdf($this->options);
        $this->pdf->loadHtml($this->html);
        $this->pdf->render();
    }

    /**
     * Getter for html
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }

    /**
     * Setter for html
     */
    public function setHtml(string $html): self
    {
        $this->html = $html;

        return $this;
    }
}
