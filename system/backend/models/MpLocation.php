<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_location".
 *
 * @property int $id
 * @property string $province_name
 * @property string $city_name
 * @property string $district_name
 */
class MpLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_name', 'city_name', 'district_name'], 'required'],
            [['province_name', 'city_name', 'district_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_name' => 'Provinsi',
            'city_name' => 'Kota',
            'district_name' => 'Kecamatan',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
