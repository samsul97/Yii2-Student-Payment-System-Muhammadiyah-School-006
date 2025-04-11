<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpStudent;

/**
 * MpStudentSearch represents the model behind the search form of `backend\models\MpStudent`.
 */
class MpStudentSearch extends MpStudent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun', 'id_sekolah', 'id_jenjang', 'id_ruang'], 'integer'],
            [['nis', 'nis_old', 'status', 'full_name', 'nick_name', 'gender', 'pob', 'dob', 'nation', 'religion', 'orphan', 'address', 'address_type', 'province', 'city', 'district', 'sub_district', 'postcode', 'live', 'image', 'handphone', 'school_origin', 'other_information'], 'safe'],
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
        $query = MpStudent::find();

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
            'id_tahun' => $this->id_tahun,
            'id_sekolah' => $this->id_sekolah,
            'id_jenjang' => $this->id_jenjang,
            'id_ruang' => $this->id_ruang,
            'dob' => $this->dob,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'nis_old', $this->nis_old])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'pob', $this->pob])
            ->andFilterWhere(['like', 'nation', $this->nation])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'orphan', $this->orphan])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_type', $this->address_type])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'sub_district', $this->sub_district])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'live', $this->live])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'school_origin', $this->school_origin])
            ->andFilterWhere(['like', 'other_information', $this->other_information]);

        return $dataProvider;
    }
}
