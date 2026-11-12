<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\moodle\rules
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

namespace open20\amos\seo\rules;

use open20\amos\seo\models\SeoData;
use Yii;
use yii\log\Logger;
use yii\rbac\Rule;

/**
 * Class ShowWidgetIconMoodleRankingRule
 * @package open20\amos\moodle\rules
 */
class SeoDataRule extends Rule
{
    public $name = 'SeoDataRule';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        /**
         * @var $model SeoData
         */
        $model = $params['model'];

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

        if (!is_null($modulePremission)) {
            $retVal = \Yii::$app->user->can($modulePremission, ['model' => $model->owner]);
        } else {
            $retVal = false;
        }

        return $retVal;
    }
}
