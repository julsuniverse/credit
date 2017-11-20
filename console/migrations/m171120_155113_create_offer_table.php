<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offer`.
 */
class m171120_155113_create_offer_table extends Migration
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

        $this->createTable('{{%offer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'folder' => $this->integer(10),
            'ids' => $this->string(255)->notNull()
        ], $tableOptions);

        // creates index for column `offer_id`
        $this->createIndex(
            'idx-offer-folderoffer',
            'offer',
            'folder'
        );

        // add foreign key for table `offer`
        $this->addForeignKey(
            'fk-offer-folder',
            'offer',
            'folder',
            'folderoffer',
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
        $this->dropForeignKey(
            'fk-offer-folder',
            'offer'
        );

        $this->dropIndex(
            'idx-offer-folderoffer',
            'offer'
        );

        $this->dropTable('offer');
    }
}

