<?php

namespace frontend\controllers;
use src\entities\company\Company;
use Yii;
use frontend\models\CreditForm;
use yii\helpers\Html;
use common\models\Page;
use common\models\Offer;
use frontend\components\VkAuth;
use frontend\components\FbAuth;
use frontend\models\ReviewForm;
use common\models\Review;
use common\models\Bottommenu;
use common\models\RecArticle;
use common\models\RecCompany;
use yii\helpers\Json;
use frontend\components\Wall;
use yii\web\BadRequestHttpException;
use frontend\components\WallFB;
use common\models\Theme;

class PageController extends \yii\web\Controller
{
    public $layout="dengi";

    public function actionLanding($alias, $ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $page = (new Page)->getPage($alias);
        if(!$page)
        {
            throw new BadRequestHttpException('Страница не найдена');
        }

        if($page->offer_id)
        {
            if($ids)
            {
                $comp_info=(new Company())->getCompaniesSort($ids, $sortby, $sort, $pay, $old);
                //$sharp="company_list";
            }
            else{
                $comp_ids = Offer::find()->select('ids')->where(['id' => $page->offer_id])->one()->ids;
                $ids=$comp_ids;
                $comp_ids = explode(",", $comp_ids);
                $comp_info = Company::find()->where(['id' => $comp_ids])->orderBy('raiting DESC')->all();
            }
        }

        $rec = (new RecArticle)->getPreview();
        $articles = (new RecArticle)->getArticles();
        return $this->render('landing',[
            'page' => $page,
            //'cid' => $comp_ids,
            'comp_info' => $comp_info,
            'sum'=>$sum,
            'ids'=>$ids,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
            'rec' => $rec,
            'articles' => $articles,
        ]);
    }

    public function actionLandingAmp($alias)
    {
        $page = (new Page)->getPage($alias);
        if(!$page)
        {
            throw new BadRequestHttpException('Страница не найдена');
        }
        $this->layout='amp';
        if($page->offer_id)
        {
            $comp_ids = Offer::find()->select('ids')->where(['id' => $page->offer_id])->one()->ids;
            $ids=$comp_ids;
            $comp_ids = explode(",", $comp_ids);
            $comp_info = Company::find()->where(['id' => $comp_ids])->orderBy('raiting DESC')->all();
        }

        return $this->render('landing-amp',[
            'page' => $page,
            'comp_info' => $comp_info,
        ]);
    }

}
