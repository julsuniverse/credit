<?php

namespace src\entities;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property integer $id
 * @property string $vk_link
 * @property string $fb_link
 * @property string $site_link
 * @property string $wall_update
 * @property string $bott_col1
 * @property string $bott_col2
 * @property string $bott_col3
 * @property string $bott_col4
 * @property string $foot_col1
 * @property string $foot_col2
 * @property string $foot_col3
 * @property string $foot_col4
 * @property string $seo_title_main
 * @property string $seo_desc_main
 * @property string $seo_keys_main
 * @property string $seo_title_vse
 * @property string $seo_desc_vse
 * @property string $seo_keys_vse
 * @property string $seo_title_blog
 * @property string $seo_desc_blog
 * @property string $seo_keys_blog
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['default_sum','vk_link', 'fb_link', 'site_link', 'wall_update', 'bott_col1', 'bott_col2', 'bott_col3', 'bott_col4', 'foot_col1', 'foot_col2', 'foot_col3', 'foot_col4', 'seo_title_main', 'seo_desc_main', 'seo_keys_main', 'seo_title_vse', 'seo_desc_vse', 'seo_keys_vse', 'seo_title_blog', 'seo_desc_blog', 'seo_keys_blog'], 'string', 'max' => 255],
            [['metrics', 'alldesc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metrics' => 'Метрики',
            'default_sum' => 'Сумма по умолчанию',
            'vk_link' => 'Vk ссылка',
            'fb_link' => 'Fb ссылка',
            'site_link' => 'Ссылка на сайт',
            'wall_update' => 'Обновление стены',
            'bott_col1' => 'Нижнее меню колонка 1',
            'bott_col2' => 'Нижнее меню колонка 2',
            'bott_col3' => 'Нижнее меню колонка 3',
            'bott_col4' => 'Нижнее меню колонка 4',
            'foot_col1' => 'Меню в футоре колонка 1',
            'foot_col2' => 'Меню в футоре колонка 2',
            'foot_col3' => 'Меню в футоре колонка 3',
            'foot_col4' => 'Меню в футоре колонка 4',
            'seo_title_main' => 'Seo Title Главная',
            'seo_desc_main' => 'Seo Description Главная',
            'seo_keys_main' => 'Seo Keys Главная',
            'seo_title_vse' => 'Seo Title Все компании',
            'seo_desc_vse' => 'Seo Description Все компании',
            'seo_keys_vse' => 'Seo Keys Все компании',
            'seo_title_blog' => 'Seo Title Блог',
            'seo_desc_blog' => 'Seo Description Блог',
            'seo_keys_blog' => 'Seo Keys Блог',
            'alldesc'=>'Описание внизу страницы все компании'
        ];
    }
    public static function dataIndex()
    {
        return static::find()->select(['default_sum','bott_col1', 'bott_col2','bott_col3', 'bott_col4', 'seo_title_main', 'seo_desc_main','seo_keys_main' ])->where(['id'=>1])->one();
    }
    public static function dataLayout()
    {
        return static::find()->select(['metrics','vk_link','fb_link','site_link','foot_col1','foot_col2','foot_col3','foot_col4' ])->where(['id'=>1])->one();
    }
    public static function vseCompanii()
    {
        return static::find()->select(['seo_title_vse', 'seo_desc_blog', 'seo_keys_blog'])->where(['id'=>1])->one();
    }
    public static function getSum()
    {
        return static::find()->select(['default_sum'])->where(['id'=>1])->one()->default_sum;
    }
    
}
