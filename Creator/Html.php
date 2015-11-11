<?php

namespace Prezent\DompdfBundle\Creator;

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

        if (null === $this->paperSize) {
            $this->paperSize = DOMPDF_DEFAULT_PAPER_SIZE;
        }

        $this->pdf = new \DOMPDF();

        $this->pdf->set_paper($this->paperSize, $this->orientation);
        $this->pdf->load_html($this->html);
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