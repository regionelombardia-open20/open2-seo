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

namespace open20\amos\seo;

use open20\amos\seo\models\SeoData;
use open20\amos\core\module\AmosModule;
use open20\amos\core\record\Record;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class AmosSeo
 *
 * Collaboration Web House - This module provides management of seo fields
 *
 * @package open20\amos\seo
 * @see
 */
class AmosSeo extends AmosModule
{
    public $behaviors            = [
        'seoBehavior' => 'open20\amos\seo\behaviors\SeoBehaviors'
    ];
    public $modulesEnabled       = [];
    public $modelsEnabled        = [];      // configurata in modules-amos
    public static $CONFIG_FOLDER = 'config';
    public $config               = [];

    /**
     * @var string $moduleName
     */
    private static $moduleName = 'seo';

    public function init()
    {
        $configContents = null;
        parent::init();

        \Yii::setAlias('@open20/amos/'.static::getModuleName().'/controllers', __DIR__.'/controllers');
        // \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        // 
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__.DIRECTORY_SEPARATOR.self::$CONFIG_FOLDER.DIRECTORY_SEPARATOR.'config.php');
        Yii::configure($this, $config);

        $this->modulesEnabled = $this->config['modulesEnabled'];

        Record::$modulesChainBehavior[] = self::$moduleName;
        //pr(Record::$modulesChainBehavior, 'Record::$modulesChainBehavior');exit;
    }

    /**
     * Module name
     * @return string
     */
    public static function getModuleName()
    {
        return static::$moduleName;
    }

    /**
     * @param string $moduleName
     */
    public static function setModuleName($moduleName)
    {
        static::$moduleName = $moduleName;
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
     * @return string
     */
    public static function getModel()
    {
        return __NAMESPACE__.'\\'.'models\SeoData';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
        ];
    }

    public static function getModelFromPrettyUrl($slug)
    {
        $seoData = SeoData::findOne([
                'pretty_url' => $slug
        ]);
        if (!is_null($seoData)) {
            $contentClassName = $seoData->classname;
            $model            = $contentClassName::findOne($seoData->content_id);
            //pr($model->toArray(),get_class($model));exit;
            return $model;
        }
        return null;
    }
}