<?php 
session_start();
define("rootpath",$_SERVER['DOCUMENT_ROOT']);
include(rootpath.'\controllers\php\db.php');
$rootpath=rootpath;
if(isset($_SESSION['email']) && isset($_SESSION['password']))
{   
    if(login_registration($_SESSION['email'],$_SESSION['password']))
    {
        if(!check_column("verify","users","email",$_SESSION['email'],1))
            header("Location:/view/verify_account.php?email=".$_SESSION['email']);

    }
    else
        header("location:/signUp.html");
}
else
header("location:/signUp.html");
$row=fetchdata("users","email",$_SESSION['email']);
if(check_column("verify_det","users","email",$_SESSION['email'],1))
            {   
                $_SESSION["id"]=$row["id"];
                header("Location:/view/homepage.php");
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fill Up your Details...</title>
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
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <h1 class="text-center text-primary p-2"> Hi <?php echo $row["fname"]; ?></h1>
                    <h4 class="text-center text-danger">Fill Your details for Registration.</h4>
                    <form action="/controllers/php/fillup.php" method="POST" onsubmit="return check_status();" enctype="multipart/form-data">
                    <label for="parentage" class="pl-3"><strong>Course:</strong></label>
                    <div class="row px-3 pb-3 ">
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="course" id="course" placeholder="COURSE TO WHICH ADDMISSION IS SOUGHT." required>
                        </div>
                        </div>
                    <label for="parentage" class="pl-3"><strong>Parentage:</strong></label>
                    <div class="row px-3 pb-3 ">
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="fathername" id="fathername" placeholder="Your Father's Name" required>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="mothername" id="mothername" placeholder="Your Mothers's Name" required>
                        </div>
                    </div>
                        <label for="Perminentaddress" class="pl-3"><strong>Perminent Address:</strong></label>
                    <div class="row px-3 pb-3 ">
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="street_name" id="street_name" placeholder="Street name" required>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="Village" id="Village" placeholder="Village" required>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="Dristict_name" id="Dristict_name" placeholder="Dristict Name" required>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="pin" id="pin" placeholder="Pincode" required>
                        </div></div>

                        <div class="row px-3 pb-3 ">
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="Phonenumber" id="Phonenumber" placeholder="Your Phone Number" required>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="CellNumber" id="CellNumber" placeholder="Cell Number(optional)">
                        </div>
                    </div>
                    <label for="dob" class="pl-3"><strong>Date of Birth:</strong></label>
                    <div class="row px-3 pb-3">
                        <div class="col-md-4">
                            <input type="date"   class="form-control" name="dob" id="dob" required>
                        </div>
                   
                    </div>

                    <label for="dob" class="pl-3"><strong>Occupation(Tick the appropirate box)</strong></label>
                    <div class="row px-3 pb-3">
                        <div class="col-md-2">
                        <input type="radio" name="Occupation" id="govtemployee" value="govtemployee" required> Govt Employee
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="Occupation" id="Businessman"  value="Businessman" required> Business Man
                            </div>
                            <div class="col-md-2">
                            <input type="radio" name="Occupation" id="Student" value="Student" required> student
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="Occupation" id="exserviceman" value="exserviceman" required> Ex-Serviceman
                                </div>
                                <div class="col-md-2">
                                    <input type="radio" name="Occupation" id="housewife" value="housewife" required> House Wife
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="Occupation" id="housewife" value="other" required> other
                                        </div>
                    </div>
                    <label for="qualification" class="pl-3"><strong> Acadamic Qualification</strong></label>
                    <div class="row px-3 pb-3">
                        <div class="col-md-12">
                                <input type="hidden" name="count" id="count" value="0">
                                <table class="table table-responsive" id="qualification">
                                    <thead class="text-primary" >
                                        <th>Examination Passed</th>
                                        <th>Year of Passing</th>
                                        <th>rollno</th>
                                        <th>Name of Institute/University</th>
                                        <th>percentage</th>
                                    </thead>
                                    <tbody>
                                        <tr> <td><input type="text" class ="form-control" name="ExaminationPassed0" id="ExaminationPassed" required></td>
                                            <td><input type="text" class ="form-control" name="yearofPassing0" id="yearofPassing" required></td>
                                            <td><input type="text" class ="form-control" name="rollno0" id="rollno" required></td>
                                            <td><input type="text" class ="form-control" name="nameofinsttuniversity0" id="nameofinsttuniversity" required></td>
                                            <td><input type="text" class ="form-control" name="percentage0" id="percentage"  required></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                          
                           
                                   
                                
                            
                            </div>
                           
                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        <button class="btn btn-info btn-lg" id="add">
                                            <span class="glyphicon glyphicon-plus"></span> Add 
                                        </button>
                                    </div>  </div>

                                    <label for="qualification" class="pl-3"><strong> Your Form photo:</strong></label>
                                        <div class="row p-4">
                                            <div class="col-md-4">
                                                <input type="file"  id="form_photo" name="form_photo" required>
                                                <small id="error_form_photo" class="text-danger"></small>
                                              
                                            </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                            <div class="row p-4">
                                                <div class="col-md-4">
                                                    <input type="submit" class="btn btn-success px-5 py-2" name="fillup-submit" value="Submit" >
                                                    </div>
                                            </div></div>
                                           
                                            <input type="none"    style="display:none;" name="user_id" value="<?php echo $row['id'];?>"> 
                                        </form>
                                        
                                   
                      

                </div>
            </div>
           
    
            
            
      
    </div>
</div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        var img_bool=false;
        $(document).ready(function(){
            $("#add").on('click',function(){
               var  count=$("#count").val();
                count++;
                $("table tbody").append('<tr> <td><input type="text" class ="form-control" name="ExaminationPassed'+count+'" id="ExaminationPassed"  required></td><td><input type="text" class ="form-control" name="yearofPassing'+count+'" id="yearofPassing" required></td><td><input type="text" class ="form-control" name="rollno'+count+'" id="rollno" required></td><td><input type="text" class ="form-control" name="nameofinsttuniversity'+count+'" id="nameofinstt/university" required></td><td><input type="text" class ="form-control" name="percentage'+count+'" id="percentage" required></td></tr>');
                document.getElementById('count').value = count;
            });

            $('#form_photo').on('change', function() { 
               var  imagevalue=this.value;
               var imagesize=(this.files[0].size)/1024;
               var allowextentions= /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
               if (!allowextentions.exec(imagevalue)) { 
                $('#error_form_photo').text("Invalid! Only jpg,jpeg,png,gif are allowed"); 
                imagevalue.value = ''; 
                img_bool=false;
            }  
            else
            {
                if(imagesize>100)
                {
                    $('#error_form_photo').text("Size must be less  than 100kb"); 
                    img_bool=false;
                }
                else
                {
                    $('#error_form_photo').text(""); 
                    img_bool=true;
                }
            }
           
        }); 

        });
        var check_status=()=>
        {
            return img_bool;
        }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
