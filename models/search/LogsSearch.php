<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Logs;

/**
 * LogsSearch represents the model behind the search form of `app\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'timestamp', 'id_user', 'die'], 'integer'],
            [['remote_address', 'browser', 'app', 'controller', 'action', 'description'], 'safe'],
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
        $query = Logs::find();

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
            'id_user' => $this->id_user,
            'die' => $this->die,
        ]);

        $query->andFilterWhere(['like', 'remote_address', $this->remote_address])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'app', $this->app])
            ->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
