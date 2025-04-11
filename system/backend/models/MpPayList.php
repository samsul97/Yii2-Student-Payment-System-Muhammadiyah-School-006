<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_pay_list".
 *
 * @property int $id
 * @property int $id_tahun
 * @property int $id_sekolah
 * @property int $id_jenjang
 * @property int $id_pay
 * @property string $type CREDIT (+); CASH (+), DISCOUNT (-)
 * @property int $nominal
 * @property int $id_user
 * @property string $timestamp
 */
class MpPayList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_pay_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'id_user'], 'integer'],
            [['id_pay', 'nominal', 'type'], 'required'],
            [['type'], 'string'],
            [['timestamp'], 'safe'],
            [['id_pay'], 'compare', 'compareValue' => 0, 'operator' => '!=', 'type' => 'string', 'message' => '{attribute} harus ditentukan'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tahun' => 'Tahun Ajaran',
            'id_sekolah' => 'Sekolah',
            'id_jenjang' => 'Jenjang',
            'id_pay' => 'Pembayaran',
            'type' => 'Jenis',
            'nominal' => 'Nominal',
            'id_user' => 'User',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
