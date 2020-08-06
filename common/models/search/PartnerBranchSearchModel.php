<?php

namespace common\models\search;

use common\models\repositories\PartnerBranchRepository;
use common\models\repositories\UserRepository;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\PartnerBranch;

class PartnerBranchSearchModel extends PartnerBranch
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'partner_id'], 'integer'],
            [['address', 'category_id'], 'safe'],
            [['cost'], 'number'],
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

        $query = PartnerBranchRepository::find();

        // если текущий пользователь имеет роль аккаунт-менеджер
        // то смотрим каких партнеров он может видеть
        $authManager = Yii::$app->authManager;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        if (array_key_exists('account-manager', $roles)) {
            $query->where(['id' => explode(',', $user->partners_ids)]);
        }

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
            'id'         => $this->id,
            'partner_id' => $this->partner_id,
            'cost'       => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'category_id', $this->category_id]);

        return $dataProvider;
    }
}
