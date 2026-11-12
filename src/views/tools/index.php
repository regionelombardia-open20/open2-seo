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

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = \open20\amos\seo\AmosSeo::t('amosseo', 'Genera Pretty Url mancanti');
$moduleName = \open20\amos\seo\AmosSeo::getModuleName()

?>
<div class="default-index">
    <div class="row">
        <?php
        foreach ($modules as $module) {
            $moduleName = $module::getModuleName();
            ?>
            <div class="generator col-lg-4">
                <h3><?= strtoupper($moduleName) ?></h3>
                <p><?= Html::a('Genera', Url::toRoute(['/'.$moduleName.'/tools/generate-missing-pretty-urls', 'moduleName' => $moduleName]), ['class' => 'btn btn-default']) ?></p>
            </div>
        <?php } ?>

    </div>
</div>




