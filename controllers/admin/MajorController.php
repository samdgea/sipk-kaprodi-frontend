<?php

namespace app\controllers\admin;

use app\models\Faculty;
use Yii;
use app\models\Major;
use app\models\Search\MajorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MajorController implements the CRUD actions for Major model.
 */
class MajorController extends Controller
{
    public $layout = 'paper-dashboard/main';

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
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['browse-major-management']
                    ], [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['read-major-management']
                    ], [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['update-major-management']
                    ], [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['create-major-management']
                    ], [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['delete-major-management']
                    ]
                ],
                'denyCallback' => function($r, $a) {
                    Yii::$app->session->setFlash('danger', 'You are not authorized to access this module');
                    return Yii::$app->response->redirect('/site/index');
                }
            ],
        ];
    }

    /**
     * Lists all Major models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MajorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Major model.
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
     * Creates a new Major model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $facultyModel = Faculty::findOne(['id' => Yii::$app->request->get('faculty_id')]);
        
        // if (empty($facultyModel)) {
        //     Yii::$app->getSession()->setFlash('error', 'Invalid Faculty');
        //     return $this->goBack();
        // }

        $model = new Major();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'facultyModel' => $facultyModel
        ]);
    }

    /**
     * Updates an existing Major model.
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
     * Deletes an existing Major model.
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
     * Finds the Major model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Major the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Major::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
