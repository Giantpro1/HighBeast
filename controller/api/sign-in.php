<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Header: Origin, content-Type, Accept');

    require_once '../dbc.php';

    $dbs = new Dbc();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if($dbs->validate_param($_POST['hBUser_UserName'])){
            $hBUser_UserName = $dbs->test_input($_POST['hBUser_UserName']);
        }else{
            echo json_encode([
                "message"=> "UserName Field Cannot Be empty",
                "status"=>402
            ]);
        }
        if($dbs->validate_param($_POST['hBUser_Password'])){
            $hBUser_Password =$dbs->test_input($_POST['hBUser_Password']);
            $logHbUser =$dbs->loginHbUser($hBUser_UserName);
            $_SESSION['ourUser'] = $hBUser_UserName;
            if($logHbUser != null){
                if(password_verify($hBUser_Password, $logHbUser['hBUser_Password'])){
                    echo json_encode([
                        "message"=> "login Successfully",
                        "status"=>200
                    ]);
                }else{
                    echo json_encode([
                        "message"=>"incorrect password",
                        "status"=>402
                    ]);
                }
            }else{
                echo json_encode([
                    "message"=>"user not found",
                    "status"=>404
                ]);
            }
        }else{
            echo json_encode([
                'message'=>"password field cannot be empty",
                "status"=>402
            ]);
        }
    }else{
       echo json_encode([
        "message"=>"error wrong format",
        "status"=>402
       ]);
       die();
    }