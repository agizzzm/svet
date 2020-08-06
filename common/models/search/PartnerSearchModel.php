<?php

namespace common\models\search;

use common\models\repositories\UserRepository;
use common\models\repositories\PartnerRepository;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Partner;

class PartnerSearchModel extends Partner
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'contact', 'contact_phone', 'email', 'region', 'city'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        /* @var UserRepository $user */
        $user = Yii::$app->user->identity;

        $query = PartnerRepository::find();

        // если текущий пользователь имеет роль аккаунт-менеджер
        // то смотрим каких партнеров он может видеть
        $authManager = Yii::$app->authManager;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        if (array_key_exists('account-manager', $roles)) {
            $query->where(['id' => explode(',', $user->partners_ids)]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
