<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_pay_transact".
 *
 * @property int $id
 * @property string $no
 * @property string $bulan
 * @property string $tahun
 * @property string $nis
 * @property string $datetime
 * @property int $id_tahun Filter
 * @property int $id_sekolah
 * @property int $id_jenjang Filter
 * @property int $id_pay Filter
 * @property int $id_paylist
 * @property string $disc_type
 * @property int $disc_value
 * @property string $type CASH; CREDIT
 * @property string $name
 * @property int $nominal
 * @property int $id_user
 * @property string $timestamp
 */
class MpPayTransact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_pay_transact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'bulan', 'tahun', 'nis', 'datetime', 'id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'name'], 'required'],
            [['datetime', 'timestamp'], 'safe'],
            [['id_tahun', 'id_sekolah', 'id_jenjang', 'id_pay', 'id_paylist', 'disc_value', 'nominal', 'id_user'], 'integer'],
            [['disc_type', 'type'], 'string'],
            [['no', 'nis', 'name'], 'string', 'max' => 50],
            [['bulan'], 'string', 'max' => 2],
            [['tahun'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'No',
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',
            'nis' => 'Nis',
            'datetime' => 'Waktu',
            'id_tahun' => 'Tahun',
            'id_sekolah' => 'Sekolah',
            'id_jenjang' => 'Jenjang',
            'id_pay' => 'Pembayaran',
            'id_paylist' => 'Tagihan',
            'disc_type' => 'Tipe Diskon',
            'disc_value' => 'Diskon',
            'type' => 'Tipe',
            'name' => 'Nama',
            'nominal' => 'Dibayar',
            'id_user' => 'User',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
