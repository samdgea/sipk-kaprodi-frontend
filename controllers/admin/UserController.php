<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\exceptions\NotImplementedException;

use app\models\Search\UserSearch;
use app\models\User;

class UserController extends Controller
{
    public $layout = 'paper-dashboard/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['browse-user-management']
                    ], [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['read-user-management']
                    ], [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['edit-user-management']
                    ], [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['add-user-management']
                    ], [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['delete-user-management']
                    ]
                ],
                'denyCallback' => function($r, $a) {
                    Yii::$app->session->setFlash('danger', 'You are not authorized to access this module');
                    return Yii::$app->response->redirect('/site/index');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'update' => ['get', 'post'],
                    'create' => ['get', 'post'],
                    'delete' => ['post']
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model !== null)
            return $this->render('view', compact('model'));

        Yii::$app->session->setFlash('danger', 'Resource does not exists');
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model === null) {
            Yii::$app->session->setFlash('danger', 'Resource does not exists');
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Resource successfully modified');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Resource successfully created');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if ($model === null) {
            Yii::$app->session->setFlash('danger', 'Resource does not exists');
        } else {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Resource has been removed');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
    }
}