<?php

namespace backend\controllers;

use src\entities\page\Folderpage;
use src\repositories\page\FolderpageRepository;
use src\repositories\page\PageRepository;
use Yii;
use src\entities\page\Page;
use backend\search\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    private $folders;
    private $pages;
    private $searchModel;
    public function __construct(
        $id,
        $module,
        FolderpageRepository $folders,
        PageRepository $pages,
        PageSearch $searchModel,
        array $config = []
    )
    {
        $this->folders = $folders;
        $this->pages = $pages;
        $this->searchModel = $searchModel;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($id = false)
    {
        $id ? $ids = $this->pages->getIds($id) : $free = $this->pages->getFreepage();
        /*if($id)
            $ids = $this->pages->getIds($id);
        else
            $free = $this->pages->getFreepage();*/

        $foldername = $this->folders->getFoldername($id);
        $searchModel = $this->searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ids, $free);

        $folders = $this->folders->getAll();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'folders' => $folders,
            'id' => $id,
            'foldername' => $foldername,
            'ids'=>$ids,
            'free'=>$free
        ]);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post())) {

            if(UploadedFile::getInstance($model, 'photo'))
            {
                $model->photo=UploadedFile::getInstance($model, 'photo');
                $model->photo->saveAs('../../frontend/web/img/'.$model->photo->baseName.".".$model->photo->extension);
                $model->photo=$model->photo->baseName.".".$model->photo->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionGetform($id)
    {
        if($id)
        {
            $model = $this->findModel($id);
            $act='update';
        }
        else
        {
            $model= new Folderpage();
            $act="create";
        }

        return $this->renderAjax('/folderpage/_form', ['model'=>$model, 'act'=>$act]);
    }
    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img = $model->photo;
        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'photo'))
            {
                $model->photo=UploadedFile::getInstance($model, 'photo');
                $model->photo->saveAs('../../frontend/web/img/'.$model->photo->baseName.".".$model->photo->extension);
                $model->photo=$model->photo->baseName.".".$model->photo->extension;
            }
            else
                $model->photo = $img;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
