<?php

 require_once 'config.php';


    class Admin extends Database{

        public function registerhbAdmin( $hbAdmin_UserName, $hbAdmin_Password){
            $sql = "INSERT INTO hbadmin (hbAdmin_UserName, hbAdmin_Password) VALUES (:hbAdmin_UserName, :hbAdmin_Password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hbAdmin_UserName'=>$hbAdmin_UserName,
                'hbAdmin_Password'=>$hbAdmin_Password
            ]);
            return true;
        }
        public function AdminLog($hbAdmin_UserName, ){
            $sql = "SELECT hbAdmin_UserName, hbAdmin_Password FROM hbadmin WHERE hbAdmin_UserName = :hbAdmin_UserName ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'hbAdmin_UserName'=>$hbAdmin_UserName
            ]);
            $userFetch =$stmt->fetch(PDO::FETCH_ASSOC);
            return $userFetch;
        }

        public function validate_param($value){
            return (!empty($value));
        }

    }