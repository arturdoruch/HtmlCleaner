<?php

namespace ArturDoruch\Tool\HtmlCleaner;

/**
 * Provides the custom way of cleaning HTTP response body with a content type "text/html".
 *
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
interface HttpResponseHtmlCleanerInterface
{
    /**
     * Cleans HTTP response body with content type "text/html" from unwanted elements.
     *
     * @param string $html       The http response body, html code
     * @param string $url        The http response effective url
     * @param int    $statusCode The http response status code
     */
    public function clean(&$html, $url, $statusCode);
}
 