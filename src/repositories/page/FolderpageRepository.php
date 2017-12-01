<?php

namespace src\repositories\page;

use src\entities\page\Folderpage;
use yii\web\NotFoundHttpException;

class FolderpageRepository
{
    public function getAll()
    {
        return Folderpage::find()->all();
    }

    public function getFolderName($id)
    {
        return Folderpage::find()->select(['name'])->where(['id' => $id])->one()->name;
    }
}