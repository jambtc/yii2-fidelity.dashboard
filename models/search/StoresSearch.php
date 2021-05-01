<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stores;

/**
 * StoresSearch represents the model behind the search form of `app\models\Stores`.
 */
class StoresSearch extends Stores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_merchant', 'id_blockchain'], 'integer'],
            [['denomination', 'bps_storeid', 'wallet_address', 'derivedKey', 'privateKey'], 'safe'],
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
        $query = Stores::find();

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
            'id_merchant' => $this->id_merchant,
            'id_blockchain' => $this->id_blockchain,
        ]);

        $query->andFilterWhere(['like', 'denomination', $this->denomination])
            ->andFilterWhere(['like', 'bps_storeid', $this->bps_storeid])
            ->andFilterWhere(['like', 'wallet_address', $this->wallet_address])
            ->andFilterWhere(['like', 'derivedKey', $this->derivedKey])
            ->andFilterWhere(['like', 'privateKey', $this->privateKey]);

        return $dataProvider;
    }
}
