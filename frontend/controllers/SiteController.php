<?php
namespace frontend\controllers;

use src\forms\CreditForm;
use src\repositories\company\CompanyRepository;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use src\entities\Theme;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public $layout="dengi";

    private $companies;

    public function __construct(
        $id,
        $module,
        CompanyRepository $companies,
        array $config = []
    )
    {
        $this->companies = $companies;
        parent::__construct($id, $module, $config);
    }
    
    /**
     * Displays homepage.
     *
     * @return mixed
    */    
    public function actionIndex($sum = false, $termin = false, $sortby=false, $sort=false)
    {
        $theme = Theme::dataIndex();
        $model = new CreditForm();
        $sum = $sum ? $sum : $theme->default_sum;
        if ($model->load(Yii::$app->request->post()))
        {
            $sum = $model->sum ? Html::encode($model->sum) : $sum;
            $termin = $model->termin ? Html::encode($model->termin) : $termin;
        }
        $companies= $this->companies->getCompaniesToMainPage($sum, $termin, $sortby, $sort);

        return $this->render('index', [
            'model' => $model,
            'companies' => $companies,
            'sum' => $sum,
            'termin' => $termin,
            'sortby' => $sortby,
            'sort' => $sort,
            'theme' => $theme
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
