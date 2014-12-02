<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbConnection
 *
 * @author Mexico
*
 *  /
 * 
 */
//session_start();

class dbConnection {

    //put your code here
    //SSNC0lleg# [DB/username - unitev2, friendlyname;unitev2
    public function getConnection() {
        $mysql_host = "unitev2.db.8799516.hostedresource.com";
        $mysql_database = "unitev2";
        $mysql_user = "unitev2";
        $mysql_password = "SSNC0lleg#";
        //$con = mysqli_connect("localhost", "root", "", "alumnirt");
        $con=mysqli_connect($mysql_host, $mysql_user,$mysql_password,$mysql_database);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $con;
    }

    public function validateUser($username, $password) {
        
        $con = $this->getConnection();
        $username=  mysql_escape_string($username);
        $password=  mysql_escape_string($password);
        $sql="SELECT fname,rowid,username,role,verified FROM alumnireg where email='$username' and `password`=password('$password') and role <> 'Invalid' ";
       
       //     $sql="SELECT rowid,username,role FROM alumnireg where username='$username' and `password`=password('$password') and role <> 'Invalid'";
       
        $result = mysqli_query($con, $sql); //write the password validation

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if ($row = mysqli_fetch_array($result)) {
            if($this->getvalidateStatus()==0 ){
                if($row["verified"]==0)
                return "notverified";
            }
            session_start();
            $_SESSION["uid"] = $row['rowid'];

            $_SESSION["uname"] = ucfirst($row['fname']);
            $_SESSION["urole"] = $row['role'];
            mysqli_close($con);
            
            return $row['fname'];

        }
        else{
            mysqli_close($con);
            return "false";
            
        }
    }
    public function getvalidateStatus() {
        $con = $this->getConnection();
        $result = mysqli_query($con, "select flag from admin where feature = 'alow_nonvalidate'"); //write the password validation

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $flag=0;
        if ($row = mysqli_fetch_array($result)) {
          $flag=$row["flag"];
        }
         mysqli_close($con);
        return $flag;
       
    }

    public function validateOAUTH($email, $name, $provider, $profileurl = NULL) {

        /*if ($_SESSION["token"] == NULL)
            return;*/
        $con = $this->getConnection();
        $result = mysqli_query($con, "SELECT rowid,fname,username,role FROM alumnireg where email like '$email' and role <> 'Invalid'"); //write the password validation

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if ($row = mysqli_fetch_array($result)) {

            $_SESSION["uid"] = $row['rowid'];

            $_SESSION["uname"] = $row['fname'];
            $_SESSION["urole"] = $row['role'];
            movePage(301, "../../index.php");
            mysqli_close($con);
            return;
            //return $row['username'];
        }

        mysqli_close($con);
        movePage(301, "../../index.php?msg=invaliduser");
    }

    public function createaccount($email, $name, $provider, $password = NULL, $bool = 0) {

        $con = $this->getConnection();

        $result = mysqli_query($con, "SELECT rowid,username,role FROM alumnireg where email like '$email'"); //write the password validation

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if ($row = mysqli_fetch_array($result)) {

            $_SESSION["uid"] = $row['rowid'];

            $_SESSION["uname"] = $row['username'];
            $_SESSION["urole"] = $row['role'];
		if( $row['role']=="Invalid"){
			$sql = "update  alumnireg set role ='Pending' where email like '$email'";
            		$result = mysqli_query($con, $sql); //write the password validation
			if (!$result) {
				 mysqli_close($con);
               		 movePage(301, "../../index.php?msg=Please Check the verfication link Sent to you");
		               die('Invalid query: ' . mysql_error());
            		}
			 $_SESSION["urole"] = "Pending";

		}	
		 mysqli_close($con);
            movePage(301, "../../index.php?msg=Account Already Exist");
            //return $row['username'];
        } else {
            $sql = "insert into alumnireg (fname,username,regdate,email,oauth,verified,password,role) values ('$name','$email',now(),'$email','$provider',$bool,password('$password'),'Pending')";
            $result = mysqli_query($con, $sql); //write the password validation

            if (!$result) {
                movePage(301, "../../index.php?msg=Account was not Created");
                die('Invalid query: ' . mysql_error());
            }


            $_SESSION["uid"] = mysqli_insert_id($con);

            $_SESSION["uname"] = $name;
            $_SESSION["urole"] = "Pending";
		 mysqli_close($con);
            movePage(301, "../../index.php?msg=Account Created");
            //return $row['username'];
        }

        mysqli_close($con);
    }

    public function close($con) {
        mysqli_close($con);
    }

}

?>
