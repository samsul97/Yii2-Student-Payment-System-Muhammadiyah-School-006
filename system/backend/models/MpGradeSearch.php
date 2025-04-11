<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpGrade;

/**
 * MpGradeSearch represents the model behind the search form of `backend\models\MpGrade`.
 */
class MpGradeSearch extends MpGrade
{
    public $full_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_year', 'id_school', 'id_level', 'id_class', 'id_user'], 'integer'],
            [['full_name', 'nis', 'status', 'date', 'timestamp'], 'safe'],
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
        $query = MpGrade::find();

        // add conditions that should always apply here
        $query->joinWith([
            'mp_student'
        ]);

        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_year' => SORT_DESC,
                ],
            ]
        ]);*/

        $dataProvider->sort->attributes['mp_student.full_name'] = [
            'asc' => ['mp_student.full_name' => SORT_ASC],
            'desc' => ['mp_student.full_name' => SORT_DESC],
        ];

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
            'id_year' => $this->id_year,
            'id_school' => $this->id_school,
            'id_level' => $this->id_level,
            'id_class' => $this->id_class,
            'date' => $this->date,
            'id_user' => $this->id_user,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'mp_student.full_name', $this->full_name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
