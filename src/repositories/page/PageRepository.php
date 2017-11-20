<?php

namespace src\repositories\page;

use src\entities\page\Page;
use yii\web\NotFoundHttpException;

class PageRepository
{
    public function getPage($alias)
    {
        if(!$page = Page::find()->where(['alias' => $alias])->one())
            throw new NotFoundHttpException('Страница не найдена');
        return $page;
    }

    public function getFreepage()
    {
        if(!$page = Page::find()->select(['id'])->where(['folder' => ''])->orWhere(['folder'=>null])->all())
            throw new NotFoundHttpException('Страница не найдена');
        return $page;
    }

    public function getRec()
    {
        if(!$page = Page::find()->where(['recommended' => 1])->limit(3)->orderBy('id DESC')->all())
            throw new \DomainException('Рекомендуемые страницы не найдены');
        return $page;
    }
}