<?php

namespace frontend\controllers;

use src\entities\company\Review;
use src\forms\company\ReviewForm;
use src\entities\company\Company;
use src\repositories\company\CompanyRepository;
use src\services\company\CompanyService;
use src\services\networks\Wall;
use Yii;
use src\services\networks\VkAuth;
use src\services\networks\FbAuth;
use yii\helpers\Json;
use src\services\networks\WallFB;

class CompanyController extends \yii\web\Controller
{
    //public $layout="dengi";
    private $companyService;
    private $companies;
    private $fbAuth;
    private $vkAuth;

    public function __construct(
        $id,
        $module,
        CompanyService $companyService,
        CompanyRepository $companies,
        FbAuth $fbAuth,
        VkAuth $vkAuth,

        array $config = [])
    {
        $this->companyService = $companyService;
        $this->companies = $companies;

        $this->fbAuth = $fbAuth;
        $this->vkAuth = $vkAuth;
        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action)
    {
        if ($action->id == 'auth') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionVseKompanii($sortby = false, $sort = false, $pay = false, $old = false)
    {
        if($sortby || $pay || $old)
            $comp_info = $this->companies->getCompaniesSortAll($sortby, $sort, $pay, $old);
        else
            $comp_info = $this->companies->getAllSortRaiting();

        return $this->render('vse-kompanii',[
            'companies' => $comp_info,
            'sortby'=>$sortby,
            'sort'=>$sort,
            'pay'=>$pay,
            'old'=>$old,
            //'theme'=>Theme::find()->where(['id'=>1])->one()
        ]);
    }
    public function actionWall($id)
    {
        $company = Company::findOne($id);
        $data = Yii::$app->cache->get('wall_time');
        if ($data === false) {
            //$d=Theme::find()->select('wall_update')->where(['id'=>1])->one()->wall_update;
            $d = 3600;
            Yii::$app->cache->set('wall_time', $d, $d);
        }
        if($company->vk_group) {
            $wall = (new Wall($company->vk_group))->getWall();
        }
        else if($company->fb_group && !$company->vk_group) {$fb_wall=(new WallFB($company->fb_group))->getWall();}

        return $this->renderAjax('_wall', [
            'wall'=>$wall,
            'fb_wall'=>$fb_wall,
        ]);
    }

    public function actionCompany($alias)
    {
        $company = $this->companies->getCompany($alias);

        $this->fbAuth->setUp($alias);
        $this->vkAuth->setUp($alias);

        $fbhref = $this->fbAuth->getHref();
        $vkhref = $this->vkAuth->getHref();
        $model=new ReviewForm();
        $model->star=3;
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->saveReview($company->id))
            {
                $model=new ReviewForm();
                $model->star=3;
            }
        }

        $rec = $this->companies->getRec();

        return $this->render('company',
            [
                'company'=>$company,
                'vkhref'=>$vkhref,
                'fbhref'=>$fbhref,
                'model'=>$model,
                'alias'=>$alias,
                'rec' => $rec,

            ]);
    }
    public function actionAuth($code, $ufrom)
    {
        $alias = substr($ufrom, 3);
        $ufrom = substr($ufrom, 0, 2);

        if ($ufrom=="vk" && isset($code) && isset($ufrom)) {

            $this->vkAuth->setUp($alias);
            $userInfo = $this->vkAuth->loginUser($code);
            if($userInfo)
                return $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
        }
        if ($ufrom == "fb" && isset($code) && isset($ufrom)) {
            $this->fbAuth->setUp($alias);
            $userInfo = $this->fbAuth->loginUser($code);
            if($userInfo)
                return $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
        }
        throw new \DomainException('something went wrong');
    }

    public function actionCompanyAmp($alias)
    {
        $company = $this->companies->getCompany($alias);

        $this->layout='amp';
        $rec = $this->companies->getRec();
        return $this->render('company-amp',[
            'company'=>$company,
            'alias'=>$alias,
            'rec' => $rec,
        ]);
    }

    public function actionPlus($id)
    {
        if(Yii::$app->user->identity->id)
        {
            $review = Review::findOne(['id'=>$id]);
            $user_id = $review->user_id;
            $users_like = $review->user_ids_like;
            $likes = $review->likes;
            if(
                !strripos($users_like, Yii::$app->user->identity->id."")
                &
                $user_id != Yii::$app->user->identity->id
            )
            {
                $likes++;
                $review->likes = $likes;
                $review->user_ids_like = $review->user_ids_like.",".Yii::$app->user->identity->id;
                $review->save();
                echo Json::encode(['likes'=>$likes]);
            }
            else echo Json::encode(['likes'=>$likes]);
        }
        else
            echo Json::encode(['likes'=>"no"]);
    }

    public function actionMinus($id)
    {
        if(Yii::$app->user->identity->id)
        {
            $review = Review::findOne(['id'=>$id]);
            $user_id = $review->user_id;
            $users_dislike = $review->user_ids_dislike;
            $likes = $review->likes;
            if(
                !strripos($users_dislike, Yii::$app->user->identity->id."")
                &
                $user_id != Yii::$app->user->identity->id
            )
            {
                $likes--;
                $review->likes=$likes;
                $review->user_ids_dislike = $review->user_ids_dislike.",".Yii::$app->user->identity->id;
                $review->save();
                echo Json::encode(['likes'=>$likes]);
            }
            else echo Json::encode(['likes'=>$likes]);
        }
        else
            echo Json::encode(['likes'=>"no"]);
    }
}
