<?php


namespace Unit;

use app\models\TypeTickets;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use \UnitTester;

class EmailSendCest
{
    // tests
    public function tryToTest(UnitTester $I)
    {
        $mail = new PHPMailer(true);
        $modelBuyTickets = [
          'name'=>'Юнит тест',
            'email'=>'corpethree@gmail.com',
          'date_buy'=> date('Y-m-d')
        ];
        $typeTicket = TypeTickets::findOne(1);
//        $this->qrGenerate($modelBuyTickets, $typeTicket);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output (SMTP::)
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'daniilkorpykovv@gmail.com';                     //SMTP username
            $mail->Password   = 'rctqmhbwzemfqiwu';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->CharSet = 'UTF-8'; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($modelBuyTickets['email'], 'E Three comp');
            $mail->addAddress($modelBuyTickets['email'], 'Daniil');     //Add a recipient

            //Attachments
//            $mail->addAttachment('../web/img/qr-code.png');

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
                                <td>'.$modelBuyTickets['name'].'</td>
                                <td>'.$modelBuyTickets['email'].'</td>
                                <td>'.$typeTicket->name.'</td>
                                <td>'.$typeTicket->price.'</td>
                                <td>'.$modelBuyTickets['date_buy'].'</td>
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

//    public function qrGenerate($modelBuyTickets, $typeTicket){
//
//        $text = 'Билет '.$typeTicket->name.', купленный по цене '.$typeTicket->price.' на имя '.$modelBuyTickets['name'].' дата '.$modelBuyTickets['date_buy'];
//
//        $qrCode = QrCode::create($text);
//
//        $writer = new PngWriter();
//        $result = $writer->write($qrCode);
//
//        header("Content-Type: ". $result->getMimeType());
//
//        $result->saveToFile('img/qr-code.png');
//    }
}
