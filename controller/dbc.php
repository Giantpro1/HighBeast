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
    }