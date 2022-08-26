<?php

    // header('Access-Control-Allow-Origin: *');
    // header('Content-type: application/json');
    // header('Access-Control-Allow-Method: GET');
    // header('Access-Control-Allow-Header: Origin, content-Type, Accept');
    set_include_path(dirname(__FILE__)."/../");
    require_once ('dbc.php');
    require_once ('google-api-php-client-2.4.0/google-api-php-client-2.4.0/vendor/autoload.php');

    $client = new Google_Client();
    $dbs = new Dbc();
    $client->setClientId('16194097147-2virl66g40jfe2g5ocm6tq8ifdbokl26.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/DBeast/index.php');

    $client->addScope('email');
    $client->addScope('profile'); 

            // if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if(isset($_GET['code'])):

                  $token =  $client->fetchAccessTokenWithAuthCode($_GET['code']);
                    if(!isset($token['error'])){
                        $client->setAccessToken($token['access_token']);
                        
                        $google_oauth = new Google_Service_Oauth2($client);
                        $google_account_info = $google_oauth->userinfo->get();
                        // saving
                        $google_id = $dbs->test_input($google_account_info->id);
                        $name = $dbs->test_input($google_account_info->name);
                        $email = $dbs->test_input($google_account_info->email);
                            $insert = $dbs->saveUserFromGoogleInDb($google_id, $name, $email);
                            if($insert){
                                echo "successfully";
                            }else{
                                echo "something went wrong";
                            }
                    }
                else
                    echo "";
                endif;
            // }else{
            //     echo json_encode([
            //         'message'=>'error wrong format',
            //         'status'=>402
            //     ]);
            //     die();
            // }
       
        