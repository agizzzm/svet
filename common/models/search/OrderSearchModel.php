<?php

namespace common\models\search;

use common\models\repositories\OrderRepository;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Order;

class OrderSearchModel extends Order
{
    public function rules()
    {
        return [
            [['id', 'client_id'], 'integer'],
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
        $query = OrderRepository::find();

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
            'id'        => $this->id,
            'client_id' => $this->client_id,
            'cost'      => $this->cost,
        ]);

        return $dataProvider;
    }
}
