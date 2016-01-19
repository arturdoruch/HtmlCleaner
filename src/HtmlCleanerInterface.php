<?php
/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */

namespace ArturDoruch\Tool\HtmlCleaner;

/**
 * Provides the custom way of cleaning html code.
 */
interface HtmlCleanerInterface
{
    /**
     * Cleans html code from unwanted elements.
     *
     * @param string $html The html code.
     */
    public function clean(&$html);
}
 