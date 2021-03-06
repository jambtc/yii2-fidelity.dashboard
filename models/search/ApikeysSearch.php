<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Apikeys;

/**
 * ApikeysSearch represents the model behind the search form of `app\models\Apikeys`.
 */
class ApikeysSearch extends Apikeys
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_merchant', 'id_store'], 'integer'],
            [['denomination', 'public_key', 'secret_key'], 'safe'],
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
        $query = Apikeys::find();

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
            'id_store' => $this->id_store,
        ]);

        $query->andFilterWhere(['like', 'denomination', $this->denomination])
            ->andFilterWhere(['like', 'public_key', $this->public_key])
            ->andFilterWhere(['like', 'secret_key', $this->secret_key]);

        return $dataProvider;
    }
}
