<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $partners */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'layout'       => '{items}{pager}',
        'columns'      => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'username',
            //'auth_key',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'attribute' => 'partners_ids',
                'value'     => function ($model) use ($partners) {
                    /* @var \common\models\repositories\UserRepository $model */
                    $partnersIds = $model->partners_ids ? explode(',', $model->partners_ids) : [];
                    $html = '';
                    foreach ($partnersIds as $id) {
                        if (isset($partners[$id])) {
                            $html .= $partners[$id] . ' | ';
                        }
                    }

                    return $html;
                },
            ],
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
