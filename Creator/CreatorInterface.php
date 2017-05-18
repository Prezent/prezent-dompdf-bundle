<?php

namespace LoungeRoom\DompdfBundle\Creator;

/**
 * Class to create PDF document from an HTML string
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
interface CreatorInterface
{
    /**
     * Render the PDF document
     *
     * @return bool
     */
    public function render();

    /**
     * Stream the pdf document
     *
     * @param  string $fileName The name of the document
     * @return bool
     */
    public function stream($fileName);

    /**
     * Get the raw pdf output
     *
     * @return string
     */
    public function output();
}