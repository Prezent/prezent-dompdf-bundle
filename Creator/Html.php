<?php

namespace Prezent\DompdfBundle\Creator;
use Dompdf\Dompdf;

/**
 * Class to create a PDF document from an HTML string
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class Html extends Creator implements CreatorInterface
{
    /**
     * @var string
     */
    protected $html = null;

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        if (null === $this->html) {
            throw new \RuntimeException('You need to set the HTML, before rendering a PDF');
        }

        $this->pdf = new Dompdf();
        $this->pdf->setPaper($this->paperSize, $this->orientation);
        //$this->pdf->
        $this->pdf->loadHtml($this->html);
        $this->pdf->render();

        return true;
    }

    /**
     * Getter for html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Setter for html
     *
     * @param string $html
     * @return self
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }
}