<?php

namespace backend\controllers;

use common\models\repositories\CategoryRepository;
use common\models\repositories\ClientRepository;
use common\models\repositories\OrderRepository;
use Yii;
use common\models\search\ClientSearchModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ClientController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow'   => true,
                        'roles'   => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ClientSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'categories'   => $this->getCategories(),
        ]);
    }

    public function actionView($orderModel)
    {
        return $this->render('view', [
            //'model'      => $this->findModel($id),
            'categories' => $this->getCategories(),
        ]);
    }

    public function actionCreate()
    {
        $model = new ClientRepository();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $orderModel = new OrderRepository();
            $orderModel->client_id = $model->id;
            $orderModel->cost = $model->first_payment;
            $orderModel->save();

            return $this->redirect(['view', 'orderModel' => $orderModel]);
        }

        return $this->render('create', [
            'model'      => $model,
            'categories' => $this->getCategories(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model'      => $model,
            'categories' => $this->getCategories(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ClientRepository::getById($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCategories()
    {
        $items = [];

        $categories = CategoryRepository::getAll();
        foreach ($categories as $category) {
            $items[$category->id] = $category->category;
        }

        return $items;
    }
}
