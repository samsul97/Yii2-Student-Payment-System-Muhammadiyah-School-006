<?php

namespace backend\controllers;

use Yii;
use backend\models\MpStudent;
use backend\models\MpStudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MpStudentController implements the CRUD actions for MpStudent model.
 */
class MpStudentController extends Controller
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
     * Lists all MpStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MpStudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MpStudent model.
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
     * Creates a new MpStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MpStudent();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'student/' . $model->nis . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->image = $file;
            }

            $model->save();

            Yii::$app->getSession()->setFlash('student_create', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'Data Siswa',
                    'message'  => 'Data Berhasil ditambah !',
                ]
            );
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MpStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'student/' . $model->nis . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                $model->image = $file;
            }
            else
            {
                $path = $this->findModel($id);
                $model->image = $path->image;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MpStudent model.
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
     * Finds the MpStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MpStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MpStudent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
