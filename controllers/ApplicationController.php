<?php

namespace app\controllers;

use app\models\Computer;
use Yii;
use app\models\Application;
use app\models\ApplicationSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplicationController implements the CRUD actions for Application model.
 */
class ApplicationController extends Controller
{
    /**
     * @inheritdoc
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

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Lists all Application models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Application();
        $computerModel = new Computer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $computersSelected = Computer::findAll($_POST['Computer']);
            foreach ($computersSelected as $computer){
                $model->link('computers', $computer);
            }
            return $this->redirect('index');
        } else {
            $computersAll = Computer::find()->asArray()->all();
            $computers = ArrayHelper::map($computersAll,'id','computer_name');
            return $this->render('create', [
                'model' => $model,
                'computers' => $computers,
                'computerModel' => $computerModel,
            ]);
        }
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $computerModel = new Computer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->unlinkAll('computers', true);
            $computersSelected = Computer::findAll($_POST['Computer']);
            foreach ($computersSelected as $computer){
                $model->link('computers', $computer);   
            }
            return $this->redirect('index');
        } else {
            $computersPreSelected = ArrayHelper::getColumn($model->computers, 'id');
            $computerModel->id = $computersPreSelected;
            $computersAll = Computer::find()->asArray()->all();
            $computers = ArrayHelper::map($computersAll,'id','computer_name');
            return $this->render('update', [
                'model' => $model,
                'computers' => $computers,
                'computerModel' => $computerModel,
            ]);
        }
    }

    /**
     * Deletes an existing Application model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
