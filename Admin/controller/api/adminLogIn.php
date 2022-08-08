<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Header: Origin, content-Type, Accept');

    require_once '../dbc.php';

    $AdminDb = new Admin();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // if(isset($_POST['action']) && $_POST['action'] == 'Admin_log'){
                if($AdminDb->validate_param($_POST['hbAdmin_UserName'])){
                    $hbAdmin_UserName = $AdminDb ->test_input($_POST['hbAdmin_UserName']);
                }else{
                    echo json_encode([
                        'message'=> 'userName field cannot be empty',
                        'status'=>402
                    ]);
                } 
                if($AdminDb->validate_param($_POST['hbAdmin_Password'])){
                    $hbAdmin_Password = $AdminDb->test_input($_POST['hbAdmin_Password']);
                }else{
                    echo json_encode([
                        'message'=>'password field cannot be empty',
                        'status'=>402
                    ]);
                }
                    $loghbAdmin = $AdminDb->AdminLog($hbAdmin_UserName);
                    if($loghbAdmin != null){
                       if(password_verify($hbAdmin_Password, $loghbAdmin['hbAdmin_Password'])){
                        echo json_encode([
                            'message'=> 'login Successfully',
                            'status'=>200
                        ]);
                       }else{
                        echo json_encode([
                            'message'=> 'incorrect password',
                            'status'=>402
                        ]);
                       }
                    }else{
                        echo json_encode([
                            'message'=> 'user not found',
                            'status'=>402
                        ]);
                    }
            // }
    }else{
        echo json_encode([
            'message'=> 'error wrong format',
            'status'=>402
        ]);
        die();
    }