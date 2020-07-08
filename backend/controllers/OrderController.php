<?php

namespace backend\controllers;

use common\models\repositories\CategoryRepository;
use common\models\repositories\ClientRepository;
use common\models\repositories\OrderRepository;
use Yii;
use common\models\db\Order;
use common\models\search\OrderSearchModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OrderController extends Controller
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
        $searchModel = new OrderSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'clients'      => $this->getClients(),
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model'   => $this->findModel($id),
            'clients' => $this->getClients(),
        ]);
    }

    public function actionCreate()
    {
        $model = new OrderRepository();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model'   => $model,
            'clients' => $this->getClients(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model'   => $model,
            'clients' => $this->getClients(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = OrderRepository::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getClients()
    {
        $items = [];

        $clients = ClientRepository::getAll();
        foreach ($clients as $client) {
            $items[$client->id] = $client->lastname . ' ' . $client->firstname . ' ' . $client->middlename . ' ' . $client->phone;
        }

        return $items;
    }
}
