<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\moodle\rules
 * @category   CategoryName
 */

namespace lispa\amos\seo\rules;

use Yii;
use yii\rbac\Rule;

/**
 * Class ShowWidgetIconMoodleRankingRule
 * @package lispa\amos\moodle\rules
 */
class SeoDataRule extends Rule
{
    public $name = 'SeoDataRule';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        //pr($item, 'item');
        $model = $params['model'];
        //print "id: $model->id; classname: $model->classname; content_id: $model->content_id.<br />";
        //pr($params, $params['model']->id);

        //The base class name
        $baseClassName = \yii\helpers\StringHelper::basename($model->classname);
        
        $permissionType = $item->name;
        switch ($permissionType) {
            case 'SEODATA_READ':
                $modulePremission = strtoupper($baseClassName . '_READ');
                break;

            case 'SEODATA_CREATE':
                $modulePremission = strtoupper($baseClassName . '_CREATE');
                break;

            case 'SEODATA_UPDATE':
                $modulePremission = strtoupper($baseClassName . '_UPDATE');
                break;

            case 'SEODATA_DELETE':
                $modulePremission = strtoupper($baseClassName . '_DELETE');
                break;

            default:
                $modulePremission = null;
        }
        
        //print "baseClassName: $baseClassName; modulePremission: $modulePremission; permissionType: $permissionType.<br />";
        if (!is_null($modulePremission)) {
            $retVal = \Yii::$app->user->can($modulePremission, ['model' => $model]);
        } else {
            $retVal = false;
        }
        
        
        //print "SeoDataRule: $retVal.<br />"; //exit;
        return $retVal;
    }
}
