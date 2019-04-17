<?php


/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\seo
 * @category   CategoryName
 */
use lispa\amos\seo\assets\SeoAsset;


//SeoAsset::register($this);

?>

<div class="seo-data">

    <?php //pr($contentModel->className(), 'contentModel - seo-dataaa');pr($modelClass, 'model - seo-data'); pr($model->toArray(), 'il model');exit;

    $moduleSeo  = \Yii::$app->getModule('seo');
    if (isset($moduleSeo) && $moduleSeo->behaviors) {
        //print 'seo-data: Hello world!';exit;
        echo lispa\amos\seo\widgets\MetaWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        echo lispa\amos\seo\widgets\SocialWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        echo lispa\amos\seo\widgets\RobotWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        /*
         * 
         */
    }

    ?>

</div>

