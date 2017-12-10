<?php 
use yii\widgets\ListView;
$this->title = "Подписчики";
?>
<table class="table table-bordered">
    <tr>
        <td><b>Телефон</b></td>
        <td><b>E-mail</b></td>
    </tr>
<?php 
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
]);
?>
</table>