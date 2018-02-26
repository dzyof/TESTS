<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\QuestionOption;

/**
 * QuestionOptionSearch represents the model behind the search form of `backend\models\QuestionOption`.
 */
class QuestionOptionSearch extends QuestionOption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qestion_id', 'correct_option'], 'integer'],
            [['option_text'], 'safe'],
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
        $query = QuestionOption::find();

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
            'qestion_id' => $this->qestion_id,
            'correct_option' => $this->correct_option,
        ]);

        $query->andFilterWhere(['like', 'option_text', $this->option_text]);

        return $dataProvider;
    }
}
