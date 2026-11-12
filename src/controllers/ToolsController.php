<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-seo
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

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace open20\amos\seo\controllers;

use open20\amos\seo\models\SeoData;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use open20\amos\seo\AmosSeo;

/**
 * Tools for SEO
 *
 */
class ToolsController extends Controller {

    /**
     * Generates missing pretty urls for every object of the provided class
     * 
     * @param type $modelSearchClass
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
//                        'actions' => [
//                            'index',
//                            'generateMissingPrettyUrls'
//                        ],
                        'roles' => ['ADMIN']
                    ],
                ],
            ],
        ];
    }

    public $layout = "main";

    public function actionIndex() {
//        $modules = [];
//        foreach(Yii::$app->getModule('seo')->modulesEnabled as $module){
//            if (in_array('open20\\amos\\core\\interfaces\\CmsModuleInterface', class_implements($module))) {
//                $modules[] = $module;
//            }
//        }
        return $this->render('index',[
            'modules' => Yii::$app->getModule(AmosSeo::getModuleName())->modulesEnabled
        ]);
    }

    public function actionGenerateMissingPrettyUrls($moduleName) {
        $module = Yii::$app->getModule($moduleName);
        $errorMessage = null;
        if (in_array('open20\\amos\\core\\interfaces\\CmsModuleInterface', class_implements($module))) {
            $searchModelClass = $module::getModelSearchClassName();
            $searchModel = new $searchModelClass;
            $dataProvider = $searchModel->cmsSearch([], null);
            $modelsCount = 0;
            foreach ($dataProvider->models as $model) {
                $seoData = SeoData::findOne([
                            'classname' => $model->className(),
                            'content_id' => $model->id
                ]);

                if (is_null($seoData)) {
                    $seoData = new SeoData();
                    $seoData->classname = $model->className();
                    $seoData->content_id = $model->id;
                    $seoData->pretty_url = $seoData->generateUniqueSeoSlug($model[$model->titleAttribute]);
                    $seoData->created_by = $model->created_by;
                    $seoData->save();
                    $modelsCount++;
                }
            }
        } else {
            $errorMessage = \open20\amos\seo\AmosSeo::t('amosseo','Modulo non valido');
        }
        
        return $this->render('generateMissingPrettyUrls',[
            'modelsCount' => $modelsCount,
            'errorMessage' => $errorMessage
        ]);
    }

}
