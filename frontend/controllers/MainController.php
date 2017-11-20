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

class MainController extends \yii\web\Controller
{
    public $layout="dengi";
    public function beforeAction($action)
    {            
        if ($action->id == 'company') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    public function actionIndex($ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $model=new CreditForm();
        $sharp='';
        $default_sum = (new Theme)->getSum();
        $sum=$default_sum;
        if ($model->load(Yii::$app->request->post()))
        {
            $comps=(new Company())->getCompanies(Html::encode($model->sum), Html::encode($model->termin), Html::encode($model->where));
            $companies=$comps[0];
            $ids=$comps[1];
            $sum=Html::encode($model->sum);
            $sortby=false; $sort=false; $pay=false; $old=false;
            $sharp='companies';
        }
        else if(!$ids)
        {
            $comps=(new Company())->getCompanies($default_sum);
            $companies=$comps[0];
            $sum=$default_sum;
            $ids=$comps[1];
        }
        else
        {
            $companies=(new Company())->getCompaniesSort($ids, $sortby, $sort, $pay, $old);
            $sharp="company_list";
        }
        
        $bottommenu = Bottommenu::find()->all();
        
        return $this->render('index', [
            'model'=>$model,
            'companies'=>$companies,
            'sum'=>$sum,
            'ids'=>$ids,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
            'sharp'=>$sharp,
            'bottommenu' => $bottommenu,
        ]);
        //print_r($default_sum);
    }
    
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


    public function actionBlog()
    {
        $articles = Page::find()->where(['like', 'alias', 'blog/'])->all();
        $rec = (new RecArticle)->getPreview();
        foreach($articles as $a)
        {
            if($a->id == $rec->article1)
                $img[] = $rec->img1;
            elseif($a->id == $rec->article2)
                $img[] = $rec->img2;
            elseif($a->id == $rec->article3)
                $img[] = $rec->img3;    
        }
        
        return $this->render('blog',[
            'articles'=>$articles,
            'img' => $img,
        ]);
    }

   public function actionLink($id)
    {
       echo Company::find()->select('href')->where(['id'=>$id])->one()->href;
    }
    public function actionTest()
    {
        print_r(\common\models\User::find()->where(['username'=>'fb_id= 1290079867711604'])->one());
    }
    public function actionLogout($alias)
    {
        Yii::$app->user->logout();
        
        return $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
    }
}
