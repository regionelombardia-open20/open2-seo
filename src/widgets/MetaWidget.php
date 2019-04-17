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


class MetaWidget extends Widget
{

    public $model;
    public $modelClass;
    public $contentModel;
    protected $form = null;
    
    public function run()
    {
        //pr($this->model->toArray(), '$this->model');exit;
        //print 'Pikkio. ...';exit;
        return $this->render('meta-tag', [
            'form' => $this->getForm(),
            'model' => $this->model,
            'modelClass' => $this->modelClass,
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

}