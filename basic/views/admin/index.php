<?php
/** @var yii\web\View $this */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Панель админинстратора</h1>
<?php
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'category.name',
        'firstname',
        'name',
        'description:ntext',
        [
            'label' => 'Статус заявки',
            'attribute' => 'status',
            'value' => function ($data) {
                if ($data->status==0) return 'Новая';
                if ($data->status==1) return 'Завершенная';
                if ($data->status==2) return 'Отмененная';
            },
            'filter' => ['0' => 'Новая', '1' => 'Завершенная', '2' => 'Отмененная'],
            'filterInputOptions' => ['prompt' => 'Все статусы', 'class' => 'form-control', 'id' => null]
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>

<p>
    <?= Html::a('Управление категориями', ['category/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Управление заявками', ['/request'], ['class' => 'btn btn-success']) ?>
</p>