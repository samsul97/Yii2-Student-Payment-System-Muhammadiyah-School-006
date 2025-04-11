<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_year".
 *
 * @property int $id
 * @property string $semester
 * @property string $nama
 * @property string $awal
 * @property string $akhir
 */
class MpYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['semester'], 'string'],
            [['nama', 'awal', 'akhir'], 'required'],
            [['awal', 'akhir'], 'safe'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semester' => 'Semester',
            'nama' => 'Nama',
            'awal' => 'Awal',
            'akhir' => 'Akhir',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
