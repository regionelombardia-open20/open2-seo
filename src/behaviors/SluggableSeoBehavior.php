<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\seo\behaviors
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

namespace open20\amos\seo\behaviors;

use yii\behaviors\SluggableBehavior;


/**
 * Class SluggableAmosBehavior
 * @package open20\amos\core\behaviors
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
        $text = str_replace("\n", " ", $text); // textarea

        $text = str_replace("&nbsp;", " ", $text);
        $text = str_replace(array("'", '"'), "", $text); //remove single quote and dash
        $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
        $text = preg_replace("#[^a-zA-Z0-9]+#", "-", $text); //replace everything non an with dashes
        $text = preg_replace("#(-){2,}#", "$1", $text); //replace multiple dashes with one
        $text = trim($text, "-"); //trim dashes from beginning and end of string if any
        $text = trim($text, '.');

        if ($this->maxLengthSlug) {
            $text = substr($text, 0, $this->maxLengthSlug);
        }
        return $this->makeUnique($this->generateSlug([$text]));
    }

}
