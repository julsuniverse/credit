<?php
namespace frontend\controllers;

use src\services\contact\ContactService;
use Yii;
use yii\web\Controller;
use src\forms\ContactForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Contact controller
 */
class ContactController extends Controller
{
    /**
     * @inheritdoc
     */
    private $contactService;

    public function __construct($id, $module, ContactService $contactService, array $config = [])
    {
        $this->contactService = $contactService;
        parent::__construct($id, $module, $config);
    }

     /**
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        /*if (!Yii::$app->request->isAjax) {
            return null;        
        }
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post())) {
            if (!$form->validate()) {
                return $form->getFirstError('email');
            }
            return $this->contactService->create($form);
        }*/
    }
    /*public function actionValidateSubscribe()
    {
        $model = new ContactForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }*/
}
