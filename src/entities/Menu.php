<?php

namespace src\entities;

use Yii;
use src\entities\page\Page;
use src\entities\company\Company;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $placement
 * @property integer $column
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'placement'], 'required'],
            [['placement', 'column'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '	Название пункта меню',
            'alias' => 'УРЛ',
            'placement' => 'Положение меню',
            'column' => 'Колонка',
        ];
    }
    
    public function findAliases()
    {
        $pages = Page::findAliases();
        $companies = Company::findAliases();
        $array = ['vse-kompanii' => 'vse-kompanii', 'blog' => 'blog', 'about' => 'about'];
        return array_merge($pages, $companies, $array);
    }
}
