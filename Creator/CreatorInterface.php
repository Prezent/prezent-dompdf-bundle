<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\Creator;

/**
 * Class to create PDF document from an HTML string
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
interface CreatorInterface
{
    /**
     * Render the PDF document
     */
    public function render(): void;

    /**
     * Streamthe pdf document
     *
     * @param  string $fileName The name of the document
     */
    public function stream(string $fileName) : void;

    /**
     * Get the raw pdf output
     *
     * @return string
     */
    public function output(): string;
}
