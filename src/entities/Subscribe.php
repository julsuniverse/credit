<?php

namespace src\entities;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $phone
 * @property string $email
 * @property string $date
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }
    
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->date = date('U');
        return $this->save();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'email', 'date'], 'string', 'max' => 20],
            ['phone', 'match', 'pattern' => '/^[0-9+]+$/i', 'message' => Yii::t('main', 'Телефон может содержать только плюс и цифры')],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'E-mail'),
            'date' => 'Date',
        ];
    }
}
