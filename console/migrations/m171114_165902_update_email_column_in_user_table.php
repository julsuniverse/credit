<?php

use yii\db\Migration;

/**
 * Class m171114_155357_update_email_column_in_user_table
 */
class m171114_165902_update_email_column_in_user_table extends Migration
{

    public function up()
    {
        // drops index for column `email`
        $this->dropIndex(
            'email',
            '{{%user}}'
        );
    }

    public function down()
    {
        $this->createIndex(
            'email',
            '{{%user}}',
            'email'
        );
    }

}
