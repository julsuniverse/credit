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

}