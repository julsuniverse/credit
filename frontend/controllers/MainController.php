<?php

namespace frontend\controllers;
use src\entities\company\Company;
use src\forms\CreditForm;
use src\repositories\company\CompanyRepository;
use Yii;
use yii\helpers\Html;

class MainController extends \yii\web\Controller
{
    public $layout="dengi";
    private $companies;
    public function __construct($id, $module, CompanyRepository $companies, array $config = [])
    {
        $this->companies = $companies;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($ids=false, $sortby=false, $sort=false, $pay=false, $old=false)
    {
        $model=new CreditForm();
        $sharp='';
        $default_sum = 3000;//(new Theme)->getSum();
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


    public function actionBlog()
    {
        $articles = Page::find()->where(['like', 'alias', 'blog/'])->all();
        $rec = $this->pages->getRec();
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

    public function actionLogout($alias)
    {
        Yii::$app->user->logout();
        
        return $this->redirect(['company', 'alias'=>$alias, '#'=>'add-review']);
    }
}
