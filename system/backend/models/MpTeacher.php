<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_teacher".
 *
 * @property string $nip Nomor Induk Pegawai
 * @property string $nip_old
 * @property string $name
 * @property string $nik
 * @property string $pob
 * @property string $dob
 * @property string $doe
 * @property string $gender
 * @property string $married_status
 * @property string $national
 * @property string $education
 * @property int $id_teacher_position
 * @property int $id_teacher_payroll
 * @property int $id_teacher_status
 * @property string $address
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $sub_district
 * @property string $postcode
 * @property string|null $handphone
 * @property string|null $email
 * @property string|null $image
 */
class MpTeacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'nip_old', 'name', 'nik', 'pob', 'dob', 'doe', 'gender', 'married_status', 'national', 'education', 'id_teacher_position', 'id_teacher_payroll', 'id_teacher_status', 'address', 'province', 'city', 'district', 'sub_district', 'postcode'], 'required'],
            [['dob', 'doe'], 'safe'],
            [['gender'], 'string'],
            [['id_teacher_position', 'id_teacher_payroll', 'id_teacher_status'], 'integer'],
            [['nip', 'nip_old', 'name', 'nik', 'pob', 'married_status', 'national', 'education', 'province', 'city', 'district', 'sub_district', 'handphone', 'email'], 'string', 'max' => 50],
            [['address', 'image'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 5],
            [['nip'], 'unique'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'Nip',
            'nip_old' => 'Nip Lama',
            'name' => 'Nama',
            'nik' => 'Nik',
            'pob' => 'Tempat Lahir',
            'dob' => 'Tanggal Lahir',
            'doe' => 'Tanggal Masuk',
            'gender' => 'Jenis Kelamin',
            'married_status' => 'Status kawin',
            'national' => 'Kewarganegaraan',
            'education' => 'Pendidikan',
            'id_teacher_position' => 'Jabatan',
            'id_teacher_payroll' => 'Gaji',
            'id_teacher_status' => 'Status',
            'address' => 'Alamat',
            'province' => 'Provinsi',
            'city' => 'Kota',
            'district' => 'Kecamatan',
            'sub_district' => 'Kelurahan',
            'postcode' => 'Kodepos',
            'handphone' => 'Handphone',
            'email' => 'Email',
            'image' => 'Foto',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }

    public static function findAllPosition()
    {
        return static::find()->all();
    }
}
