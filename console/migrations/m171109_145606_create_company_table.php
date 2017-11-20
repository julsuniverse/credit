<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m171109_145606_create_company_table extends Migration
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

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'h1' => $this->string(255)->notNull(),
            'desc' => $this->string(),
            'text' => $this->string(),
            'photo' => $this->string(255),
            'message' => $this->string(),
            'vk_group' => $this->string(255),
            'fb_group' => $this->string(255),
            'max_sum' => $this->integer(10),
            'max_termin' => $this->integer(10),
            'age' => $this->integer(3),
            'time_review' => $this->string(),
            'pay' => $this->string(),
            'stars' => $this->integer(1),
            'raiting' => $this->integer(10),
            'href' => $this->string(255),
            'checked' => $this->smallInteger(1),
            'overpayments' => $this->integer(10),
            'last_upd' => $this->string(255),
            'on_main' => $this->smallInteger(1),
            'recommended' => $this->smallInteger(1),
            'seo_title' => $this->string(255),
            'seo_desc' => $this->string(),
            'seo_keys' => $this->string()
        ], $tableOptions);
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
