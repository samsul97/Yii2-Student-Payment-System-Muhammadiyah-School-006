<?php

namespace backend\controllers;

use Yii;
use yii\helpers\BaseStringHelper;
use backend\models\MpPayList;
use backend\models\MpStudent;
use backend\models\MpPayTransact;
use backend\models\MpPayTransactSearch;
use backend\models\MpGrade;
use backend\models\MpGradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ReportController extends \yii\web\Controller
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
        $dataProvider->setSort([
            'defaultOrder' => [
                'timestamp' => SORT_DESC,
            ]
        ]);

        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');

        if ($start_date && $end_date)
        {
            $start_date = explode('/', $start_date);
            $start_date = sprintf('%s-%s-%s', $start_date[2], $start_date[1], $start_date[0]) . ' 00:00:00';
            $end_date = explode('/', $end_date);
            $end_date = sprintf('%s-%s-%s', $end_date[2], $end_date[1], $end_date[0]) . ' 23:59:59';
            $dataProvider->query->andFilterWhere(['between', 'datetime', $start_date, $end_date]);
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all MpGrade models.
     * @return mixed
     */
    public function actionRemission()
    {
        $searchModel = new MpGradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('remission', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
