<?php

namespace common\models\search;

use common\models\repositories\ClientRepository;
use common\models\repositories\UserRepository;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\db\QueryBuilder;

/**
 * ClientSearchModel represents the model behind the search form of `common\models\db\Client`.
 */
class ClientSearchModel extends ClientRepository
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['lastname', 'firstname', 'middlename', 'phone', 'email'], 'safe'],
            [['cost', 'first_payment'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /* текущий пользователь */
        /* @var UserRepository $user */
        $user = Yii::$app->user->identity;

        $query = ClientRepository::find();

        // если текущий пользователь имеет роль аккаунт-менеджер
        // то смотрим каких партнеров он может видеть
        $authManager = Yii::$app->authManager;
        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        if (array_key_exists('account-manager', $roles)) {
            // партнеры, видимые текущему пользователю
            $partners_ids = explode(',', $user->partners_ids);

            // смотрим пользователей которые должны быть показаны данному аккаунт менеджеру
            $subQuery = new Query();
            $subQuery->select('id');
            $subQuery->from(ClientRepository::tableName());
            $subQuery->where(['partner_id' => $partners_ids]);
            $rows = $subQuery->all();

            $clientIds = [];
            foreach ($rows as $row) {
                $clientIds[] = $row['id'];
            }

            $query->where(['id' => $clientIds]);
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
            'id'            => $this->id,
            'category_id'   => $this->category_id,
            'cost'          => $this->cost,
            'first_payment' => $this->first_payment,
        ]);

        $query->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
