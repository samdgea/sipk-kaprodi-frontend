<?php

namespace app\controllers\account;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\Forms\Account\ProfileForm;

class ProfileController extends Controller
{
    public $layout = 'paper-dashboard/main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@']
                    ]
                ],
                'denyCallback' => function($r, $a) {
                    return Yii::$app->response->redirect('/auth/login');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ProfileForm();
        $model->setFormName('ProfileForm');
        $model->scenario = ProfileForm::SCENARIO_BASIC_INFORMATION;

        $model_change = new ProfileForm();
        $model_change->setFormName('PasswordForm');
        $model_change->scenario = ProfileForm::SCENARIO_CHANGE_PASSWORD;

        if (Yii::$app->request->getMethod() == "POST" && !empty(Yii::$app->request->post('ProfileForm'))) {
            if ($model->load(Yii::$app->request->post()) && $model->doChangeProfileInfo()) 
            {
                Yii::$app->session->setFlash('success', 'Berhasil mengubah informasi profil');
                return $this->redirect('/account/profile/index');
            }
        }

        if (Yii::$app->request->getMethod() == "POST" && !empty(Yii::$app->request->post('PasswordForm'))) {
            if ($model_change->load(Yii::$app->request->post()) && $model_change->doChangePassword()) 
            {
                Yii::$app->session->setFlash('success', 'Berhasil mengubah password');
                return $this->redirect('/account/profile/index');
            }
        }

        return $this->render('index', [
            'model' => $model,
            'model_change' => $model_change
        ]);
    }
}
