<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace open20\amos\seo\controllers;

use open20\amos\seo\models\SeoData;
use Yii;

class ApiController extends \yii\rest\Controller {
    
    public function init()
    {
        parent::init();
        
    }
    

    public function actionPrettyurl()
    {    
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $slug = Yii::$app->request->post('slug');
        $seo = new SeoData();
        return [
            'pretty_url' => $seo->generateUniqueSeoSlug($slug),
        ];
    }
}