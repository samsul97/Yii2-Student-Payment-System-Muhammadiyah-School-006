<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_pay".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property int $type_pay Bulanan, Tahunan, Tunggal
 */
class MpPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type'], 'string'],
            [['type_pay'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'type' => 'Jenis',
            'type_pay' => 'Jenis Pembayaran',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
