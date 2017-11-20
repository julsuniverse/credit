<?php

use yii\db\Migration;

/**
 * Handles the creation of table `folderpage`.
 */
class m171120_155007_create_folderpage_table extends Migration
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

        $this->createTable('{{%folderpage}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('folderpage');
    }
}
