<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Header: Origin, content-Type, Accept');

require_once '../dbc.php';

$AdminDb = new Admin();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($AdminDb->validate_param($_POST['hbAdmin_UserName'])){
                $hbAdmin_UserName =$AdminDb->test_input($_POST['hbAdmin_UserName']);
            }else{
                echo json_encode([
                    "message"=>"UserName cannot be empty",
                    "status"=>402
                ]);
            }
            if($AdminDb->validate_param($_POST['hbAdmin_Password'])){
                $hbAdmin_Password =$AdminDb->test_input($_POST['hbAdmin_Password']);
            }else{
                echo json_encode([
                    "message"=>"Password cannot be empty",
                    "status"=>402
                ]);
            }
                $hpass = password_hash($hbAdmin_Password, PASSWORD_DEFAULT);
                $result = $AdminDb->registerhbAdmin( $hbAdmin_UserName, $hpass);
                $_SESSION['ourAdmin'] = $hbAdmin_UserName;
                echo json_encode([
                    "message"=> "register successfully",
                    "status"=>200
                ]);
    }else{
        echo json_encode([
            "message"=>"error wrong format",
            "status"=>402
        ]);
        die();
    }