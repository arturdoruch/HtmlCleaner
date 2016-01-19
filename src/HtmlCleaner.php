<?php
/**
 * @author Artur Doruch <arturdoruch@interia.pl>
 */

namespace ArturDoruch\Tool\HtmlCleaner;

/**
 * Cleans html code from unwanted elements.
 */
class HtmlCleaner extends AbstractHtmlCleaner
{
    /**
     * @var HtmlCleanerInterface
     */
    private $cleaner;

    /**
     * @param HtmlCleanerInterface $cleaner The custom, additional html cleaner.
     */
    public function __construct(HtmlCleanerInterface $cleaner = null)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * @param HtmlCleanerInterface $cleaner
     * The custom, additional html cleaner. Will be used after default clearing
     * rules (remove elements, blank lines, minifiy) will be applied.
     */
    public function setCleaner(HtmlCleanerInterface $cleaner)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * Cleans the html code from unwanted elements.
     *
     * @param string     $html The html code to clean.
     * @param array|null $removeElements
     * The array with names of html elements to remove.
     * If array is empty, non of elements will be removed.
     * If null, the default elements will be removed: comment, script, style.
     *
     * Available elements names and their meaning:
     *  - head        head tag with html tag. Only body tag will be left
     *  - comment     comments except IE hacks
     *  - script      script tags
     *  - style       style elements
     *  - img         img tags and input tags with type of image
     *  - input_meta  input and meta tags, except input with type of image
     *  - all         all elements mentioned above
     * @param bool       $minify
     * @param bool       $removeEmptyLines
     */
    public function clean(&$html, array $removeElements = null, $minify = false, $removeEmptyLines = true)
    {
        $this->_clean($html, $removeElements, $minify, $removeEmptyLines);

        if ($this->cleaner) {
            $this->cleaner->clean($html);
        }
    }

}
 