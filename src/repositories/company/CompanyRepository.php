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
}