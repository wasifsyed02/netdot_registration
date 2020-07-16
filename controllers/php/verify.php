<?php
session_start();
define("rootpath",$_SERVER['DOCUMENT_ROOT']);
require (rootpath.'\assests\smtpmailer.php');
include('db.php');
if(isset($_POST["login-form"]))
{ 
     $error=array();
    $email=test_input($_POST["email"]);
    $password=test_input($_POST["password"]);
    if(empty($email) or empty($password))
    {
        header("location:/signUpx.html");
        arrar_push($error,"email or password is empty");
    }
    else
    {
        if(login_registration($email,$password))
        {   
            $row=fetchdata("users","email",$email);
            $_SESSION["email"]=$email;
            $_SESSION["password"]=$password;
            if($row["account_type"]=="admin")
                header("location:/admin/admin-panel.php");
           else
            header("location:/view/yourdetails.php");
           
           
        }
        else
        {
            header("location:/signUp.html");
            arrar_push($error,"Email or password is not valid");
        }
    }
    

}

if(isset($_POST["register-form"]))
{   echo "working";
    $flag=true;
    $fname=$_POST["fname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $conpassword=$_POST["confirmpass"];
    if(empty(test_input($fname)))
    {
        $array[]="fname is empty";
        $flag=false;
    }
    if(empty(test_input($email)))
    {
        $array[]="email is empty";
        $flag=false;
    }
    if(empty(test_input($password)))
    {
        $array[]="password is empty";
        $flag=false;
    }
    if(empty(test_input($conpassword)))
    {
        $array[]="Confirm password is empty";
        $flag=false;
    }
    if($password!=$conpassword)
    {
        $array[]="Both the passwords are not same is empty";
        $flag=false;
    }
    if(!empty(test_input($email))){
            if(!email_validation(test_input($email)))
                {
                     $array[]="Your email is not valid";
                     $flag=false;
                }
    }
    if($flag==true)
    {    $otp=rand(100000,999999);  
        if(registration_form($fname,$email,$password,$otp))
        {   
            if(send_otp_mail($email,$otp))
            {
                $_SESSION["email"]=$email;
                header('location:/view/verify_account.php?email='.$email);
            }
            
        }
    }
}



  function email_validation($str) { 
    return (!preg_match( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) ? FALSE : TRUE; 
    } 
?>