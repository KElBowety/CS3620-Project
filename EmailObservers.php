<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";



class SMSConfirmer implements SplObserver
{
    public function update(SplSubject $subject)
    {
//        echo __METHOD__ . " Emailing the author of post id: " . $subject->userName . " that someone commented with : " . $subject->password . "\n";

        $client = new ClxXmsClient('2c110dcf48fc4654a9ab546ec3b50b46', 'ef24e984606d42ac871eddd5448d18f1');

        $batchParams = new ClxXmsApiMtBatchTextSmsCreate();
        $batchParams->setSender('447537404817');
        $batchParams->setRecipients(['201015224979']);
        $batchParams->setBody("A new Account was created with user name: ".$subject->userName." and password: ".$subject->password);

        try {
            $result = $client->createTextBatch($batchParams);
            echo('Successfully sent batch ' . $result->getBatchId());
        } catch (ClxXmsApiException $ex) {
            echo('Failed to communicate with XMS: ' . $ex->getMessage() . "
");
        }


    }
}
class EmailConfirmer implements SplObserver
{
    public function update(SplSubject $subject)
    {
//        echo __METHOD__ . " Emailing all other comment authors who commented on " . $subject->userName . " that someone commented with : " . $subject->password . "\n";

        $mail = new PHPMailer();

        $mail->SMTPSecure = 'tls';
        $mail->Username = "cs4550project@outlook.com";
        $mail->Password = "Aa1234321234";
        $mail->AddAddress("abdelrahman.ghanam@uofcanada.edu.eg");
        $mail->FromName = "project";
        $mail->Subject = "project mail test";
        $mail->Body = "A new Account was created with user name: ".$subject->userName." and password: ".$subject->password;
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

//        exit(json_encode(array("status" => $status, "response" => $response)));

    }
}

?>