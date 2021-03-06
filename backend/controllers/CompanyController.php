<?php

namespace backend\controllers;

use moonland\phpexcel\Excel;
use src\forms\company\CompanyForm;
use src\forms\LoadFileForm;
use src\services\company\CompanyService;
use Yii;
use src\entities\company\Company;
use backend\search\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    private $companyService;

    public function __construct(
        $id,
        $module,
        CompanyService $companyService,
        array $config = []
    )
    {
        $this->companyService = $companyService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex($active=false)
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $active);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'active'=>$active
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CompanyForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try
            {
                $product = $this->companyService->create($form);
                return $this->redirect(['view', 'id' => $product->id]);
            }
            catch(\DomainException $e)
            {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);

    }


    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $company = $this->findModel($id);

        $form = new CompanyForm($company);
        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            try
            {
                $company = $this->companyService->edit($form, $company->id);
                return $this->redirect(['view', 'id' => $company->id]);
            }
            catch(\DomainException $e)
            {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'company' => $company
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLoad()
    {
        $model = new LoadFileForm();
        $path = '../web/excel/';
        if ($model->load(Yii::$app->request->post()))
        {
            if(UploadedFile::getInstance($model, 'file'))
            {
                $model->file=UploadedFile::getInstance($model, 'file');
                $model->file->saveAs($path.$model->file->baseName.".".$model->file->extension);
                $file=$path.$model->file->baseName.".".$model->file->extension;

                $data = Excel::widget([
                    'mode' => 'import',
                    'fileName' => $file,
                    'setFirstRecordAsKeys' => true,
                ]);
            }
            foreach($data as $d)
            {
                $company = new Company();
                $company->name = $d['Название']."";
                $company->alias = $d['name-url']."";
                $company->h1 = $d['h1']."";
                $company->title = $d['title']."";
                $company->seo_desc = $d['description']."";
                $company->seo_keys = $d['keywords']."";
                $company->vk_group = $d['Группа_VK']."";
                $company->fb_group = $d['Группа_Fb']."";
                $company->save();
            }
            return $this->redirect(['index']);
        }

        return $this->render('load', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
