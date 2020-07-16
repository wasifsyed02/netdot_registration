<?php 
     session_start();
     define("rootpath",$_SERVER['DOCUMENT_ROOT']);
     include(rootpath.'\controllers\php\db.php');
    if(isset($_SESSION["email"]) &&  isset($_SESSION["password"]))
    {
        if(login_registration($_SESSION["email"],$_SESSION["password"]))
        {
            $row=fetchdata("users","email",$_SESSION["email"]);
            if($row["account_type"]!="admin")
            {
                $_SESSION["id"]=$row["id"];
                header("location:/view/homepage.php");
            }

        }
        else
        header("location:/signUp.html");
        

    }
    else
        header("location:/index.html");
    $result=fetchdata2("users","account_type","student","verify_det","1");
    $result2=fetchdataOrderby("user_details","user_id");
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css" class="rel">
    <!-- Font Icon -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
    <style>
        *
        {
            font-family: Quicksand;
        }
    </style>
</head>
<body>
        <div class="container">
        <div class="row mt-2">
            <div class="col-md-12">
            <h1 class="text-center"> <strong>Welcome to Admin Panel. </strong> </h1>
            </div>
           
        </div>
        
        <div class="row mt-2">
            <div class="col-md-12">
                <table class="table table-responsive-lg table-striped ">
                    <thead class="bg-primary text-white">
                        <th>Serial Number</th>
                        <th>Applicant Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Form Photo</th>
                        <th>print/view</th>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        while($row=$result->fetch_assoc())
                        {   $row2=$result2->fetch_assoc();
                            echo '<tr><td>'.$i.'</td><td>'.$row["fname"].'</td><td>'.$row2["phonenumber"].'</td><td>'.$row["email"].'</td><td><img src="data:image;base64,'.base64_encode($row2['form_photo']).'" style="width:100px; height:100px; border:2px solid black;" ></td><td><a href="admin-homepage.php?id='. $row["id"].'">view</td></tr>';
                            $i++;
                        }
        

                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        </div>
        
</body>
</html>