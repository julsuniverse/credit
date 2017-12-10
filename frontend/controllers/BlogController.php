<?php

namespace frontend\controllers;
use src\entities\company\Company;
use src\repositories\page\PageRepository;
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

class BlogController extends \yii\web\Controller
{
    public $layout="dengi";
    private $pages;

    public function __construct(
        $id,
        $module,
        PageRepository $pages,
        array $config = []
    )
    {
        $this->pages = $pages;
        parent::__construct($id, $module, $config);
    }

    public function actionBlog()
    {
        $articles = $this->pages->getBlog();

        return $this->render('blog',[
            'articles'=>$articles,
        ]);
    }

}
