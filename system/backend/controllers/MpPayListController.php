<?php

namespace backend\controllers;

use Yii;
use backend\models\MpPayList;
use backend\models\MpPayListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MpPayListController implements the CRUD actions for MpPayList model.
 */
class MpPayListController extends Controller
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
                    'delete' => ['GET', 'POST'],
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
     * Lists all MpPayList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MpPayListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MpPayList models.
     * @return mixed
     */
    public function actionListing($year, $school, $level)
    {
        $model  = new MpPayList;
        $model_ = MpPayList::findOne(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level]) ?: ['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level];
        $searchModel = new MpPayListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level]);
        $dataProvider->pagination->pageSize = 5;

        $message = '';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if (Yii::$app->request->isAjax) 
            {
                $model->save();

                $searchModel = new MpPayListSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['id_tahun' => $year, 'id_sekolah' => $school, 'id_jenjang' => $level]);
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
     * Displays a single MpPayList model.
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
     * Creates a new MpPayList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MpPayList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data Berhasil ditambah');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MpPayList model.
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
     * Deletes an existing MpPayList model.
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
     * Finds the MpPayList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MpPayList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MpPayList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
