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
use open20\amos\seo\AmosSeo;


class SocialWidget extends Widget
{

    public $model;
    public $modelClass;
    public $contentModel;
    public $ogTypeList;
    protected $form = null;

    
    public function init()
    {
        parent::init();
        
        $this->setOgTypeList();
    }

    public function run()
    {        
        
        return $this->render('social-tag', [
            'form' => $this->getForm(),
            'model' => $this->model,
            'modelClass' => $this->modelClass,
            'ogTypeList' => $this->ogTypeList,
            'contentModel' => $this->contentModel
        ]);
    }

    /**
     * @return null
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param null $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    public function setOgTypeList()
    {
        $this->ogTypeList = [
                'article' => 'article: article on a website', 
                'book' => 'book: book or publication', 
                'place' => 'place: represents a place, such as a venue, a business, a landmark or any other location',
                'product' => 'product: this includes both virtual and physical products', 
                'profile' => 'profile: represents a person', 
                'video.other' => 'video.other: represents a generic video', 
                'website' => 'website', 
            ];
    }

    

}