<?php

namespace app\controllers;

use app\models\News;
use app\models\TicketsBuy;
use app\models\TypeTickets;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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

            $this->sendMailPayment($model, $id);

            $model->save();

            return $this->redirect('/');
        } else{
            return $this->render('payment',[
                'ticket'=>TypeTickets::findOne($id),
                'model'=>$model
            ]);
        }
    }

    public function sendMailPayment($modelBuyTickets, $idTypeTicket){

        $mail = new PHPMailer(true);
        $typeTicket = TypeTickets::findOne($idTypeTicket);
        $this->qrGenerate($modelBuyTickets, $typeTicket);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output (SMTP::)
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'mischatitovmail.ru@gmail.com';                     //SMTP username
                $mail->Password   = 'opwbeikzfuxugyvb';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;
                $mail->CharSet = 'UTF-8'; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($modelBuyTickets->email, 'E Three comp');
                $mail->addAddress($modelBuyTickets->email, 'Daniil');     //Add a recipient

                //Attachments
                $mail->addAttachment('img/qr-code.png');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Чек о покупки билета на выставку';
                $mail->Body    = '
                        <table border="1">
                            <tr>
                                <th>Имя покупателя</th>
                                <th>Привязанная почта для отправки чека на почту</th>
                                <th>Тип билета</th>
                                <th>Цена</th>
                                <th>Дата покупки</th>
                            </tr>
                            <tr>
                                <td>'.$modelBuyTickets->name.'</td>
                                <td>'.$modelBuyTickets->email.'</td>
                                <td>'.$typeTicket->name.'</td>
                                <td>'.$typeTicket->price.'</td>
                                <td>'.$modelBuyTickets->date_buy.'</td>
                            </tr>
                        </table>
                    ';
//                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Это тело в виде обычного текста для почтовых клиентов, не поддерживающих HTML.

                $mail->send();
                echo 'Message has been sent';

            } catch (Exception $e){
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    public function qrGenerate($modelBuyTickets, $typeTicket){

        $text = 'Билет '.$typeTicket->name.', купленный по цене '.$typeTicket->price.' на имя '.$modelBuyTickets->name.' дата '.$modelBuyTickets->date_buy;

        $qrCode = QrCode::create($text);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        header("Content-Type: ". $result->getMimeType());

        $result->saveToFile('img/qr-code.png');
    }

}
