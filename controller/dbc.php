<?php
require_once 'config.php';

    class Dbc extends Database{

        // register db function
        public function registerHbUser($hBUser_FullName, $hBUser_UserName, $hBUser_Email, $hBUser_Password){
            $sql = "INSERT INTO hbuser (hBUser_FullName, hBUser_UserName, hBUser_Email, hBUser_Password) VALUES (:hBUser_FullName, :hBUser_UserName, :hBUser_Email, :hBUser_Password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hBUser_FullName'=>$hBUser_FullName,
                'hBUser_UserName'=>$hBUser_UserName,
                'hBUser_Email'=>$hBUser_Email,
                'hBUser_Password'=>$hBUser_Password
            ]);
            return true;
        }

        // to check for empty set
        public function validate_param($value){
            return (!empty($value));
        }

            // get result
            public function getResult() {
                $val = $this->conn;
                $this->conn = array();
                return $val;
            }



        // to check user exit info of email

        public function user_exitsEmail($hBUser_Email){
            $sql ="SELECT hBUser_Email FROM hbuser WHERE hBUser_Email=:hBUser_Email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hBUser_Email'=>$hBUser_Email
            ]);
            $result =$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function loginHbUser($hBUser_UserName){
            $sql = "SELECT hBUser_UserName, hBUser_Password FROM hbuser WHERE hBUser_UserName=:hBUser_UserName";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hBUser_UserName'=>$hBUser_UserName
            ]);
            $userFetch =$stmt->fetch(PDO::FETCH_ASSOC);
            return $userFetch;
        }

        // upload blog

        public function hbUserBlogUpload($pid, $hbUser_BlogTit, $hbUser_BlogCat, $hbUser_BlogDes){
           $sql = "INSERT INTO hbuserblog (pid, hbUser_BlogTit, hbUser_BlogCat, hbUser_BlogDes) VALUES (:pid, :hbUser_BlogTit, :hbUser_BlogCat, :hbUser_BlogDes)";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([
            'pid'=>$pid,
            'hbUser_BlogTit'=>$hbUser_BlogTit,
            'hbUser_BlogCat'=>$hbUser_BlogCat,
            'hbUser_BlogDes'=>$hbUser_BlogDes
           ]);
           return true;
        }
        
        // blog images 

        public function hbUserBlogUploadImg($pidofimg, $hbUser_BlogImg){
            $sql = "INSERT INTO hbuserblogimg (pidofimg, hbUser_BlogImg) VALUES (:pidofimg, :hbUser_BlogImg)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'pidofimg'=>$pidofimg,
                'hbUser_BlogImg'=>$hbUser_BlogImg
            ]);
            return true;
        }
    }