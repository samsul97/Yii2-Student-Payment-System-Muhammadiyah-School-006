<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpTeacher;

/**
 * MpTeacherSearch represents the model behind the search form of `backend\models\MpTeacher`.
 */
class MpTeacherSearch extends MpTeacher
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'nip_old', 'name', 'nik', 'pob', 'dob', 'doe', 'gender', 'married_status', 'national', 'education', 'address', 'province', 'city', 'district', 'sub_district', 'postcode', 'handphone', 'email', 'image'], 'safe'],
            [['id_teacher_position', 'id_teacher_payroll', 'id_teacher_status'], 'integer'],
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
        $query = MpTeacher::find();

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
            'dob' => $this->dob,
            'doe' => $this->doe,
            'id_teacher_position' => $this->id_teacher_position,
            'id_teacher_payroll' => $this->id_teacher_payroll,
            'id_teacher_status' => $this->id_teacher_status,
        ]);

        $query->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nip_old', $this->nip_old])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'pob', $this->pob])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'married_status', $this->married_status])
            ->andFilterWhere(['like', 'national', $this->national])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'sub_district', $this->sub_district])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
