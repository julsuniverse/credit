<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m171120_155701_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'h1' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'offer_id' => $this->integer(10),
            'short_desc' => $this->text(),
            'text_1' => $this->text(),
            'expert_title' => $this->string(255),
            'expert_text' => $this->text(),
            'text_2' => $this->text(),
            'folder_id' => $this->integer(10),
            'helpfull' => $this->smallInteger(1),
            'recommended' => $this->smallInteger(1),
            'seo_title' => $this->string(255),
            'seo_desc' => $this->text(),
            'seo_keys' => $this->text()
        ], $tableOptions);

        // creates index for column `offer_id`
        $this->createIndex(
            'idx-page-offer',
            'page',
            'offer_id'
        );

        // add foreign key for table `offer`
        $this->addForeignKey(
            'fk-page-offer_id',
            'page',
            'offer_id',
            'offer',
            'id',
            'SET NULL',
            'CASCADE'
        );

        // creates index for column `offer_id`
        $this->createIndex(
            'idx-page-folderpage',
            'page',
            'folder_id'
        );

        // add foreign key for table `offer`
        $this->addForeignKey(
            'fk-page-folder_id',
            'page',
            'folder_id',
            'folderpage',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-page-offer_id',
            'page'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-page-offer',
            'page'
        );

        $this->dropForeignKey(
            'fk-page-folder_id',
            'page'
        );

        $this->dropIndex(
            'idx-page-folderpage',
            'page'
        );

        $this->dropTable('page');
    }
}

