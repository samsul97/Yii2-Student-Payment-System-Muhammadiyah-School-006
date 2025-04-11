<?php

namespace backend\controllers;

use Yii;
use yii\helpers\BaseStringHelper;
use backend\models\MpPayList;
use backend\models\MpStudent;
use backend\models\MpPayTransact;
use backend\models\MpPayTransactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MpPayTransactController implements the CRUD actions for MpPayTransact model.
 */
class MpPayTransactController extends Controller
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

    /**
     * Lists all MpPayTransact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MpPayTransactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrint()
    {
        return $this->render('print', [
            // 'model' => $this->findModel($id),
        ]);
    }

    /**
     * Lists all MpPayTransact models.
     * @return mixed
     */
    public function actionInput($year, $school, $level, $nis, $bulan, $tahun)
    {
        $model = new MpPayTransact();
        $studentDV = MpStudent::findOne(['nis' => $nis]);

        $searchModel = new MpPayTransactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_tahun' =>  $year, 'id_sekolah' =>  $school, 'id_jenjang' =>  $level, 'nis' =>  $nis]);
        $dataProvider->query->orderBy(['timestamp' => SORT_DESC]);
        $dataProvider->pagination->pageSize = 5;
        $payList = MpPayList::findAll(['id_tahun' =>  $year, 'id_sekolah' =>  $school, 'id_jenjang' =>  $level]);


        if ($model->load(Yii::$app->request->post())) {

            $id         = Yii::$app->request->post('id');
            $id_pay     = Yii::$app->request->post('id_pay');
            $id_paylist = Yii::$app->request->post('id_paylist');
            $id_tahun   = Yii::$app->request->post('id_tahun');
            $id_sekolah = Yii::$app->request->post('id_sekolah');
            $id_jenjang = Yii::$app->request->post('id_jenjang');
            $type       = Yii::$app->request->post('type');
            $nominal    = Yii::$app->request->post('nominal');
            $discount   = Yii::$app->request->post('discount');

            $code_digit  = 7;
            $code_prefix = 'M' . date('mY');
            $code_model  = MpPayTransact::find()->where(['LIKE', 'no', $code_prefix])->max('no');
            $code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
            $code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
            $code_format = $code_prefix . $code_seq;


            if ($id)
            {
                foreach ($id as $key => $val) {

                    if ($nominal[$key] != 0)
                    {
                        $modelz             = new MpPayTransact();
                        $modelz->no         = $code_format;
                        $modelz->bulan      = $bulan;
                        $modelz->tahun      = $tahun;
                        $modelz->nis        = $nis;
                        $modelz->datetime   = date('Y-m-d H:i:S');
                        $modelz->id_tahun   = $id_tahun[$key];
                        $modelz->id_sekolah = $id_sekolah[$key];
                        $modelz->id_jenjang = $id_jenjang[$key];
                        $modelz->id_jenjang = $id_jenjang[$key];
                        $modelz->id_pay     = $id_pay[$key];
                        $modelz->id_paylist = $id_paylist[$key]; // Convert to Nominal
                        $modelz->type       = $type[$key];
                        $modelz->name       = $model->name;
                        $modelz->nominal    = str_replace(',', '', $nominal[$key]);
                        $modelz->disc_type  = 'N'; // Convert to Nominal
                        $modelz->disc_value = $discount[$key];
                        $modelz->id_user    = Yii::$app->user->identity->id;
                        $modelz->save(false);
                    }
                }

                Yii::$app->getSession()->setFlash('mp_transact_input', [
                        'type'     => 'success',
                        'duration' => 5000,
                        'title'    => 'System Information',
                        'message'  => 'SUCCESS !',
                    ]
                );
            }
            else
            {
                Yii::$app->getSession()->setFlash('mp_transact_input', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'    => 'System Information',
                        'message'  => 'Tidak ada pembayaran !',
                    ]
                );
            }

            return $this->redirect(['input', 
                'year'   => $year, 
                'school' => $school, 
                'level'  => $level, 
                'nis'    => $nis, 
                'bulan'  => $bulan, 
                'tahun'  => $tahun
            ]);

        }

        return $this->render('input', [
            'model' => $model,
            'studentDV' => $studentDV,
            'payList' => $payList,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MpPayTransact model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MpPayTransact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MpPayTransact();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data Berhasil ditambah');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MpPayTransact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MpPayTransact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MpPayTransact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MpPayTransact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MpPayTransact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function penyebut($nilai) 
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = self::penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = self::penyebut($nilai/10)." puluh". self::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::penyebut($nilai/100) . " ratus" . self::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::penyebut($nilai/1000) . " ribu" . self::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::penyebut($nilai/1000000) . " juta" . self::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::penyebut($nilai/1000000000) . " milyar" . self::penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::penyebut($nilai/1000000000000) . " trilyun" . self::penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    public static function terbilang($nilai) 
    {
        if($nilai<0) {
            $hasil = "minus ". trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }           
        return $hasil;
    }
}
