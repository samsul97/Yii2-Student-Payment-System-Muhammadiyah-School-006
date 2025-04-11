<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_school".
 *
 * @property int $id
 * @property string $type
 * @property string $name
 */
class MpSchool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type'], 'string', 'max' => 7],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Jenis',
            'name' => 'Nama',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
