<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_grade".
 *
 * @property int $id
 * @property string $nis
 * @property int $id_year Tahun Ajaran
 * @property int $id_school
 * @property int $id_level
 * @property int $id_class
 * @property string $status
 * @property string $date
 * @property int $id_user
 * @property string $timestamp
 */
class MpGrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_year', 'id_school', 'id_level', 'id_class', 'id_user'], 'integer'],
            [['status'], 'string'],
            [['date'], 'required'],
            [['date', 'timestamp'], 'safe'],
            [['nis'], 'string', 'max' => 50],
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
            'id_year' => 'Tahun Ajaran',
            'id_school' => 'Sekolah',
            'id_level' => 'Jenjang',
            'id_class' => 'Kelas',
            'status' => 'Status',
            'date' => 'Tanggal',
            'id_user' => 'User',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getmp_student()
    {
        return $this->hasOne(MpStudent::className(), ['nis' => 'nis']);
    }
}
