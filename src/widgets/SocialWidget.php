<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\seo
 * @category   CategoryName
 */

namespace lispa\amos\seo\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use lispa\amos\seo\AmosSeo;


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
                'book' => 'book: book or pubblication', 
                'place' => 'place: represents a place - such as a venue, a business, a landmark, or any other location', 
                'product' => 'product: this includes both virtual and physical products', 
                'profile' => 'profile: represents a person', 
                'video.other' => 'video.other: represents a generic video', 
                'website' => 'website', 
            ];
    }

    

}