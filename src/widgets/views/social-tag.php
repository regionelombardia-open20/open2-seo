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
use open20\amos\seo\AmosSeo;
use open20\amos\core\helpers\Html;
use open20\amos\attachments\components\AttachmentsInput;

//print 'getOgTitle: '.$contentModel->getOgTitle().'.<br />';
//print 'getOgDescription: '.$contentModel->getOgDescription().'.<br />';
//print 'getOgImageUrl: '.$contentModel->getOgImageUrl().'.<br />';
//print 'getOgType: '.$contentModel->getOgType().'.<br />';

?>

<div class="row social-tag">

    <div class="col-xs-12">
        <?= Html::tag('h3', AmosSeo::t('amosseo', '#social_tag_title'), ['class' => 'subtitle-form']) ?>
    </div>
    <div class="col-md-12 col-xs-12">
        <?= $form->field($model, 'og_title')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#og_title_field_placeholder')])->hint(AmosSeo::t('amosseo', '#og_title_field_hint')) ?>
        <?= $form->field($model, 'og_description')->textarea(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#og_description_field_placeholder')])->hint(AmosSeo::t('amosseo', '#og_description_field_hint')) ?>
        <?= $form->field($model, 'og_type')->dropdownList($ogTypeList, ['prompt' => AmosSeo::t('amosseo', '#og_type_field_prompt')])->hint(AmosSeo::t('amosseo', '#og_type_field_hint')) ?>
    </div>
    <div class="col-md-12 col-xs-12">


            <?= $form->field($model,
                'ogImage')->widget(AttachmentsInput::classname(), [
                'options' => [ // Options of the Kartik's FileInput widget
                    'multiple' => false, // If you want to allow multiple upload, default to false
                    'accept' => "image/*"
                ],
                'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
                    'maxFileCount' => 1,
                    'showRemove' => false,// Client max files,
                    'indicatorNew' => false,
                    'allowedPreviewTypes' => ['image'],
                    'previewFileIconSettings' => false,
                    'overwriteInitial' => false,
                    'layoutTemplates' => false
                ]
            ])->label(AmosSeo::t('amosseo', '#og_image_field'))->hint(AmosSeo::t('amosseo', '#og_image_field_hint')) ?>


    </div>

</div>

