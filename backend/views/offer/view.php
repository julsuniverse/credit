<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $model common\models\Offer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Офферы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">

    <p>
        <?= Html::a('Редакторовать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'ids',
        ],
    ]) ?>
    <table id="w0" class="table table-striped table-bordered detail-view">
    <tbody>
    <tr>
    <th>УРЛы компаний</th>
    <td>
    <?php $ids=explode(',', $model->ids);
            $str="";
            for($i=0;$i<count($ids);$i++)
            {
                $str.=Company::find()->select('alias')->where(['id'=>$ids[$i]])->one()->alias."<br/>";
            }
            echo $str;
    ?>
    </td>
    </tr>
    </tbody>
    </table>

</div>
