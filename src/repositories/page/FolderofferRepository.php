<?php

namespace src\repositories\page;

use src\entities\page\Folderoffer;

class FolderofferRepository
{

    public function getAll()
    {
        return Folderoffer::find()->all();
    }

    public function getFolderName($id)
    {
        return Folderoffer::find()->select(['name'])->where(['id' => $id])->one()->name;
    }
}