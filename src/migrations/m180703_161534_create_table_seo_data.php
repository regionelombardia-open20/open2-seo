<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\seo\migrations
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

use open20\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m180703_161534_create_table_seo_data
 */
class m180703_161534_create_table_seo_data extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%seo_data}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'classname' => $this->string(255)->null()->comment('Content Class Name'),
            'content_id' => $this->integer(11)->comment('Table Content id'),
            'pretty_url' => $this->string(255)->null()->unique()->comment('Seo Pretty Url'),
            'meta_title' => $this->text()->null(),
            'meta_description' => $this->text()->null(),
            'meta_keywords' => $this->text()->null(),
            'og_title' => $this->text()->null(),
            'og_description' => $this->text()->null(),
            'og_type' => $this->string(255)->null(),
            'meta_robots' => $this->string(255)->null(),
            'meta_googlebot' => $this->string(255)->null(),
            'unavailable_after_date' => $this->dateTime()->null()->comment('Begin Date And Hour'),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function beforeTableCreation()
    {
        parent::beforeTableCreation();
        $this->setAddCreatedUpdatedFields(true);
    }

    
    protected function afterForeignKeysAdd() {
        $this->createIndex(
            'idx-classname-content_id',
            $this->tableName,
            'classname,content_id',
            true //unique
        );
    }
}
