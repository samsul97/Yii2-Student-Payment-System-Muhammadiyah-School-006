<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "mp_teacher_position".
 *
 * @property int $id
 * @property string $name
 */
class MpTeacherPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_teacher_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['id'], 'unique'],
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
        ];
    }

    public static function getCount()
    {
        return static::find()->count();
    }
    
    public function getManyTeacher()
    {
        return $this->hasMany(MpTeacher::class, ['id_teacher_position' => 'id']);
    }

    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $position) {
            $data[] = [StringHelper::truncate($position->name, 20), (int) $position->getManyTeacher()->count()];
        }
        return $data;
    }
}
