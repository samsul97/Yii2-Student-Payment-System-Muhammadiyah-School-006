<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_level".
 *
 * @property int $kelas
 * @property string $kelas_c
 * @property string $type SD,SMP,SMA/SMK
 */
class MpLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kelas_c', 'type'], 'required'],
            [['kelas_c'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kelas' => 'Kelas',
            'kelas_c' => 'Karakter',
            'type' => 'Type',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
