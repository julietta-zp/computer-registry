<?php

namespace app\controllers;

use app\models\Application;
use Yii;
use app\models\Computer;
use app\models\ComputerSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComputerController implements the CRUD actions for Computer model.
 */
class ComputerController extends Controller
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
     * Lists all Computer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComputerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Computer model.
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
     * Creates a new Computer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Computer();
        $applicationModel = new Application();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $applicationsSelected = Application::findAll($_POST['Application']);
            foreach ($applicationsSelected as $app){
                $model->link('applications', $app);
            }
            return $this->redirect('index');
        } else {
            $applicationsAll = Application::find()->asArray()->all();
            $applications = ArrayHelper::map($applicationsAll, 'id', 'app_name');
            return $this->render('create', [
                'model' => $model,
                'applications' => $applications,
                'applicationModel' => $applicationModel,
            ]);
        }
        
    }

    /**
     * Updates an existing Computer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $applicationModel = new Application();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->unlinkAll('applications', true);
            $applicationsSelected = Application::findAll($_POST['Application']);
            foreach ($applicationsSelected as $app){
                $model->link('applications', $app);
            }
            return $this->redirect('index');
        } else {
            $applicationsPreSelected = ArrayHelper::getColumn($model->applications, 'id');
            $applicationModel->id = $applicationsPreSelected;
            $applicationsAll = Application::find()->asArray()->all();
            $applications = ArrayHelper::map($applicationsAll, 'id', 'app_name');
            return $this->render('update', [
                'model' => $model,
                'applications' => $applications,
                'applicationModel' => $applicationModel,
            ]);
        }
    }


    /**
     * Deletes an existing Computer model.
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
     * Finds the Computer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Computer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Computer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
