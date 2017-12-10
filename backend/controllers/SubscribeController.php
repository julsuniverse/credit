<?php

namespace backend\controllers;

use src\entities\Subscribe;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SubscribeController extends Controller
{
    public function actionIndex($id = false)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subscribe::find()->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
