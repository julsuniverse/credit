<?php
namespace src\repositories;

use src\entities\Menu;

class MenuRepository
{
    public static function getTopMenuPages()
    {
        if(!$pages = Menu::find()->select(['name', 'alias'])->where(['placement' => 0])->all())
            throw new \DomainException('Пункты меню не найдены');
        return $pages;
    }

    public static function getBottomMenuPages()
    {
        if(!$pages = Menu::find()->select(['name', 'alias', 'column'])->where(['placement' => 1])->all())
            throw new \DomainException('Пункты меню не найдены');
        return $pages;
    }

    public static function getFooterMenuPages()
    {
        if(!$pages = Menu::find()->select(['name', 'alias', 'column'])->where(['placement' => 2])->all())
            throw new \DomainException('Пункты меню не найдены');
        return $pages;
    }
}