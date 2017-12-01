<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Offer;
use backend\models\Folderpage;
/* @var $this yii\web\View */
/* @var $searchModel backend\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin();?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>Папки страниц</h3>
            <a class="create btn btn-primary btn-sm" href="<?= Url::toRoute(["folderpage/create"]);?>" style="margin-bottom: 10px;">Создать папку</a>
                <ul class="list-group">
                    <li class="list-group-item" style="<?php if(!$id){echo "background-color: #f2f2f2;";} ?>">
                        <a style="<?php if(!$id){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["page/index"]);?>">Вне папок</a>
                    </li>
                <?php foreach($folders as $folder) { ?>
                    <li class="list-group-item" style="<?php if($folder->id == $id){echo "background-color: #f2f2f2;";} ?>">
                        <a style="<?php if($folder->id == $id){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["page/index", 'id' => $folder->id]);?>"><?= $folder->name;?></a>
                        <a class="update" data-id="<?=$folder->id;?>" href="<?= Url::toRoute(["folderpage/update", 'id' => $folder->id]);?>" title="Редактировать"> <span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="<?= Url::toRoute(["folderpage/delete", 'id' => $folder->id]);?> "  title="Удалить" aria-label="Удалить" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a>
                    </li>
                <?php } ?>
                </ul>
        </div>
        <div class="col-md-9" style="width: 69%;">
        <h4><?php if($foldername){ echo "Папка ".$foldername; }else { echo "Страницы вне папок"; }?></h4>
        <?php Pjax::begin(); ?>    
        <?php if(count($ids) || count($free)){?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            //'id',
            'h1',
            'alias',
            //'offer_id',
            [
                'attribute'=>'offer_id',
                'filter'=> $searchModel->offerList(),
                'value'=>'offer.name'
            ],
           // 'text_1:ntext',
            // 'expert_text:ntext',
            // 'text_2:ntext',
            // 'helpfull',
            // 'seo_title',
            // 'seo_desc:ntext',
            // 'seo_keys:ntext',
            // 'expert_title',
            ],
        ]); ?>
        <?php }?>
        <?php Pjax::end(); ?>    
        </div>
    </div>
</div>
<?php Pjax::end();?>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Создать папку</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<?php

$url2=Url::toRoute(["page/getform"]);
$script = <<< JS
    $(".create").on("click", function(e){
        e.preventDefault();
      $.get('$url2', {id : 0}, function(data){
        /*var data= $.parseJSON(data);*/
        $(".modal-body").html(data);
        $("#createModal").modal("show");
       }); 
    });
JS;
$this->registerJs($script);
?>
<?php
$url2=Url::toRoute(["page/getform"]);
$script = <<< JS
    $(".update").on("click", function(e){
        e.preventDefault();
      $.get('$url2', {id : $(this).attr('data-id')}, function(data){
        /*var data= $.parseJSON(data);*/
        $(".modal-body").html(data);
        $("#createModal").modal("show");
       }); 
    });
JS;
$this->registerJs($script);
?>
<?php /*
    $this->registerJs(
        '$("document").ready(function(){
            $(".create").on("click", function(e){
                e.preventDefault();
                $("#createModal").modal("show");
            });
        });'
    );
*/?>