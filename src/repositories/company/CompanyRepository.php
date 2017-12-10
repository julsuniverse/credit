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

    public function getCompaniesByIds($ids, $sortby, $sort)
    {
        $comp_ids = explode(",", $ids);
        $query = Company::find()->where(['id' => $comp_ids]);
        $orderBy = $this->getSortData($sortby, $sort);
        
        $query = $query->orderBy($orderBy);

        return $query->all();
    }

    public function getRec()
    {
        return Company::find()->where(['recommended' => 1])->limit(3)->orderBy('id DESC')->all();
    }

    /*public function getCompanies($sum=false, $termin=false)
    {
        if(!$sum) {$sum=50000;}
        $query= Company::find()->where(['>=', 'max_sum', $sum])->andWhere(['!=', 'href', '']);
        if($termin)
        {
            $query=$query->andWhere(['>=', 'max_termin', $termin]);
        }

        $query=$query->all();
        $ids=$this->getIds($query);
        return [$query, $ids];
    }*/

    /*public function getIds($companies)
    {
        $str="";
        foreach($companies as $comp)
        {
            $str.=$comp->id.',';
        }
        return $str;
    }*/

    /*public function getCompaniesSort($ids, $sortby, $sort, $pay, $old)
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
    }*/
    
    public function getCompaniesToMainPage($sum, $termin, $sortby, $sort)
    {
        $query = Company::find()->where(['>=', 'max_sum', $sum])/*->andWhere(['on_main' => 1])*/;
        if ($termin) {
            $query = $query->andWhere(['>=', 'max_termin', $termin]);
        }

        $orderBy = $this->getSortData($sortby, $sort);
        
        $query = $query->orderBy($orderBy);

        return $query->all();
    }

    public function getCompaniesSortAll($sortby, $sort)
    {
        $query = Company::find();

        $orderBy = $this->getSortData($sortby, $sort);
        
        $query = $query->orderBy($orderBy);

        return $query->all();
    }
    
    public function getSortData($sortby, $sort)
    {
        $sortby = in_array($sortby, ['max_sum', 'max_termin', 'raiting']) ? $sortby : 'raiting';
        $sort = in_array($sort, ['DESC', 'ASC']) ? $sort : 'DESC';
        
        return $sortby.' '.$sort;
    }
}