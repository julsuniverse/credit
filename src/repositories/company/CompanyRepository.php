<?php

namespace src\repositories\company;

use src\entities\company\Company;
use yii\web\NotFoundHttpException;

class CompanyRepository
{
    public function get($id): Company
    {
        if (!$company = Company::findOne($id)) {
            throw new NotFoundHttpException('Компания не найдена');
        }
        return $company;
    }

    public function save(Company $company): Company
    {
        if (!$company->save()) {
            throw new \DomainException('Ошибка сохранения');
        }
        return $company;
    }

    public function remove(Company $company): void
    {
        if (!$company->delete()) {
            throw new \DomainException('Ошибка удаления');
        }
    }

    public function getCompany($alias)
    {
        if (!$company = Company::find()->where(['alias' => $alias])->one()) {
            throw new NotFoundHttpException('Компания не найдена');
        }
        return $company;
    }

    public function getCompaniesByIds($ids)
    {
        if(!$company = Company::find()->where(['id' => $ids])->orderBy('raiting DESC')->all())
            throw new \DomainException('Компании не найдены');
        return $company;
    }

    public function getRec()
    {
        if (!$company = Company::find()->where(['recommended' => 1])->limit(3)->orderBy('id DESC')->all()) {
            throw new NotFoundHttpException('Компании не найдены');
        }
        return $company;
    }

    public function getCompaniesSort($ids, $sortby, $sort, $pay, $old)
    {
        $query = Company::find()->where(['id'=>array_filter(explode(',', $ids))]);
        if($old)
            $query=  $query->andWhere(['<=', 'old', $old]);

        if($pay)
        {
            $pays = explode("-", $pay);
            $str="";
            for($i=0; $i<count($pays)-1; $i++)
                $str .= "`pay` like '%$pays[$i]%' OR ";
            $str = substr($str, 0, -4);
            $query = $query->andFilterWhere(['or',
                $str
            ]);
        }

        if($sortby)
            $query=$query->orderBy($sortby.' '.$sort);
        else
            $query=$query->orderBy('raiting DESC');
        return $query->all();
    }

    public function getCompaniesSortAll($sortby, $sort, $pay, $old)
    {
        $query = Company::find();
        if($old)
            $query=$query->andWhere(['<=', 'age', $old]);

        if($pay)
        {
            $pays = explode("-", $pay);
            $str = "";
            for($i = 0; $i < count($pays) - 1; $i++)
                $str .= "`pay` like '%$pays[$i]%' OR ";
            $str = substr($str, 0, -4);
            $query = $query->andFilterWhere(['or',
                $str
            ]);
        }

        if($sortby)
            $query = $query->orderBy($sortby.' '.$sort);
        else
            $query = $query->orderBy('raiting DESC');
        return $query->all();
    }

    public function getAllSortRaiting()
    {
        if(!$company = Company::find()->orderBy('raiting DESC')->all()) {
            throw new NotFoundHttpException('Компании не найдены');
        }
        return $company;

    }
}