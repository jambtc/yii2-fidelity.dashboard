<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReRequests;

/**
 * ReRequestsSearch represents the model behind the search form of `app\models\ReRequests`.
 */
class ReRequestsSearch extends ReRequests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'timestamp', 'id_merchant', 'id_store', 'sent'], 'integer'],
            [['payload'], 'safe'],
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
        $query = ReRequests::find();

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
            'timestamp' => $this->timestamp,
            'id_merchant' => $this->id_merchant,
            'id_store' => $this->id_store,
            'sent' => $this->sent,
        ]);

        $query->andFilterWhere(['like', 'payload', $this->payload]);

        return $dataProvider;
    }
}
