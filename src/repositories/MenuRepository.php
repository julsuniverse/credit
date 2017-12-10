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
        if(!$pages = Menu::find()->where(['placement' => 1])->orderBy('column')->all())
            throw new \DomainException('Пункты меню не найдены');
        return $pages;
    }

    public static function getFooterMenuPages()
    {
        if(!$pages = Menu::find()->where(['placement' => 2])->orderBy('column')->all())
            throw new \DomainException('Пункты меню не найдены');
        return $pages;
    }
}