<?php

use yii\db\Migration;

/**
 * Handles the creation of table `review`.
 */
class m171113_120224_create_review_table extends Migration
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

        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'user_id' => $this->integer(10)->notNull(),
            'company_id' => $this->integer(10)->notNull(),
            'stars' =>  $this->integer(10)->notNull(),
            'date' => $this->string(255)->notNull(),
            'raiting' => $this->integer(10),
            'likes' => $this->integer(10),
            'user_ids_like' => $this->string(),
            'user_ids_dislike' => $this->string(),
            'ball' => $this->integer(10),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-review-user',
            'review',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-review-user_id',
            'review',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // creates index for column `company_id`
        $this->createIndex(
            'idx-review-company',
            'review',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-review-company_id',
            'review',
            'company_id',
            'company',
            'id',
            'CASCADE',
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
            'fk-review-user_id',
            'review'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-review-user',
            'review'
        );

        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-review-company_id',
            'review'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-review-company',
            'review'
        );

        $this->dropTable('review');
    }
}
