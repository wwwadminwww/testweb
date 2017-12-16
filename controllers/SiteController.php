<?php

namespace app\controllers;

use app\models\Category;
use app\models\Post;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
        return $this->render('index');
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
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays all posts with pagination.
     *
     * @return string
     */
    public function actionAll()
    {
        $posts = new ActiveDataProvider([
            'query' => Post::find()->orderBy('id', SORT_DESC),
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        return $this->render('all', ['posts' => $posts]);
    }


    /**
     * Display one post and check category and post slug with DB slug values.
     *
     * @param $category
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($category, $slug)
    {
        if (
            (($model = Post::find()->where(['slug' => $slug])->one()) !== null) &&
            ((($category_slug = Category::find()->where(['slug' => $category])->one()) !== null))
        ) {
            if (($slug === $model->slug) && ($category === $category_slug->slug)) {
                return $this->render('detail', ['model' => $model]);

            } else {
                throw new NotFoundHttpException();
            }
        }else{
            throw new NotFoundHttpException();
        }
    }


    /**
     * Display all post for one category and check type of category and check slug for category in DB
     *
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($slug)
    {
        if (($model = Category::findOne(['slug' => $slug])) !== null ) {
            if (($slug === $model->slug) && ($model->type === 1)) {
                return $this->render('category', ['model' => $model]);
            } else {
                throw new NotFoundHttpException();
            }
        }else{
            throw new NotFoundHttpException();
        }
    }

    public function actionApiTest()
    {
        $unisender_base_url = 'https://api.unisender.com/ru/api/';
        $api_method = 'getLists';
        $client = new Client(['baseUrl' => $unisender_base_url]);
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl($api_method)
            ->setData(['format' => 'json', 'api_key' => '1234567890abcdef'])
            ->send();
        if ($response->isOk){
            $response = json_decode($response->content);
            return $this->render('api-test', ['response' => $response]);
        }else{
            return $this->render('api-test', ['response' => $response->content]);
        }

    }

    public function actionTest()
    {
        return $this->render('test');
    }
}
