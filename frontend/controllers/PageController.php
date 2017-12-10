<?php

namespace frontend\controllers;
use src\repositories\company\CompanyRepository;
use src\repositories\page\OfferRepository;
use src\repositories\page\PageRepository;

class PageController extends \yii\web\Controller
{
    public $layout="dengi";
    private $pages;
    private $companies;
    private $offers;

    public function __construct(
        $id,
        $module,
        PageRepository $pages,
        CompanyRepository $companies,
        OfferRepository $offers,
        array $config = []
    )
    {
        $this->pages = $pages;
        $this->companies = $companies;
        $this->offers = $offers;
        parent::__construct($id, $module, $config);
    }

    public function actionLanding($alias, $sortby=false, $sort=false)
    {
        $page = $this->pages->getPage($alias);

        if($page->offer_id)
        {
            $comp_ids = $this->offers->getOffer($page->offer_id);
            $comp_info = $this->companies->getCompaniesByIds($comp_ids, $sortby, $sort);
        }

        $articles = $this->pages->getRec();
        return $this->render('landing',[
            'page' => $page,
            'comp_info' => $comp_info,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'articles' => $articles,
        ]);
    }

    public function actionLandingAmp($alias)
    {
        $page = $this->pages->getPage($alias);
        $this->layout='amp';
        if($page->offer_id)
        {
            $comp_ids = $this->offers->getOffer($page->offer_id);
            $comp_info = $this->companies->getCompaniesByIds($comp_ids, $sortby, $sort);
        }

        return $this->render('landing-amp',[
            'page' => $page,
            'comp_info' => $comp_info,
        ]);
    }

}
