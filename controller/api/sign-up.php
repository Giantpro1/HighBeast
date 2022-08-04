<?php

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Method: POST');
        header('Access-Control-Allow-Header: Origin, content-Type, Accept');

        require_once '../dbc.php';

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
                        $hpass = password_hash($hBUser_Password, PASSWORD_DEFAULT);
                        $result = $dbs->registerHbUser($hBUser_FullName, $hBUser_UserName, $hBUser_Email, $hpass);
                        echo json_encode([
                            "message"=> "register successfully",
                            "status"=>200
                        ]);
                    }
            }else{
                echo json_encode([
                    "message"=>"error wrong format",
                    "status"=>402
                ]);
                die();
            }