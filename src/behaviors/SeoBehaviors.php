<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\seo\behaviors
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

namespace open20\amos\seo\behaviors;

use open20\amos\seo\AmosSeo;
use open20\amos\seo\models\SeoData;

use Yii;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * Class SeoBehaviors
 * @package open20\amos\seo\behaviors
 */
class SeoBehaviors extends AttributeBehavior
{
    
    public $postParams;


    /**
     * @var \open20\amos\core\record\Record $sender ;
     */
    private $sender;
    
    /**
     * @return array
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'eventSaveSeoData',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'eventSaveSeoData',
            // non so se serve BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'eventBeforeValidate',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'eventBeforeDelete'
        ];
    }
    
    /**
     * @param Event $event
     */
    public function eventSaveSeoData(Event $event)
    {
        $this->setSender($event->sender);
        
        if (isset($this->getSender()->deleted_at)) {
            return;
        }
        $seoData = SeoData::findOne([
                    'classname' => $this->getSender()->className(),
                    'content_id' => $this->getSender()->id
        ]);
        
        if (is_null($seoData)) {
            $seoData = new SeoData();
        }
        //pr($seoData->toArray(), 'eventSaveSeoData - $seoData');//exit;
        //$pars = Yii::$app->request->post();
  
        //$post = [];
        
        if (isset($_POST['SeoData'])) {
            $this->postParams = $_POST['SeoData'];
        }
        //pr($this->postParams, '$this->postParams');exit;
        $seoData->aggiornaSeoData($this->getSender(), $this->postParams);
        
    }
    
    
    /**
     * @param Event $event
     */
    public function eventBeforeDelete(Event $event)
    {
        $this->setSender($event->sender);
                
        if (isset($this->getSender()->deleted_at)) {
            return;
        }
        $seoData = SeoData::findOne([
                    'classname' => $this->getSender()->className(),
                    'content_id' => $this->getSender()->id
        ]);
        if (!is_null($seoData)) {
            $seoData->delete();
        }
    }
    
    
    /**
     * @param \yii\db\ActiveRecord $sender
     */
    private function setSender($sender)
    {
        $this->sender = $sender;
    }
    
    /**
     * @return \open20\amos\core\record\Record
     */
    private function getSender()
    {
        return $this->sender;
    }
    
}
