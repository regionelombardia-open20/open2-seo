<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\moodle\assets
 * @category   CategoryName
 */

namespace lispa\amos\seo\assets;

use yii\web\AssetBundle;

/**
 * Class SeoAsset
 * @package lispa\amos\seo\assets
 */
class SeoAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/lispa/amos-seo/src/assets/web';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    /**
     * @inheritdoc
     */
    public $css = [
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        //'js/seo.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init() {        
        $this->js = [
            'js/seo.js'
        ];
        parent::init();
    }

}
