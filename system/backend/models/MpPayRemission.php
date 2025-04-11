<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_pay_remission".
 *
 * @property int $id
 * @property string|null $nis
 * @property int $id_tahun
 * @property int $id_sekolah
 * @property int $id_jenjang
 * @property int $id_pay
 * @property string $type P: Percent; N: Nominal
 * @property int $value
 * @property string|null $reason
 * @property int $id_user
 * @property string $timestamp
 */
class MpPayRemission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_pay_remission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay'], 'required'],
            [['id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'value', 'id_user'], 'integer'],
            [['type'], 'string'],
            [['timestamp'], 'safe'],
            [['nis'], 'string', 'max' => 50],
            [['reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nis' => 'Nis',
            'id_tahun' => 'Tahun',
            'id_sekolah' => 'Sekolah',
            'id_jenjang' => 'Jenjang',
            'id_pay' => 'Pembayaran',
            'type' => 'Tipe Diskon',
            'value' => 'Nilai',
            'reason' => 'Alasan',
            'id_user' => 'Userstamp',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
