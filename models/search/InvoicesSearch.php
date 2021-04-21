<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoices;

/**
 * InvoicesSearch represents the model behind the search form of `app\models\Invoices`.
 */
class InvoicesSearch extends Invoices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_pos', 'invoice_timestamp', 'expiration_timestamp'], 'integer'],
            [['status', 'from_address', 'to_address', 'txhash', 'message'], 'safe'],
            [['price', 'received'], 'number'],
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
        $query = Invoices::find();

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
            'id_user' => $this->id_user,
            'price' => $this->price,
            'received' => $this->received,
            'id_pos' => $this->id_pos,
            'invoice_timestamp' => $this->invoice_timestamp,
            'expiration_timestamp' => $this->expiration_timestamp,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'from_address', $this->from_address])
            ->andFilterWhere(['like', 'to_address', $this->to_address])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'txhash', $this->txhash]);

        return $dataProvider;
    }
}
