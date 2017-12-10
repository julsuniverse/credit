<?php

namespace src\services\company;

use src\entities\company\Company;
use src\forms\company\CompanyForm;
use src\repositories\company\CompanyRepository;
use src\services\Imager;

class CompanyService
{
    private $companies;
    private $imager;

    public function __construct(CompanyRepository $companies, Imager $imager)
    {
        $this->companies = $companies;
        $this->imager = $imager;
    }

    public function create(CompanyForm $form): Company
    {
        $company = Company::create($form->name, $form->h1);
        $company->setSeo($form);
        $company->setPhoto($this->imager->savePhoto('photo', $company->photo, $form));
        $company->setFields($form);

        return $this->companies->save($company);
    }

    public function edit(CompanyForm $form, int $id): Company
    {
        $company = $this->companies->get($id);
        $company->setSeo($form);
        $company->setPhoto($this->imager->savePhoto('photo', $company->photo, $form));
        $company->setFields($form);

        return $this->companies->save($company);
    }

    public function remove($id): void
    {
        $company = $this->companies->get($id);
        $this->companies->remove($company);
    }

}