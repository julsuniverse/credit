<?php

namespace src\entities\page;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $h1
 * @property string $alias
 * @property integer $offer_id
 * @property string $short_desc
 * @property string $text_1
 * @property string $expert_title
 * @property string $expert_text
 * @property string $text_2
 * @property integer $folder_id
 * @property integer $helpfull
 * @property integer $recommended
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keys
 * @property string $photo
 *
 * @property Folderpage $folder
 * @property Offer $offer
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h1', 'alias'], 'required'],
            [['offer_id', 'folder_id', 'helpfull', 'recommended'], 'integer'],
            [['short_desc', 'text_1', 'expert_text', 'text_2', 'seo_desc', 'seo_keys'], 'string'],
            [['h1', 'alias', 'expert_title', 'seo_title'], 'string', 'max' => 255],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folderpage::className(), 'targetAttribute' => ['folder_id' => 'id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
            ['photo','file','skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'h1' => 'H1',
            'alias' => 'УРЛ',
            'folder_id' => 'Папка',
            'offer_id' => 'Выбор оффера',
            'short_desc' => 'Превью',
            'text_1' => 'Текст 1',
            'expert_text' => 'Мнение эксперта',
            'text_2' => 'Текст 2',
            'helpfull' => 'Отображать полезные статьи?',
            'recommended' => 'В полезные статьи',
            'photo' => 'Превью для полезных статей',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Desc',
            'seo_keys' => 'Seo Keys',
            'expert_title' => 'Заголовок мнения эксперта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folderpage::className(), ['id' => 'folder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
    
    public static function findAliases()
    {
        return self::find()->select('alias')->indexBy('alias')->orderBy('h1')->column();
    }
}
