<?php

namespace ArturDoruch\Tool\HtmlCleaner;

use ArturDoruch\Util\HtmlUtils;

/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
abstract class AbstractHtmlCleaner
{
    /**
     * @param string $html
     * @param array  $removeNoise
     * @param bool   $minify
     * @param bool   $removeEmptyLines
     */
    protected function cleanHtml(&$html, array $removeNoise = null, $minify = false, $removeEmptyLines = true)
    {
        HtmlUtils::removeNoise($html, $removeNoise, $removeEmptyLines);

        if ($minify === true) {
            HtmlUtils::minify($html, false);
        }
    }

}
 