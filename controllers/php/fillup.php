<?php
include('db.php');
session_start();


    if(isset($_POST["fillup-submit"]))
 {  $flag;
    $userid=$_POST["user_id"];
    $course=$_POST["course"];
    $fatherName=$_POST["fathername"];
    $MotherName=$_POST["mothername"];
    $paddress='/'.$_POST["street_name"].'/'.$_POST["Village"].'/'.$_POST["Dristict_name"];
    $pincode=$_POST["pin"];
    $phonenumber=$_POST["Phonenumber"];
    $dob=$_POST["dob"];
    $occupation=$_POST["Occupation"];
    $form_photo =  file_get_contents($_FILES['form_photo']['tmp_name']);
    $count=$_POST["count"];
    for($i=0;$i<=$count;$i++)
    {
        $flag=inertQulification( $userid,$_POST["ExaminationPassed".$i],$_POST["yearofPassing".$i],$_POST["rollno".$i],$_POST["nameofinsttuniversity".$i],$_POST["percentage".$i]);
    }
    if(inertfillup($userid, $course, $fatherName,$MotherName, $paddress,$pincode,$phonenumber,$dob, $occupation, $form_photo) && $flag=true)
    {   echo "working";
         global $conn;
         $updateQuery="update users set verify_det=1  where id=$userid";
        if(mysqli_query($conn,$updateQuery))
        {   
            $_SESSION["id"]=$userid;
            header("location:/view/homepage.php");
        }
    }
}

function inertfillup($userid, $course, $fatherName,$MotherName, $paddress,$pincode,$phonenumber,$dob, $occupation, $form_photo)
{   global $conn;
    // preventing them from sql injection and cross side srcipting.
    $userid=mysqli_real_escape_string($conn,test_input($userid)); $course=mysqli_real_escape_string($conn,test_input($course));
    $fatherName=mysqli_real_escape_string($conn,test_input($fatherName)); $MotherName=mysqli_real_escape_string($conn,test_input($MotherName));
    $paddress=mysqli_real_escape_string($conn,test_input($paddress)); $pincode=mysqli_real_escape_string($conn,($pincode));
    $phonenumber=mysqli_real_escape_string($conn,test_input($phonenumber)); $dob=mysqli_real_escape_string($conn,$dob);
    $occupation=mysqli_real_escape_string($conn,test_input($occupation));
    //inerting data into table
    $statement=$conn->prepare("insert into user_details(user_id,course,fathersname,mothername,pincode,Perminent_Address,phonenumber,dob,occupation,form_photo) values(?,?,?,?,?,?,?,?,?,?)");
    $statement->bind_param("isssssssss",$userid, $course, $fatherName,$MotherName,$pincode,$paddress,$phonenumber,$dob, $occupation, $form_photo);
    if($statement->execute())
    return true;
    else 
    return false;

}
function inertQulification( $userid,$ExaminationPassed, $yearofPassing,$rollno,$nameofinstt_university,$percentage)
{   
    global $conn;
    /// preventing them from sql injection and cross side srcipting.
    $ExaminationPassed=mysqli_real_escape_string($conn,test_input($ExaminationPassed)); $yearofPassing=mysqli_real_escape_string($conn,test_input($yearofPassing));
    $nameofinstt_university=mysqli_real_escape_string($conn,test_input($nameofinstt_university)); $percentage=mysqli_real_escape_string($conn,test_input($percentage));
    $statement=$conn->prepare("insert into acadamic_qualification(user_id,Examination_Passed,Year_of_Passing,rollno,Name_of_Institute_University,percentage) values(?,?,?,?,?,?)");
    $statement->bind_param("isssss", $userid,$ExaminationPassed, $yearofPassing,$rollno,$nameofinstt_university,$percentage);
    if($statement->execute())
        $flag=true;
    else
    $flag=false;
    $statement->close();
    return $flag;
}
?>