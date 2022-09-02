<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/vendor/autoload.php';
require '../dbc.php';

$mail = new PHPMailer(true);

$dbs = new Dbc();

if(isset($_POST['hBUser_Email'])){
    $hBUser_Email = $dbs->test_input($_POST['hBUser_Email']);
    // checking email exits
    $check = $dbs->user_exitsEmail($hBUser_Email);
    if(!$check){
        echo "email cannot be found";
    }else{
        $link = 'http://localhost/DBeast/index';
            
                try{
                        //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = gethostname();                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'brittainipowell9@gmail.com';                     //SMTP username
                $mail->Password   = '(123@Brittaini_Powell)';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('brittainipowell9@gmail.com', 'verify your email');
                $mail->addAddress($hBUser_Email);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo('brittainipowell9@gmail.com');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Account Verification';
                $mail->Body    = 'Hello user your token is '.$link;
                ;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
                }catch(Exception $e){
                    echo "message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


 }
}
