<?php

namespace frontend\widgets;

use yii\base\Widget;
use src\entities\Subscribe;
use Yii;
/**
 * Class SubscribeWidget
 */
class SubscribeWidget extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $model = new Subscribe();
        $success = false;
        $error = false;
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->phone && !$model->email) {
                $error = true;
            } elseif ($model->create()) {
                $success = true;
                $model = new Subscribe();
            }
        }
        return $this->render('subscribe', [
            'model' => $model,
            'success' => $success,
            'error' => $error
        ]);
    }
}