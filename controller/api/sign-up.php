<?php


        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Method: POST');
        header('Access-Control-Allow-Header: Origin, content-Type, Accept');

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        require_once '../dbc.php';
        require '../PHPMailer/vendor/autoload.php';

        $mail = new PHPMailer(true);
        $dbs = new Dbc();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    if($dbs->validate_param($_POST['hBUser_FullName'])){
                        $hBUser_FullName = $dbs->test_input($_POST['hBUser_FullName']);

                    }else{
                        echo json_encode([
                            "message"=>"fullname cannot be empty",
                            "status"=>402
                        ]);
                    }
                    if($dbs->validate_param($_POST['hBUser_UserName'])){
                        $hBUser_UserName =$dbs->test_input($_POST['hBUser_UserName']);
                    }else{
                        echo json_encode([
                            "message"=>"UserName cannot be empty",
                            "status"=>402
                        ]);
                    }
                    if($dbs->validate_param($_POST['hBUser_Email'])){
                        $hBUser_Email =$dbs->test_input($_POST['hBUser_Email']);
                    }else{
                        echo json_encode([
                            "message"=>"Email cannot be empty",
                            "status"=>402
                        ]);
                    }
                    if($dbs->validate_param($_POST['hBUser_Password'])){
                        $hBUser_Password =$dbs->test_input($_POST['hBUser_Password']);
                    }else{
                        echo json_encode([
                            "message"=>"Password cannot be empty",
                            "status"=>402
                        ]);
                    }
                    if($dbs->user_exitsEmail($hBUser_Email)){
                        echo json_encode([
                            "message"=>"user already exits",
                            "status"=>402
                        ]);
                    }else {
                        $uppercase = preg_match('@[A-Z]@', $hBUser_Password);
                        $lowercase = preg_match('@[a-z]@', $hBUser_Password);
                        $number = preg_match('@[0-9]@', $hBUser_Password);
                        $specialChars = preg_match('@[^\W]@', $hBUser_Password);
                        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($hBUser_Password) < 8 ){
                          echo json_encode([
                            'message'=> "password should be at least 8 characters in lengths and should include at least one upper case letter, one number, and one special characters",
                            'status'=>400
                          ]);
                        }else{
                            $hpass = password_hash($hBUser_Password, PASSWORD_DEFAULT);
                            $result = $dbs->registerHbUser($hBUser_FullName, $hBUser_UserName, $hBUser_Email, $hpass);
                            $_SESSION['ourUser'] = $hBUser_UserName;
                            $link = 'http://localhost/DBeast/index';
                            if($result){
                                try{
                                     //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'brittainipowell9@gmail.com';                     //SMTP username
                                $mail->Password   = '(123@Brittaini_Powell)';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                //Recipients
                                $mail->setFrom('brittainipowell9@gmail.com', 'Mailer');
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
                                $mail->Body    = '<P> Welcome to Higbeast'.$hBUser_UserName.'</p> 
                                '. '<bold> click on the link to activate your account.</bold>'.$link;
                                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                $mail->send();
                                // echo 'Message has been sent';
                                }catch(Exception $e){

                                }
                                echo json_encode([
                                    "message"=> "register successfully",
                                    "status"=>200
                                ]);
                            }
                        }
                            
                        }
            }else{
                echo json_encode([
                    "message"=>"error wrong format",
                    "status"=>402
                ]);
                die();
            }