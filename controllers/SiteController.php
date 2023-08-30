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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'mischatitovmail.ru@gmail.com';                     //SMTP username
                $mail->Password   = 'opwbeikzfuxugyvb';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('ggtitovgg@gmail.com', 'Jhon');
                $mail->addAddress('ggtitovgg@gmail.com', 'Mishanya');     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            return $this->redirect('/');
        } else{
            return $this->render('payment',[
                'ticket'=>TypeTickets::findOne($id),
                'model'=>$model
            ]);
        }

    }

}
