<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\base\ErrorException;
use app\services\wechart\WechartErrCode;
use app\services\utility\xml\XmlFile;
use app\services\wechart\WechatApi;
use app\services\business\Job;

use app\models\JobList;

class SiteController extends Controller
{

    public $layout = 'mui_layout';

    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         Yii::$app->response->redirect(Url::to(['/job']));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionTest()
    {
        $request = Yii::$app->request;
        $widgetExtension = '.php';
        $widgetName = ucfirst(trim($request->get('name')));
        $widgetFloder = Yii::getAlias('@app') . '/widget/iview';
        $widgetFile = $widgetFloder . '/' . $widgetName . $widgetExtension;
        echo 'GET<br>';
        print_r($request->get());
        echo '<br>POST<br>';
        print_r($request->post());
//        if (!file_exists($widgetFile)) {
//             $fp = fopen($widgetFile , 'w+');
//             fclose($fp);
//        } else {
//            echo $widgetFile;
//            echo '<br>文件已经存在';
//        }

    }


    /**
     * 用户注册
     */
    public function actionReg()
    {
        return $this->render('reg');
    }

    /**
     *个人中心
     */
    public function actionPersonal()
    {
        return $this->render('personal');
    }


}
