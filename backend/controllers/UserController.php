<?php

namespace backend\controllers;

use common\models\repositories\PartnerRepository;
use common\models\repositories\UserRepository;
use Yii;
use common\models\User;
use common\models\search\UserSearchModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserController extends Controller
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
        $searchModel = new UserSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'partners'     => $this->getPartners(),
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new UserRepository();

        $post = Yii::$app->request->post('UserRepository');
        $partners = Yii::$app->request->post('partners');

        if (!empty($post)) {

            $model->generateAuthKey();
            $model->setPassword($post['password_hash']);
            $model->status = UserRepository::STATUS_ACTIVE;
            $model->username = $post['email'];
            $model->email = $post['email'];
            $model->partners_ids = $partners ? implode(',', array_keys($partners)) : '';

            if ($model->save()) {
                // ставим роли
                $authManager = \Yii::$app->authManager;
                $accountManager = $authManager->getRole('account-manager');

                $roles = \Yii::$app->authManager->getRolesByUser($model->id);
                if (!array_key_exists('account-manager', $roles)) {
                    $authManager->assign($accountManager, $model->id);
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model'    => $model,
            'partners' => $this->getPartners(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post('UserRepository');
        $partners = Yii::$app->request->post('partners');

        if (!empty($post)) {

            if (!empty($post['password_new'])) {
                $model->generateAuthKey();
                $model->setPassword($post['password_new']);
            }

            $model->partners_ids = $partners ? implode(',', array_keys($partners)) : '';

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model'    => $model,
            'partners' => $this->getPartners(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = UserRepository::findOne($id)) !== null) {
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
}
