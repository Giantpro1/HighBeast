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

        public function loginHbUser($hBUser_UserInput){
            $sql = "SELECT hBUser_UserName, hBUser_Password FROM hbuser WHERE hBUser_UserName=:hBUser_UserInput";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hBUser_UserInput'=>$hBUser_UserInput
            ]);
            $userFetch =$stmt->fetch(PDO::FETCH_ASSOC);
            return $userFetch;
        }

                    // get result
        // public function getResult($hBUser_UserInput){
        //     $sql = "SELECT * FROM hbuser  WHERE hBUser_UserName=:hBUser_UserName";
        //     $stmt = $this->conn->prepare($sql);
        //     $stmt->execute([
        //         'hBUser_UserName'=>$hBUser_UserInput
        //     ]);
        //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //     return $result;
        // }
        public function getResult() {
            $val = $this->result;
           $this->conn->result = array();
            return $val;
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


            // save user info into google into my db
            
            public function saveUserFromGoogleInDb($google_id, $name, $email){
               $sql = "INSERT INTO hbuser (google_id, hBUser_UserName, hBUser_Email ) VALUES (:google_id, :name, :email)";
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([
                'google_id'=>$google_id,
                'hBUser_UserName'=>$name,
                'hBUser_Email'=>$email
               ]);
               return true;
            }

    }