<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

namespace open20\amos\seo\models;

use open20\amos\core\record\Record;
use open20\amos\seo\AmosSeo;
use open20\amos\seo\behaviors\SluggableSeoBehavior;
use open20\amos\attachments\behaviors\FileBehavior;


use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\base\ErrorException;
//use yii\behaviors\SluggableBehavior;

/**
* This is the model class for table "seo_data".
*/
class SeoData extends \open20\amos\seo\models\base\SeoData
{
    /**
     * @var File $ogImage
     */
    private $ogImage;

    public function aggiornaSeoData(Record $model, $newValues)
    {
        //pr($newValues, '$newValues');exit;
        $this->content_id = $model->id;
        $this->classname = $model->className();
        $this->pretty_url = $newValues['pretty_url'];
        $this->meta_title = $newValues['meta_title'];
        $this->meta_description = $newValues['meta_description'];
        $this->meta_keywords = $newValues['meta_keywords'];
        $this->og_title = $newValues['og_title'];
        $this->og_description = $newValues['og_description'];
        $this->og_type = $newValues['og_type'];
        $this->unavailable_after_date = $newValues['unavailable_after_date'];
        if (is_array($newValues['meta_robots'])) {
            $this->meta_robots = implode(',',$newValues['meta_robots']);
        } else {
            $this->meta_robots = '';
        }
        if (is_array($newValues['meta_googlebot'])) {
            $this->meta_googlebot = implode(',',$newValues['meta_googlebot']);
        } else {
            $this->meta_googlebot = '';
        }
        
        $this->pretty_url = $this->generateUniqueSeoSlug($this->pretty_url);
        
        /*
        pr($model->toArray(), 'SeoData::aggiornaSeoData - model');
        pr($newValues, 'SeoData::aggiornaSeoData - $newValues');exit;
        */
        
            try {
                $this->save();
            } catch (Exception $e) {
                $this->update();
//                \Yii::$app->session->addFlash('danger',AmosSeo::t('amosseo', 'Impossibile salvare i dati seo per il contenuto'));
//                throw new ErrorException(AmosSeo::t('amosseo', 'Impossibile salvare i dati seo per il contenuto: {msgError}', [
//                    'msgError' => $e->getMessage()
//                ]));
            }


               
    }
    
    /***
     * splitta meta_robots e meta_googlebot per le checkbox
     */
    public function prepareSeoData()
    {
        $this->meta_robots = explode(',', $this->meta_robots);
        $this->meta_googlebot = explode(',', $this->meta_googlebot);
    }
    
    
    /**
     * @see \yii\base\Component::behaviors() for more info.
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SluggableSeoBehavior::className(),
                'attribute' => 'meta_title',
                'slugAttribute' => 'pretty_url',
                'immutable' => true,
                'ensureUnique' => true,
                'maxLengthSlug' => 70
            ],
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],
        ]);
    }


    /**
     * Getter for $this->ogImage;
     *
     */
    public function getOgImage()
    {
        if (empty($this->ogImage)) {
            $this->ogImage = $this->hasOneFile('ogImage')->one();
        }
        return $this->ogImage;
    }

    /**
     * @param $image
     */
    public function setOgImage($image)
    {
        $this->ogImage = $image;
    }
    
    
    
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
                    ];
    }

    public function attributeHints(){
        return [
                    ];
    }

    /**
    * Returns the text hint for the specified attribute.
    * @param string $attribute the attribute name
    * @return string the attribute hint
    * @see attributeHints
    */
    public function getAttributeHint($attribute) {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['ogImage'], 'file', 'extensions' => 'jpeg, jpg, png, gif'],
        ]);
    }

    public function attributeLabels()
    {
    return
        ArrayHelper::merge(
        parent::attributeLabels(),
        [
                'ogImage' => AmosSeo::t('amosseo', 'Og image')
                    ]);
    }

    
    public static function getEditFields() {
        $labels = self::attributeLabels();

        return [
                                        [
                            'slug' => 'classname',
                            'label' => $labels['classname'],
                            'type' => 'string'
                            ],
                                                    [
                            'slug' => 'content_id',
                            'label' => $labels['content_id'],
                            'type' => 'integer'
                            ],
                                                    [
                            'slug' => 'pretty_url',
                            'label' => $labels['pretty_url'],
                            'type' => 'string'
                            ],
                                                    [
                            'slug' => 'meta_title',
                            'label' => $labels['meta_title'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'meta_description',
                            'label' => $labels['meta_description'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'meta_keywords',
                            'label' => $labels['meta_keywords'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'og_title',
                            'label' => $labels['og_title'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'og_description',
                            'label' => $labels['og_description'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'og_image',
                            'label' => $labels['og_image'],
                            'type' => 'text'
                            ],
                                                    [
                            'slug' => 'og_type',
                            'label' => $labels['og_type'],
                            'type' => 'string'
                            ],
                                                    [
                            'slug' => 'meta_robots',
                            'label' => $labels['meta_robots'],
                            'type' => 'string'
                            ],
                                                    [
                            'slug' => 'meta_googlebot',
                            'label' => $labels['meta_googlebot'],
                            'type' => 'string'
                            ],
                                                    [
                            'slug' => 'unavailable_after_date',
                            'label' => $labels['unavailable_after_date'],
                            'type' => 'datetime'
                            ],
                                ];
    }
}
