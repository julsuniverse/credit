<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribe`.
 */
class m171209_113104_create_subscribe_table extends Migration
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
        $this->createTable('subscribe', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'date' => $this->string()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribe');
    }
}
