<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\seo\behaviors
 * @category   CategoryName
 */

namespace lispa\amos\seo\behaviors;

use yii\behaviors\SluggableBehavior;


/**
 * Class SluggableAmosBehavior
 * @package lispa\amos\core\behaviors
 */
class SluggableSeoBehavior extends SluggableBehavior {
    
    public $maxLengthSlug;
    
    public function makeSeoUnique($slug) {
        return $this->makeUnique($slug);
    }
    
    public function generateSeoSlug($text) {
        return $this->generateSlug($text);
    }
    
    public function generateUniqueSeoSlug($text) {
        $text = str_replace("\n"," ", $text); // textarea
        if ($this->maxLengthSlug) {
            $text = substr($text, 0, $this->maxLengthSlug);
        }
        return $this->makeUnique($this->generateSlug([$text]));
    }
}
