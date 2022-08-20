<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Header: Origin, content-Type, Accept');

    require_once '../dbc.php';
    require_once '../vendor/autoload.php';
    use \Firebase\JWT\JWT;

    $dbs = new Dbc();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $data = json_decode(file_get_contents("php://input", true));

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
        }else{
            echo json_encode([
                'message'=>"password field cannot be empty",
                "status"=>402
            ]);
        }
        $dbs->loginHbUser($hBUser_UserName);
        // $_SESSION['ourUser'] = $hBUser_UserName;
            $hbUSersData = $dbs->getResult();
            foreach($hbUSersData as $data){
                $id = $data['id'];
                $hBUser_FullName = $data['hBUser_FullName'];
                $hBUser_UserName = $data['hBUser_UserName'];
                $hBUser_Email = $data['hBUser_Email'];
                if(password_verify($hBUser_Password, $data['hBUser_Password'])){
                    $payload = [
                        'iss' => "localhost",
                        'aud' => "localhost",
                        'exp' => time() + 2000,
                        'data' => [
                            'id' => $id,
                            'hBUser_FullName' =>$hBUser_FullName ,
                            'hBUser_UserName' =>$hBUser_UserName ,
                            'hBUser_Email' =>$hBUser_Email 
                        ],
                    ];
                    $secret_key = "HighBeast Blog";
                    $jwt = JWT::encode($payload, $secret_key, 'HS256');
                    echo json_encode([
                        "message"=> "login Successfully",
                        'jwt'=> $jwt,
                        "status"=>200
                    ]);
                }else{
                    echo json_encode([
                        'message'=> 'incorrect password',
                        'status'=>402
                    ]);
                }
            }
            if($data = null){
                echo json_encode([
                    'message'=>'user not user',
                    'status'=>400
                ]);
            }
    }else{
       echo json_encode([
        "message"=>"error wrong format",
        "status"=>402
       ]);
       die();
    }