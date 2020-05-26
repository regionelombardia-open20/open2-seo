<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

namespace open20\amos\seo\interfaces;


interface SeoModelInterface {
    /**
     * Returns the HTML with the JSON-LD tag
     */
    public function getSchema();
    
}