<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Merchants;

/**
 * MerchantsSearch represents the model behind the search form of `app\models\Merchants`.
 */
class MerchantsSearch extends Merchants
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['denomination', 'tax_code', 'address', 'cap', 'city', 'country', 'wallet_address', 'derivedKey', 'privateKey'], 'safe'],
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
        $query = Merchants::find();

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
        ]);

        $query->andFilterWhere(['like', 'denomination', $this->denomination])
            ->andFilterWhere(['like', 'tax_code', $this->tax_code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'cap', $this->cap])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'wallet_address', $this->wallet_address])
            ->andFilterWhere(['like', 'derivedKey', $this->derivedKey])
            ->andFilterWhere(['like', 'privateKey', $this->privateKey]);

        return $dataProvider;
    }
}
