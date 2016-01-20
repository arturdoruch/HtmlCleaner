<?php
/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */

namespace ArturDoruch\Tool\HtmlCleaner;

use ArturDoruch\Http\Message\Response;

/**
 * Cleans HTTP response body with a content type "text/html" from unwanted elements.
 *
 * This cleaner is dedicated to work with HTTP client "arturdoruch/http"
 * @link https://github.com/arturdoruch/Http/
 */
class HttpResponseHtmlCleaner extends AbstractHtmlCleaner
{
    /**
     * @var HtmlCleanerInterface
     */
    private $cleaner;

    /**
     * @param HttpResponseHtmlCleanerInterface $cleaner The custom, additional html cleaner.
     */
    public function __construct(HttpResponseHtmlCleanerInterface $cleaner = null)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * @param HttpResponseHtmlCleanerInterface $cleaner
     * The custom, additional html cleaner. Will be used after default clearing
     * rules (remove elements, blank lines, minifiy) will be applied.
     */
    public function setCleaner(HttpResponseHtmlCleanerInterface $cleaner)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * Cleans HTTP response body with a content type "text/html" from unwanted elements.
     *
     * @param Response   $response      The HTTP response object
     * @param array|null $removeNoise   The list of unwanted html elements to remove.
     *                                  If array is empty, non of elements will be removed.
     *                                  If null given, the default elements will be removed: comment, script, style.
     *                                  Available elements names and their meaning:
     *                                   - head        head tag with html tag. Only body tag will be left
     *                                   - comment     comments except IE hacks
     *                                   - script      script tags
     *                                   - style       style elements
     *                                   - img         img tags and input tags with type of image
     *                                   - input_meta  input and meta tags, except input with type of image
     *                                   - all         all elements mentioned above
     * @param bool       $minify
     * @param bool       $removeEmptyLines
     */
    public function clean(Response $response, array $removeNoise = null, $minify = false, $removeEmptyLines = true)
    {
        if (strpos($response->getContentType(), 'text/html') !== 0) {
            return;
        }

        $html = $response->getBody();

        $this->cleanHtml($html, $removeNoise, $minify, $removeEmptyLines);

        if ($this->cleaner) {
            $this->cleaner->clean($html, $response->getEffectiveUrl(), $response->getStatusCode());
        }

        $response->setBody($html);
    }

}
 