<?php

namespace src\entities\page;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property string $name
 * @property integer $folder
 * @property integer $ids
 *
 * @property Folderoffer $folder0
 * @property Page[] $pages
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ids'], 'required'],
            [['folder', 'ids'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['folder'], 'exist', 'skipOnError' => true, 'targetClass' => Folderoffer::className(), 'targetAttribute' => ['folder' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'folder' => 'Folder',
            'ids' => 'Ids',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder0()
    {
        return $this->hasOne(Folderoffer::className(), ['id' => 'folder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['offer_id' => 'id']);
    }
}
