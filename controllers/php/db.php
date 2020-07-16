<?php 
//defining constatns for database;
define("servername","localhost");
define("dbname","netdot_registration");
define("username","root");
define("password","simnani123");
$conn=new mysqli(servername,username,password,dbname);
if($conn->connect_error)
{
    die("connection failed:". $conn->connect_error);
}
function check_column($item,$table_name,$column_name,$item_name,$item_value)
    {
       global $conn;
       $item_value=mysqli_real_escape_string($conn,$item_value);
        $item_name=mysqli_real_escape_string($conn,$item_name);
        $selectQuery="select $item from $table_name where $column_name ='$item_name'";
        $result=mysqli_query($conn,$selectQuery);
        if(mysqli_num_rows($result)>0)
        {
           while($row=mysqli_fetch_assoc($result))
           {
               if($row["$item"]==$item_value)
                return true;
                else
                return false;
           }
        }
       
    }
    function fetch_table($item,$table_name,$column_name,$item_name)
    {
       global $conn;
        $statement=$conn->prepare("select $item from $table_name where $column_name =?");
        $statement->bind_param("s",$item_name);
        $statement->execute();
        $result=$statement->get_result();
        if( $result->num_rows>0)
        {
            return true;
        }
        else
            return false;
    }
function registration_form($fname,$email,$password,$otp)
{  
    global $conn;
    $flag=false;
    $actype="student";
    $fname=mysqli_real_escape_string($conn,$fname);
    $email=mysqli_real_escape_string($conn,$email);
    $password=mysqli_real_escape_string($conn,$password);
    $otp=mysqli_real_escape_string($conn,$otp);
    $statement=$conn->prepare("insert into users(fname,email,PASSWORD,account_type,otp) values(?,?,?,?,?)");
    $statement->bind_param("sssss",$fname,$email,$password,$actype,$otp);
    if($statement->execute())
       $flag=true;
    $statement->close();
    $conn->close();
    return $flag;

}
function login_registration($email,$password)
{
    global $conn;
    $email=mysqli_real_escape_string($conn,$email);
    $password=mysqli_real_escape_string($conn,$password);
    $statement=$conn->prepare("select * from users where email=? and password=?");
    $statement->bind_param("ss",$email,$password);
    $statement->execute();
    $result=$statement->get_result();
    if($result->num_rows>0)
        return true;
    return false;
    $statement->close();
    $conn->close();
}
function fetchdata($table_name,$column_name,$item_name)
{
   global $conn;
    $statement=$conn->prepare("select * from $table_name where $column_name =?");
    $statement->bind_param("s",$item_name);
    $statement->execute();
    $result=$statement->get_result();
    if($result->num_rows>0)
    {
        $row=$result->fetch_assoc();
        return $row;
    }
}
function fetchdata2($table_name,$column_name,$item_name)
{
   global $conn;
    $statement=$conn->prepare("select * from $table_name where $column_name =? ");
    $statement->bind_param("s",$item_name);
    $statement->execute();
    $result=$statement->get_result();
    return $result;
}
function fetchdata3($table_name,$column_name,$item_name,$column_name2,$item_name2)
{
   global $conn;
    $statement=$conn->prepare("select * from $table_name where $column_name =? && $column_name2=?");
    $statement->bind_param("ss",$item_name,$item_name2);
    $statement->execute();
    $result=$statement->get_result();
    return $result;
}
function fetchdataOrderby($table_name,$column_name)
{
   global $conn;
    $statement=$conn->prepare("select * from $table_name order by $column_name ASC");
    $statement->execute();
    $result=$statement->get_result();
    return  $result;
}

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>