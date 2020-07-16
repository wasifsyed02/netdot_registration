<?php
define("rootpath",$_SERVER['DOCUMENT_ROOT']);
require (rootpath.'\assests\smtpmailer.php');
include('db.php');
            class verify_otp{
            
            public function  __construct()
            {   
                switch($_POST["function"])
                {
                  case "verify_otp":
                    $this->verify_otp();
                  break;
                  case "send_otp":
                    $this->send_otp();
                  break;
                }
                
            }
            public function verify_otp(){
                global $conn;
                $otp=mysqli_real_escape_string($conn,test_input($_POST["data"]));
                $email=mysqli_real_escape_string($conn,test_input($_POST["email"]));
                
                if(check_column("otp","users","email",$email,$otp))
                {   
                    $updateQuery="update users set verify=1  where email='$email'";
                    if(mysqli_query($conn,$updateQuery))
                        echo json_encode(array("type"=>"true","message"=>"your account hass been verified"));
                 }
                else
                    echo json_encode(array("type"=>"false","message"=>"your otp does not match in our server."));
                }
            // function for sending and inerting data into database;
                function  send_otp()
                {
                    global $conn;
                    $otp=rand(100000,999999);
                    $email=mysqli_real_escape_string($conn,$_POST["email"]);
                    $sqlquery="update users set otp=$otp where email='$email'";
                    if(mysqli_query($conn,$sqlquery))
                    {
                        if(send_otp_mail($email,$otp))
                        {
                            echo json_encode(array("type"=>"success","message"=>"OTP sent to your email."));
                        }
                        
                    }
                    else
                    echo json_encode(array("type"=>"error","message"=>"Sorry! some error occured  sending otp."));

                }

        };
        $runverify_otp=new verify_otp();
?>