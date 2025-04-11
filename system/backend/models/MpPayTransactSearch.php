<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MpPayTransact;

/**
 * MpPayTransactSearch represents the model behind the search form of `backend\models\MpPayTransact`.
 */
class MpPayTransactSearch extends MpPayTransact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'id_paylist', 'disc_value', 'nominal', 'id_user'], 'integer'],
            [['no', 'bulan', 'tahun', 'nis', 'datetime', 'disc_type', 'type', 'name', 'timestamp'], 'safe'],
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
        $query = MpPayTransact::find();

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
            'datetime' => $this->datetime,
            'id_tahun' => $this->id_tahun,
            'id_sekolah' => $this->id_sekolah,
            'id_jenjang' => $this->id_jenjang,
            'id_pay' => $this->id_pay,
            'id_paylist' => $this->id_paylist,
            'disc_value' => $this->disc_value,
            'nominal' => $this->nominal,
            'id_user' => $this->id_user,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'bulan', $this->bulan])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'disc_type', $this->disc_type])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}