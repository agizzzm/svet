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
use linslin\yii2\curl;

class PartnerBranchController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'map'],
                        'allow'   => true,
                        'roles'   => ['admin', 'account-manager'],
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

    public function actionMap()
    {
        $searchModel = new PartnerBranchSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $yandexApiKey = Yii::$app->params['yandexApiKey'];
        $url = 'https://geocode-maps.yandex.ru/1.x/?format=json&results=1&apikey=' . $yandexApiKey . '&geocode=';

        $partnersBranches = PartnerBranchRepository::getAll();
        foreach ($partnersBranches as $item) {
            if (!empty($item->address) && empty($item->coor)) {
                $url = $url . urlencode($item->address);
                $response = $this->_request($url);
                if ($response) {
                    if (isset($response->response->GeoObjectCollection) &&
                        isset($response->response->GeoObjectCollection->featureMember[0]) &&
                        isset($response->response->GeoObjectCollection->featureMember[0]->GeoObject) &&
                        isset($response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point)
                    ) {
                        $coor = (string)$response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
                        $coor = explode(" ", $coor);
                        $item->coor = implode(" ", [$coor[1], $coor[0]]);
                        $item->save();
                    }
                }
            }
        }

        return $this->render('map', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'partners'     => $this->getPartners(),
            'categories'   => $this->getCategories(),
            'yandexApiKey' => $yandexApiKey,
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

    protected function _request($url)
    {
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        return json_decode($result);
    }
}
