<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mp_student".
 *
 * @property int $id
 * @property string $nis Nomor Induk Siswa
 * @property string $nis_old
 * @property string $status
 * @property int $id_tahun
 * @property int $id_sekolah
 * @property int $id_jenjang
 * @property int $id_ruang
 * @property string $full_name
 * @property string $nick_name
 * @property string $gender
 * @property string $pob
 * @property string|null $dob
 * @property string $nation
 * @property string $religion
 * @property string|null $orphan
 * @property string $address
 * @property string $address_type
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $sub_district
 * @property string $postcode
 * @property string|null $live
 * @property string|null $image
 * @property string|null $handphone
 * @property string|null $school_origin
 * @property string|null $other_information
 */
class MpStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mp_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nis', 'nis_old', 'full_name'], 'required'],
            [['status', 'gender', 'nation', 'religion', 'orphan', 'address_type'], 'string'],
            [['id_tahun', 'id_sekolah', 'id_jenjang', 'id_ruang'], 'integer'],
            [['dob', 'nick_name', 'pob', 'religion', 'address', 'address_type', 'province', 'city', 'district', 'sub_district', 'postcode'], 'safe'],
            [['nis', 'nis_old', 'full_name', 'nick_name', 'pob', 'province', 'city', 'district', 'sub_district', 'live', 'image', 'handphone', 'school_origin', 'other_information'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 250],
            [['postcode'], 'string', 'max' => 5],
            [['nis'], 'unique'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
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
            'nis_old' => 'Nis Lama',
            'status' => 'Status',
            'id_tahun' => 'Tahun Ajaran',
            'id_sekolah' => 'Sekolah',
            'id_jenjang' => 'Jenjang',
            'id_ruang' => 'Kelas',
            'full_name' => 'Nama Lengkap',
            'nick_name' => 'Nama Panggilan',
            'gender' => 'Jenis Kelamin',
            'pob' => 'Tempat Lahir',
            'dob' => 'Tanggal Lahir',
            'nation' => 'Kenegaraan',
            'religion' => 'Agama',
            'orphan' => 'Yatim',
            'address' => 'Alamat',
            'address_type' => 'Tipe Alamat',
            'province' => 'Provinsi',
            'city' => 'Kota',
            'district' => 'Kecamatan',
            'sub_district' => 'Kelurahan',
            'postcode' => 'Kodepos',
            'live' => 'Live',
            'image' => 'Foto',
            'handphone' => 'Handphone',
            'school_origin' => 'Asal Sekolah',
            'other_information' => 'Informasi Lainnya',
        ];
    }

    public function getCount()
    {
        return static::find()->count();
    }
}
