<?php

use yii\db\Migration;

/**
 * Handles adding networks to table `user`.
 */
class m171113_111746_add_networks_columns_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'user_id', $this->string(255));
        $this->addColumn('{{%user}}', 'name', $this->string(255));
        $this->addColumn('{{%user}}', 'photo', $this->string(255));
        $this->addColumn('{{%user}}', 'friends', $this->integer(10));
        $this->addColumn('{{%user}}', 'groups', $this->integer(10));
        $this->addColumn('{{%user}}', 'photos', $this->integer(10));
        $this->addColumn('{{%user}}', 'audios', $this->integer(10));
        $this->addColumn('{{%user}}', 'followers', $this->integer(10));
        $this->addColumn('{{%user}}', 'ball', $this->integer(10));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'user_id');
        $this->dropColumn('{{%user}}', 'name');
        $this->dropColumn('{{%user}}', 'photo');
        $this->dropColumn('{{%user}}', 'friends');
        $this->dropColumn('{{%user}}', 'groups');
        $this->dropColumn('{{%user}}', 'photos');
        $this->dropColumn('{{%user}}', 'audios');
        $this->dropColumn('{{%user}}', 'followers');
        $this->dropColumn('{{%user}}', 'ball');
    }
}
