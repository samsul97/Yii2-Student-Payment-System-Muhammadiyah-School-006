<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_pay_register".
 *
 * @property int $id
 * @property int $id_tahun
 * @property int $id_jenjang
 * @property int $id_pay
 * @property string $type CREDIT (+); CASH (+), DISCOUNT (-)
 * @property int $nominal
 * @property int $id_user
 * @property string $timestamp
 */
class MpPayRegister extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_pay_register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun', 'id_jenjang', 'id_pay', 'nominal', 'id_user'], 'integer'],
            [['id_pay'], 'required'],
            [['type'], 'string'],
            [['timestamp'], 'safe'],
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
            'id_jenjang' => 'Jenjang',
            'id_pay' => 'Pembayaran',
            'type' => 'Tipe',
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
