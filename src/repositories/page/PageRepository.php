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
        if(!$page = Page::find()->select(['id'])->where(['folder_id' => ''])->orWhere(['folder_id'=>null])->all())
            throw new NotFoundHttpException('Страница не найдена');
        return $page;
    }

    public function getRec()
    {
        if(!$page = Page::find()->where(['recommended' => 1])->limit(3)->orderBy('id DESC')->all())
            throw new \DomainException('Рекомендуемые страницы не найдены');
        return $page;
    }

    public function getBlog()
    {
        if(!$page = Page::find()->where(['like', 'alias', 'blog/'])->all())
            throw new NotFoundHttpException('Страницы блога не найдены');
        return $page;
    }

    public function getIds($id)
    {
        $pages = Page::find()->where(['folder_id'=>$id])->all();
        $ids=[];
        foreach ($pages as $page)
        {
            $ids[$page->id]=$page->id;
        }
        return $ids;
    }
}