<?php
namespace src\forms;

use yii\base\Model;

class SeoForm extends Model
{
    public $seo_title;
    public $seo_desc;
    public $seo_keys;

    public function rules()
    {
        return [
            [['seo_title'], 'string', 'max' => 255],
            [['seo_desc', 'seo_keys'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'seo_title' => 'Seo заголовок',
            'seo_desc' => 'Seo описнаие',
            'seo_keys' => 'Seo ключевые слова',
        ];
    }
}