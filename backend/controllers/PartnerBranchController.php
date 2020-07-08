<?php

namespace backend\controllers;

use common\models\repositories\CategoryRepository;
use common\models\repositories\ClientRepository;
use common\models\repositories\PartnerBranchRepository;
use common\models\repositories\PartnerRepository;
use Yii;
use common\models\db\PartnerBranch;
use common\models\search\PartnerBranchSearchModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PartnerBranchController extends Controller
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
        $searchModel = new PartnerBranchSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'partners'     => $this->getPartners(),
            'categories'   => $this->getCategories(),
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model'      => $this->findModel($id),
            'partners'   => $this->getPartners(),
            'categories' => $this->getCategories(),
        ]);
    }

    public function actionCreate()
    {
        $model = new PartnerBranchRepository();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model'      => $model,
            'partners'   => $this->getPartners(),
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
            'partners'   => $this->getPartners(),
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
        if (($model = PartnerBranchRepository::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getPartners()
    {
        $items = [];

        $partners = PartnerRepository::getAll();
        foreach ($partners as $partner) {
            $items[$partner->id] = $partner->name;
        }

        return $items;
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
