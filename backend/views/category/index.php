<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории ВУ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'layout'       => '{items}{pager}',
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'category',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons'  => [
                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-pen"></span>',
                            $url);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="fa fa-trash"></span>',
                            $url);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
