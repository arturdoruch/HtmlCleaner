<?php
/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */

namespace ArturDoruch\Tool\HtmlCleaner;

use ArturDoruch\Util\HtmlUtils;

abstract class AbstractHtmlCleaner
{
    /**
     * Cleans html code.
     *
     * @param string     $html
     * @param array|null $removeElements
     * @param bool       $minify
     * @param bool       $removeEmptyLines
     */
    protected function _clean(&$html, array $removeElements = null, $minify = false, $removeEmptyLines = true)
    {
        HtmlUtils::removeNoise($html, $removeElements, $removeEmptyLines);

        if ($minify === true) {
            HtmlUtils::minify($html);
        }
    }

}
 