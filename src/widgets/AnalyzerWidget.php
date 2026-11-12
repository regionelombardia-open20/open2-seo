<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\seo
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

namespace open20\amos\seo\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;


class AnalyzerWidget extends Widget
{
    public $autoUpdate = true;
    public $baseUrl;
    public $fields = [];
    public $id = 'amos-seo-analyzer';
    public $locale;
    public $model;
    public $options = [];

    public function init() {
        parent::init();
        $this->locale = (empty($this->locale)) ? \Yii::$app->language : $this->locale;
        $this->baseUrl = (empty($this->baseUrl)) ? \Yii::$app->params['platform']['backendUrl'] : $this->baseUrl;
        $this->setFields();
        $this->setContentModel();
    }

    protected function setFields() {
        $this->fields = ArrayHelper::merge([
            'keyword' => ['selector' => '#'.$this->id.'-keyphrase', 'event' => 'input'],
            'synonyms' => ['selector' => '#'.$this->id.'-synonyms', 'event' => 'input'],
        ], $this->fields);
    }

    protected function setContentModel() {

    }

    public function run() {
        return $this->render('analyzer', [
            'autoUpdate' => $this->autoUpdate,
            'baseUrl' => $this->baseUrl,
            'fields' => $this->fields,
            'id' => $this->id,
            'locale' => $this->locale,
            'options' => $this->options
        ]);
    }

}
