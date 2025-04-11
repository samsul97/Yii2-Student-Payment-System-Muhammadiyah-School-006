<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpLevel;

/**
 * MpLevelSearch represents the model behind the search form of `backend\models\MpLevel`.
 */
class MpLevelSearch extends MpLevel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kelas'], 'integer'],
            [['kelas_c', 'type'], 'safe'],
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
        $query = MpLevel::find();

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
            'kelas' => $this->kelas,
        ]);

        $query->andFilterWhere(['like', 'kelas_c', $this->kelas_c])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
