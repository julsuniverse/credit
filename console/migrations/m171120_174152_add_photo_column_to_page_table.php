<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `page`.
 */
class m171120_174152_add_photo_column_to_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%page}}', 'photo', $this->string(255));

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%page}}', 'photo');

    }
}
