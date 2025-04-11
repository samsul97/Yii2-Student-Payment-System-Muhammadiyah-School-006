<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpPayRemission;

/**
 * MpPayRemissionSearch represents the model behind the search form of `backend\models\MpPayRemission`.
 */
class MpPayRemissionSearch extends MpPayRemission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'value', 'id_user'], 'integer'],
            [['nis', 'type', 'reason', 'timestamp'], 'safe'],
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
        $query = MpPayRemission::find();

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
            'id_pay' => $this->id_pay,
            'value' => $this->value,
            'id_user' => $this->id_user,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
