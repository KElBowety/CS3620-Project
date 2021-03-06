<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";



class SMSConfirmer implements SplObserver
{
    public function update(SplSubject $subject)
    {
    $this->sendSMS($subject->userName,$subject->password);

    }

    public function sendSMS($userName,$password)
    {
        $filename="myfile.txt";
        $content="A new Account was created with user name: ".$userName." and password: ".$password;
        // this one will be replaced with sms code :D
        file_put_contents($filename, $content);
    }
}
class EmailConfirmer implements SplObserver
{
    public function update(SplSubject $subject)
    {
//        echo __METHOD__ . " Emailing all other comment authors who commented on " . $subject->userName . " that someone commented with : " . $subject->password . "\n";

    $this->sendEmail($subject->userName,$subject->password);

    }
    public function sendEmail($userName,$password)
    {

        $mail = new PHPMailer();

        $mail->SMTPSecure = 'tls';
        $mail->Username = "cs4550project@outlook.com";
        $mail->Password = "Aa1234321234";
        $mail->AddAddress("abdelrahman.ghanam@uofcanada.edu.eg");
        $mail->FromName = "project";
        $mail->Subject = "project mail test";
        $mail->Body = "A new Account was created with user name: ".$userName." and password: ".$password;
        $mail->Host = "smtp.live.com";
        $mail->Port = 587;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->From = $mail->Username;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }
}

?>