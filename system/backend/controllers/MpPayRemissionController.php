<?php

namespace backend\controllers;

use Yii;
use backend\models\MpPayRemission;
use backend\models\MpPayRemissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MpPayRemissionController implements the CRUD actions for MpPayRemission model.
 */
class MpPayRemissionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MpPayRemission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MpPayRemissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MpPayRemission models.
     * @return mixed
     */
    public function actionListing($nis, $year, $school, $level, $bulan, $tahun)
    {  
        $model  = new MpPayRemission;
        $model_ = MpPayRemission::findOne(['nis' => $nis]) ?: ['nis' => $nis, 'id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun];
        $searchModel = new MpPayRemissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['nis' => $nis, 'id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun]);
        $message = '';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if (Yii::$app->request->isAjax) 
            {
                $model->bulan    = $bulan;
                $model->tahun    = $tahun;
                $model->datetime = date('Y-m-d H:i:s');
                $model->id_user  = Yii::$app->user->identity->id;
                $model->save();

                $searchModel  = new MpPayRemissionSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['nis' => $nis, 'id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level, 'bulan' => $bulan, 'tahun' => $tahun]);
                $dataProvider->pagination->pageSize = 5;

                return $this->renderAjax('_listing', [ // Render Ajax to use PJAX
                    'year' => $year,
                    'school' => $school,
                    'level' => $level,
                    'model' => $model,
                    'model_' => $model_,
                    'message' => $message,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        else
        {
            if ($model->errors)
            {
                $message = json_encode($model->errors);
            }
        }

        if (Yii::$app->request->isAjax) 
        {
            // echo 'TEST 2';

            return $this->renderAjax('_listing', [ // Render Ajax to use PJAX
                'year' => $year,
                'school' => $school,
                'level' => $level,
                'model' => $model,
                'model_' => $model_,
                'message' => $message,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('_listing', [
            'year' => $year,
            'school' => $school,
            'level' => $level,
            'model' => $model,
            'model_' => $model_,
            'message' => $message,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single MpPayRemission model.
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
     * Creates a new MpPayRemission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MpPayRemission();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MpPayRemission model.
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
     * Deletes an existing MpPayRemission model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        if (Yii::$app->request->isAjax) {
            
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            return [
                'success' => true, 
                'title' => 'List Pembayaran',
                'message' => 'Data berhasil dihapus'
            ];
        }

        Yii::$app->getSession()->setFlash('paylist_delete', [
                'type'     => 'warning',
                'duration' => 5000,
                'title'    => 'Data Pembayaran',
                'message'  => 'Pembayaran berhasil dihapus !',
            ]
        );

        return $this->redirect(['index']);
    }

    /**
     * Finds the MpPayRemission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MpPayRemission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MpPayRemission::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
