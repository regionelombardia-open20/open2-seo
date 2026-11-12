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

//pr($contentModel->className(), 'contentModel - meta-tag');pr($modelClass, 'model - meta-tag');pr($model->toArray(), 'il model');
//print 'getPrettyUrl: '.$contentModel->getPrettyUrl().'.<br />';
//print 'getMetaTitle: '.$contentModel->getMetaTitle().'.<br />';
//print 'getMetaDescription: '.$contentModel->getMetaDescription().'.<br />';
//print 'getMetaKeywords: '.$contentModel->getMetaKeywords().'.<br />';
$moduleName = AmosSeo::getModuleName()
?>
<?php
$titolo_field = $contentModel->titleAttribute;

$js = <<<JS
    var prettyUrlElem = $("input[id$=\"pretty_url\"]");
    //console.log('initPrettyUrl', $(prettyUrlElem).val());
    if($(prettyUrlElem).val() == '') {
        var titoloElem = $("input[id$=\"-$titolo_field\"]");
        //console.log($(titoloElem).attr('id'), $(titoloElem).length, 'input');
        if (titoloElem.length == 0) {
            titoloElem = $("textarea[id$=\"-$titolo_field\"]");
            //console.log($(titoloElem).attr('id'), $(titoloElem).length, 'textaarea');
        }
        setPrettyUrl(titoloElem);
        $(titoloElem).on('change',function(){
            setPrettyUrl(this);
        });
    }

    function setPrettyUrl(titoloElem) {
        //console.log('setPrettyUrl', $(titoloElem).val());
        var url = 
                $.ajax({
                    url: '/$moduleName/api/prettyurl',
                    type: 'POST',
                    data: {
                        slug: $(titoloElem).val()
                    },
                    success: function (data) {
                        $(prettyUrlElem).val(data['pretty_url']);
                    }
                });
    }
   
JS;

$this->registerJs($js);
?>
<div class="row meta-tag">

    <div class="col-xs-12">
        <?= Html::tag('h3', AmosSeo::t('amosseo', '#meta_tag_title'), ['class' => 'subtitle-form']) ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'pretty_url')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#pretty_url_field_placeholder')])->hint(AmosSeo::t('amosseo', '#pretty_url_field_hint')) ?>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_title_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_title_field_hint')) ?>
        <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_description_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_description_field_hint')) ?>
        <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_keywords_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_keywords_field_hint')) ?>
    </div>

</div>

