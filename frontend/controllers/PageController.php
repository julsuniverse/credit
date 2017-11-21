<?php

namespace frontend\controllers;
use src\repositories\company\CompanyRepository;
use src\repositories\page\OfferRepository;
use src\repositories\page\PageRepository;

class PageController extends \yii\web\Controller
{
   // public $layout="dengi";
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

    public function actionLanding($alias, $ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $page = $this->pages->getPage($alias);

        if($page->offer_id)
        {
            if($ids) {
                $comp_info = $this->companies->getCompaniesSort($ids, $sortby, $sort, $pay, $old);
            }
            else {
                $comp_ids = $this->offers->getOffer($page->offer_id);
                $ids = $comp_ids;
                $comp_ids = explode(",", $comp_ids);
                $comp_info = $this->companies->getCompaniesByIds($comp_ids);
            }
        }

        $articles = $this->pages->getRec();
        return $this->render('landing',[
            'page' => $page,
            'comp_info' => $comp_info,
            'ids'=>$ids,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
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
            $comp_ids = explode(",", $comp_ids);
            $comp_info = $this->companies->getCompaniesByIds($comp_ids);
        }

        return $this->render('landing-amp',[
            'page' => $page,
            'comp_info' => $comp_info,
        ]);
    }

}
