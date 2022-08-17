<?php

        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Method: POST');
        header('Access-Control-Allow-Header: Origin, content-Type, Accept');

        require_once '../dbc.php';

        $dbs = new Dbc();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $pid = $dbs->test_input($_POST['pid']);
            if($dbs->validate_param($_POST['hbUser_BlogTit'])){
                $hbUser_BlogTit = $dbs->test_input($_POST['hbUser_BlogTit']);
            }else{
                echo json_encode([
                    'message'=>'Blog Title Cannot Empty',
                    'status'=>404
                ]);
            }
            if($dbs->validate_param($_POST['hbUser_BlogCat'])){
                $hbUser_BlogCat = $dbs->test_input($_POST['hbUser_BlogCat']);
            }else{
                echo json_encode([
                    'message'=>'category section Cannot Empty',
                    'status'=>404
                ]);
            }
            if($dbs->validate_param($_POST['hbUser_BlogDes'])){
                $hbUser_BlogDes = $dbs->test_input($_POST['hbUser_BlogDes']);
            }else{
                echo json_encode([
                    'message'=>'Blog Desciption Cannot Empty',
                    'status'=>404
                ]);
            }
            $result = $dbs->hbUserBlogUpload($pid, $hbUser_BlogTit, $hbUser_BlogCat, $hbUser_BlogDes);
            echo json_encode([
                "message"=>"upload successfully",
                "status"=>200
            ]);

           if(isset($_FILES['hbUser_BlogImg'])){
            $pidofimg = $dbs->test_input($_POST['pidofimg']);
            $hbUser_BlogImg = $_FILES['hbUser_BlogImg']['name'];

            foreach ($hbUser_BlogImg as $i => $value){
                $hbUser_BlogImgRand = time(). '_' . rand(200, 1000). '_' .$hbUser_BlogImg[$i];
                $blogImgFolder = '../uploadImg/';
                $moveFile = $blogImgFolder.$hbUser_BlogImgRand;
                $pathName = $_FILES['hbUser_BlogImg']['tmp_name'][$i];
                move_uploaded_file($pathName, $moveFile);

                $imgUploadResult = $dbs->hbUserBlogUploadImg($pidofimg, $hbUser_BlogImgRand);
            }
           }else{
            echo json_encode([
                'message'=>"img upload error",
                'status'=>405
            ]);
           }

        }else{
          echo json_encode([
                'message'=>'error wrong format',
                'status'=>402
            ]);
            die();
        }