<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\seo
 * @category   CategoryName
 */

namespace lispa\amos\seo;

use lispa\amos\seo\models\SeoData;
use lispa\amos\core\module\AmosModule;
use lispa\amos\core\record\Record;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class AmosSeo
 *
 * Collaboration Web House - This module provides management of seo fields
 *
 * @package lispa\amos\seo
 * @see
 */
class AmosSeo extends AmosModule
{

    public $behaviors = [
        'seoBehavior' => 'lispa\amos\seo\behaviors\SeoBehaviors'
    ];
    
    public $modulesEnabled = [];
    public $modelsEnabled = [];      // configurata in modules-amos
    
    public static $CONFIG_FOLDER = 'config';

    public $config = [];
    
    public function init()
    {
        $configContents = null;
        parent::init();

        \Yii::setAlias('@lispa/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');
        // \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        // 
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
        Yii::configure($this,$config );
        
        $this->modulesEnabled = $this->config['modulesEnabled'];
        
        Record::$modulesChainBehavior[] = 'seo';
        //pr(Record::$modulesChainBehavior, 'Record::$modulesChainBehavior');exit;
        
    }
    
    
    /**
     *
     * @return string
     */
    public static function getModuleName()
    {
        return 'seo';
    }

    public function getWidgetGraphics()
    {
        return [];
    }

    public function getWidgetIcons()
    {
        return [];
    }

    /**
     *
     * @return array
     */
    public function getModel()
    {
        return __NAMESPACE__ . '\\' . 'models\SeoData';
    }
    
    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [            
        ];
    }

    
    public static function getModelFromPrettyUrl($slug) {
        $seoData = SeoData::findOne([
                    'pretty_url' => $slug
        ]);
        if(!is_null($seoData)) {
            $contentClassName = $seoData->classname;
            $model = $contentClassName::findOne($seoData->content_id);
            //pr($model->toArray(),get_class($model));exit;
            return $model;
        }
        return null;
    }
    
}
