<?php
    session_start();
    define("rootpath",$_SERVER['DOCUMENT_ROOT']);
    include(rootpath.'\controllers\php\db.php');
    if(!isset($_SESSION["id"]))
        header("location:/signUp.html");
        $row_user=fetchdata("users","id",$_SESSION["id"]);
        $row_user_details=fetchdata("user_details","user_id",$_SESSION["id"]);
        $result=fetchdata2("acadamic_qualification","user_id",$_SESSION["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage of netdot.</title>
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
        .logo
        {
            font-size:4em;
             -webkit-text-stroke: 1px black;
             -webkit-text-stroke:skyblue;
        }
        .gradient
        {
            background:linear-gradient(90deg,white, #007bff);
            color:black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-3">
           <div class="col-md-12">
           <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"> <img src="/images/logo.png" style="width:250px; height:200;"></div>
                        <div class="col-md-7 mt-4">
                            <h1 class="text-primary text-center logo" ><strong>netdot</strong> </h1>
                            <h3 class=" text-primary text-center"> institute of information technology.</h3>
                            <h5 class="text-danger text-center"> CHARAR-I-SHARIEF KASHMIR 191112</h5>
                            <h5 class="text-center">Email:ndiit.chsh@gmail.com|ph:0951-253297|ph:+919906693418|</h5>
                        </div>
                   
                </div>
                

                <div class="row mt-4 px-3">
                    <div class="col-md-9">
                    <h6 class="text-danger text-left py-3">Addmission No: <?php echo test_input($row_user['id']); ?></h6>
                        <h5 class="text-left gradient px-2 py-1 ">I. COURSE TO WHICH ADDMISSION IS SOUGHT:</h5>

                        <h5 class="text-left "> Course Name:   <?php echo test_input(strtoupper($row_user_details['course'])); ?>  </h5> 
                        
                        <h5 class="text-left px-2 py-1 gradient">II. NAME OF THE CANIDATE: </h5> 
                        <h5 class="text-left "> <strong> Student Name:  </strong>  <?php echo test_input(strtoupper($row_user['fname'])); ?>  </h5> 
                    </div>
                    <div class="col-md-3">
                        <?php echo '<img src="data:image;base64,'.base64_encode($row_user_details['form_photo']).'" style="width:200px; height:200px; border:2px solid black;" >'; ?>
                    </div>
                </div>
                <div class="row mt-4 px-3">
                    <div class="col-md-12">
                    <h5 class="text-left gradient px-2 py-1">  III. Parentage:   <b class="text-primary">    </b></h5> 
                    <h5 class="text-left "> <strong> Father Name:  </strong>  <?php echo test_input(strtoupper($row_user_details['fathersname'])); ?>  </h5> 
                    <h5 class="text-left "> <strong> Mother Name:  </strong>  <?php echo test_input(strtoupper($row_user_details['mothername'])); ?>  </h5> 
                </div> </div>
                <div class="row mt-4 px-3">
                    <div class="col-md-12">
                    <h5 class="text-left gradient px-2 py-1"> IV. Permanent Address:  <b class="text-primary">    </b></h5> 
                    <h5 class="text-left "> <strong> (street,village,distric):  </strong>  <?php echo test_input(strtoupper($row_user_details['Perminent_Address'])); ?>  </h5> 
                    <h5 class="text-left "> <strong> Pincode:  </strong>  <?php echo test_input(strtoupper($row_user_details['pincode'])); ?>  </h5>
                    <h5 class="text-left "> <strong> Phone Number:  </strong>  <?php echo test_input(strtoupper($row_user_details['phonenumber'])); ?>  </h5> 
                    <h5 class="text-left "> <strong> Email:  </strong>  <?php echo test_input(strtoupper($row_user['email'])); ?>  </h5> 
                </div> </div>

                <div class="row mt-4 px-3">
                    <div class="col-md-12">
                    <h5 class="text-left gradient px-2 py-1">  V. DATE OF BIRTH: <b class="text-primary">    </b></h5> 
                    <h5 class="text-left "> <strong> Dob:  </strong>  <?php echo test_input(strtoupper($row_user_details['dob'])); ?>  </h5> 
                    
                </div> </div>
                <div class="row mt-4 px-3">
                    <div class="col-md-12">
                    <h5 class="text-left gradient px-2 py-1">  VI. Occupation:   <b class="text-primary">    </b></h5> 
                    <h5 class="text-left "> <strong> Occupation:  </strong>  <?php echo test_input(strtoupper($row_user_details['occupation'])); ?>  </h5> 
                    
                </div> </div>
                <div class="row mt-4 px-3">
                    <div class="col-md-12">
                    <h5 class="text-left gradient px-2 py-1">  VII. ACADAMIC QUALIFICATION :   <b class="text-primary">    </b></h5> 
                    <table class="table table-bordered table-striped  table-responsive-lg ">
                        <thead class="thead-white">
                            <tr>
                                <th>Serial Number</th>
                                <th>EXAMINATION PASSED</th>
                                <th>YEAR OF PASSING</th>
                                <th>ROLL NO</th>
                                <th>NAME OF INST/UNIVERSITY</th>
                                <th>PERCENTAGE</th>
                            </tr>
                            <tbody>
                            <?php 
                            $i=1;
                            while($row_user_ac=$result->fetch_assoc())
                            {
                                echo '<tr><td>'.$i.'</td><td>'.$row_user_ac["Examination_Passed"].'</td><td>'.$row_user_ac["Year_of_Passing"].'</td><td>'.$row_user_ac["rollno"].'</td><td>'.$row_user_ac["Name_of_Institute_University"].'</td><td>'.$row_user_ac["percentage"].'</td></tr>';
                                $i++;
                            }?>
                            </tbody>
                        </thead>
                    </table>
                    
                </div> </div>
                <div class="row mt-3">
                   
                    <div class="col-md-3 offset-md-5">
                        <button class="btn btn-success px-4 d-print-none" onclick="window.print();return false;">Print</button>
                        <button class="btn btn-primary px-4  d-print-none">Edit</button>
                    </div>   </div>
                    
                   
                    <div class="row d-none d-print-block">
                        <div class="col-md-12">
                        <h5 class="text-left text-black  px-2 py-1">  VIII. :Other information   <b class="text-primary">    </b></h5> 
                        </div>
                    </div>


            </div>
           </div>
        </div>
    </div>
</body>
</html>