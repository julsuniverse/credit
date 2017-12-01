<?php

namespace src\repositories\page;

use src\entities\page\Offer;

class OfferRepository
{
    public function getOffer($id)
    {
        if(!$offer = Offer::find()->select('ids')->where(['id' => $id])->one()->ids)
            throw new \DomainException('Оффер не найден');
        return $offer;
    }

    public function getIds($id)
    {
        $pages= Offer::find()->where(['folder'=>$id])->all();
        $ids=[];
        foreach ($pages as $page)
        {
            $ids[$page->id]=$page->id;
        }
        return $ids;
    }

    public function getFreepage()
    {
        return Offer::find()->select(['id'])->where(['folder' => ''])->orWhere(['folder'=>null])->all();
    }

}