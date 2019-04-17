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
//use lispa\amos\seo\models\SeoMetadati;
use lispa\amos\seo\models\SeoData;


class SeoWidget extends Widget
{

    public $contentModel;

    public function run()
    {        
        $seoData = SeoData::findOne([
                    'classname' => $this->contentModel->className(),
                    'content_id' => $this->contentModel->id
        ]);
        if (is_null($seoData)) {
            $seoData = new SeoData();
        } else {
           $seoData->prepareSeoData();
        }
        //pr($seoData->toArray(), 'SeoWidget - $seoData SONO RIMASTA QUI');//exit;
        //print 'Pikkioooo. ...';exit;
        return $this->render('seo-data', [
            'modelClass' => AmosSeo::getModel(),
            'model' => $seoData,
            'contentModel' => $this->contentModel
        ]);
    }

}