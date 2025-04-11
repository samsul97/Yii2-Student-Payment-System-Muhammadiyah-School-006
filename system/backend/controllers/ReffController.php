<?php

namespace backend\controllers;


use Yii;
use backend\models\MpGrade;
use backend\models\MpStudent;
use backend\models\MpLocation;
use backend\models\MpYear;
use backend\models\MpClass;
use backend\models\MpLevel;
use backend\models\MpSchool;
use backend\models\MpPay;
use backend\models\MpPayTransact;
use backend\models\MpPayRemission;
use backend\models\MpPayList;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ReffController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                'class' => \common\components\AccessRule::className()],
                'rules' => \common\components\AccessRule::getRules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        /* Application Log */
        Yii::$app->application->log($action->id);
        if (!parent::beforeAction($action)) {
            return false;
        }
        // Another code here
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        // Code here
        return $result;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLocation($type, $name)
    {
	    $province = "<option value=''>-</option>";
	    $city     = "<option value=''>-</option>";
	    $district = "<option value=''>-</option>";

    	if ($type === 'P')
    	{
	    	$model = MpLocation::find()->where(['province_name' => $name])->groupBy(['city_name'])->asArray()->all();
	    	
	    	foreach ($model as $key => $value) 
	    	{
	    		$city.= '<option value="' . $value['city_name'] . '">' . $value['city_name'] . '</option>';
	    	}
    	}
    	else if ($type === 'C')
    	{
	    	$model = MpLocation::find()->where(['city_name' => $name])->groupBy(['district_name'])->asArray()->all();
	    	
	    	foreach ($model as $key => $value) 
	    	{
	    		$district.= '<option value="' . $value['district_name'] . '">' . $value['district_name'] . '</option>';
	    	}

    	}
    	else if ($type === 'D')
    	{

    	}

    	return json_encode(array(
    			'province' => $province,
    			'city' => $city,
    			'district' => $district,
    		)
    	);
    }

    public function actionSchool($id)
    {
        $school = MpSchool::findOne(['id' => $id]); 

        $jenjang = "<option value=''>-</option>";

        $model = MpLevel::find()->where(['type' => $school['type']])->asArray()->all();

        foreach ($model as $key => $value) 
        {
            $jenjang.= '<option value="' . $value['kelas'] . '">' . $value['type'] . ' - ' .  $value['kelas_c'] . '</option>';
        }

        return json_encode(array(
                'jenjang' => $jenjang,
            )
        );
    }

    public function actionPay($id)
    {
        $pay = MpPay::findOne(['id' => $id]);

        return json_encode(array(
                'type' => $pay['type'],
            )
        );
    }

    public function actionStudents($q = null, $id = null) 
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'nis_old' => '', 'tahun' => '', 'sekolah' => '', 'jenjang' => '', 'text' => '']];
        
        if (!is_null($q)) 
        {
            $data = Yii::$app->db->createCommand('
                    SELECT 
                        nis as id, 
                        nis_old as nis_old, 
                        full_name as nama, 
                        id_tahun as tahun,
                        id_sekolah as sekolah,
                        id_jenjang as jenjang,
                        id_ruang as ruangan,
                        concat(
                            nis,
                            "/",
                            nis_old,
                            " - ",
                            full_name
                        ) AS text
                    FROM 
                        mp_student 
                    WHERE 
                        full_name LIKE :dn
                    OR 
                        nis LIKE :dn
                    OR 
                        nis_old LIKE :dn
                    LIMIT 20')
                    ->bindValue(':dn',  '%' . $q . '%')
                    ->queryAll();

            $out['results'] = array_values($data);
        }
        elseif ($id > 0) 
        {
            $out['results'] = [
                'id'      => $id, 
                'nis_old' => MpStudent::find($id)->nis_old, 
                'nama'    => MpStudent::find($id)->full_name, 
                'tahun'   => MpStudent::find($id)->id_tahun, 
                'sekolah' => MpStudent::find($id)->id_sekolah, 
                'jenjang' => MpStudent::find($id)->id_jenjang, 
                'ruangan' => MpStudent::find($id)->id_ruangan, 
                'text'    => MpStudent::find($id)->full_name
            ];
        }

        return $out;
    }

    public function actionGradeSearch($school, $level, $class = null, $year = null) 
    {
        $message = [
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ];

        if ($class && $year)
        {
            $model = MpStudent::find()->where(['id_sekolah' => $school, 'id_jenjang' => $level, 'id_ruang' => $class, 'id_tahun' => $year])->asArray()->all();
        }
        else if ($class)
        {
            $model = MpStudent::find()->where(['id_sekolah' => $school, 'id_jenjang' => $level, 'id_ruang' => $class])->asArray()->all();
        }
        else if ($year)
        {
            $model = MpStudent::find()->where(['id_sekolah' => $school, 'id_jenjang' => $level, 'id_tahun' => $year])->asArray()->all();
        }
        else
        {
            $model = MpStudent::find()->where(['id_sekolah' => $school, 'id_jenjang' => $level])->asArray()->all();
        }

        if ($model)
        {

            $student = [];

            foreach ($model as $key => $value) {
                
                $student[$key]['nis'] = $value['nis'];
                $student[$key]['full_name'] = $value['full_name'];
                $student[$key]['tahun'] = MpYear::findOne($value['id_tahun'])['nama'];
                $student[$key]['sekolah'] = MpSchool::findOne($value['id_sekolah'])['name'];
                $student[$key]['jenjang'] = MpLevel::findOne($value['id_jenjang'])['type'] . ' - ' . MpLevel::findOne($value['id_jenjang'])['kelas_c'];
                $student[$key]['ruang'] = MpClass::findOne($value['id_ruang'])['name'];
            }

            $message = [
                'status' => true,
                'message' => 'Data ' . count($model) . ' siswa',
                'count' => count($model),
                'student' => $student,
            ];
        }

        return json_encode($message);
    }

    public function actionGradeUpgrade() 
    {
        $nis    = Yii::$app->request->post('nis');
        $year   = Yii::$app->request->post('year');
        $school = Yii::$app->request->post('school');
        $level  = Yii::$app->request->post('level');
        $class  = Yii::$app->request->post('class');
        $status = Yii::$app->request->post('status');
        $date   = Yii::$app->request->post('date');

        $params = array();
        parse_str($nis, $params);

        foreach ($params['nis'] as $key => $value) 
        {
            /* Save Student */
            $student             = MpStudent::find()->where(['nis' => $value])->one();
            $student->id_tahun   = $year;
            $student->id_sekolah = $school;
            $student->id_jenjang = $level;
            $student->id_ruang   = $class;
            $student->save(false);

            /* Save Grade */
            $grade_           = MpGrade::find()->where(['nis' => $value, 'id_school' => $school, 'id_level' => $level, 'id_class' => $class])->one();
            $grade            = $grade_ ? $grade_ : new MpGrade();
            $grade->nis       = $value;
            $grade->id_school = $school;
            $grade->id_level  = $level;
            $grade->id_class  = $class;
            $grade->id_year   = $year;
            $grade->status    = $status;
            $grade->date      = $date;
            $grade->id_user   = Yii::$app->user->identity->id;
            $grade->save(false);
        }

        $message = [
            'status' => true,
            'message' => 'Data was upgrade'
        ];

        return json_encode($message);
    }

    public function actionGradeCreate($nis, $year, $school, $level, $class, $status, $date) 
    {
        $message = [
            'status' => false,
            'message' => 'The request not accepted'
        ];

        $model            = MpGrade::findOne(['nis' => $nis, 'id_year' => $year, 'id_school' => $school, 'id_level' => $level, 'status' => $status, 'date' => $date]) ?: new MpGrade();
        $model->nis       = $nis;
        $model->id_year   = $year;
        $model->id_school = $school;
        $model->id_level  = $level;
        $model->id_class  = $class;
        $model->status    = $status;
        $model->date      = $date;
        $model->id_user   = Yii::$app->user->identity->id;
        
        if ($model->save(false))
        {
            $model_student = MpStudent::findOne(['nis' => $model->nis]);
            $model_student->id_tahun   = $model->id_year;
            $model_student->id_sekolah = $model->id_school;
            $model_student->id_jenjang = $model->id_level;
            $model_student->id_ruang   = $model->id_class;
            $model_student->save(false);

            $message['status'] = true;
            $message['message'] = 'Data saved';
            $message['id'] = $model->id;
            $message['year'] = MpYear::findOne($model->id_year)->toArray();
            $message['school'] = MpSchool::findOne($model->id_school)->toArray();
            $message['level'] = MpLevel::findOne($model->id_level)->toArray();
            $message['class'] = MpClass::findOne($model->id_class)->toArray();
        }
        else
        {
            $message['message'] = 'Data not saved';
        }

        return json_encode($message);
    }

    public function actionGradeDelete($id) 
    {
        $message = [
            'status' => false,
            'message' => 'The request not accepted'
        ];

        $model = MpGrade::findOne(['id' => $id]);
        
        if ($model->delete())
        {
            $message['status'] = true;
            $message['message'] = 'Data Deleted';
        }
        else
        {
            $message['message'] = 'Data not delete';
        }

        return json_encode($message);
    }

    public function actionRemissionSearch($school, $level, $year, $tahun, $bulan) 
    {
        $message = [
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ];

        $model = MpStudent::find()->where(['id_sekolah' => $school, 'id_jenjang' => $level])->asArray()->all();

        if ($model)
        {

            $student = [];

            foreach ($model as $key => $value) {
                
                $student[$key]['nis']       = $value['nis'];
                $student[$key]['full_name'] = $value['full_name'];
                $student[$key]['sekolah']   = MpSchool::findOne($value['id_sekolah'])['name'];
                $student[$key]['jenjang']   = MpLevel::findOne($value['id_jenjang'])['type'] . ' - ' . MpLevel::findOne($value['id_jenjang'])['kelas_c'];
                
                $invoice   = MpPayList::find()->where(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level])->sum('nominal');   
                // $remission = MpPayTransact::find()->where(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun, 'nis' => $value['nis']])->sum('disc_value');
                $transact  = MpPayTransact::find()->where(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun, 'nis' => $value['nis']])->sum('nominal');
                
                $student[$key]['invoice']   = $invoice ?: 0;

                $remission = MpPayRemission::find()->where(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun, 'nis' => $value['nis']])->asArray()->all();
                $diskon = 0;

                foreach ($remission as $keyX => $valuex) {

                    if ($valuex['type'] == 'P')
                    {
                        $tagihanx = MpPayList::find()->where(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'id_pay' => $valuex['id_pay']])->asArray()->one();
                        $diskon = $diskon + ($tagihanx['nominal'] * ($valuex['value'] / 100));

                    }
                    else if ($valuex['type'] == 'N')
                    {
                        $diskon = $diskon + $valuex['value'];
                    }
                }

                $student[$key]['remission'] = $diskon ?: 0;
                $student[$key]['transact']  = $transact ?: 0;
                $student[$key]['credit']    = ($invoice - $diskon) - $transact;
            }

            $message = [
                'status' => true,
                'message' => 'Data ' . count($model) . ' siswa',
                'count' => count($model),
                'student' => $student,
            ];
        }

        return json_encode($message);
    }
}
