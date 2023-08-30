<?php

namespace app\controllers;

use app\models\News;
use app\models\TicketsBuy;
use app\models\TypeTickets;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        return $this->render('index',[
            'model'=>News::find()->asArray()->all(),
            'ticketsModel'=>TypeTickets::find()->asArray()->all()
        ]);
    }

    public function actionAbout(){

        return $this->render('about');
    }

    public function actionTickets(){
        return $this->render('tickets',[
            'model'=>TypeTickets::find()->asArray()->all()
        ]);
    }

    public function actionPayment($id){

        $model = new TicketsBuy();

        if ($this->request->post()){
            $post = $this->request->post();

            $model->name = $post['TicketsBuy']['name'];
            $model->email = $post['TicketsBuy']['email'];
            $model->card_number = $post['TicketsBuy']['card_number'];
            $model->type_tickets_id = $post['TicketsBuy']['type_tickets_id'];
            $model->date_buy = date('Y-m-d');

            $model->save();

            return $this->redirect('/');
        } else{
            return $this->render('payment',[
                'ticket'=>TypeTickets::findOne($id),
                'model'=>$model
            ]);
        }

    }

}
