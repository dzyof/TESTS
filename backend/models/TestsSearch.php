<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tests;

/**
 * TestsSearch represents the model behind the search form of `backend\models\Tests`.
 */
class TestsSearch extends Tests
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_passing', 'number_passing', 'avarage_score'], 'integer'],
            [['name_tests'], 'safe'],
            [['created_at'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Tests::find();

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
            'time_passing' => $this->time_passing,
            'number_passing' => $this->number_passing,
            'avarage_score' => $this->avarage_score,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name_tests', $this->name_tests]);

        return $dataProvider;
    }
}