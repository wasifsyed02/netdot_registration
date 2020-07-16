<?php 
define("rootpath",$_SERVER['DOCUMENT_ROOT']);
include(rootpath.'\controllers\php\db.php');
$rootpath=rootpath;
if(isset($_GET['email']))
{   $email=$_GET["email"];
    if(fetch_table("email","users","email",$email))
    {
        if(!check_column("verify","users","email",$email,0))
            header("Location:/signUp.html");
    
    }
    else
        header("location:/index.html");
}
else
header("location:/signUp.html");
?>
<!DO
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css" class="rel">
    <!-- Font Icon -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
    <script src="/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
</head>
<body>
<div class="container">
        <div class="row mt-5">
  <div class="card col-md-5 offset-md-3" style="width: 30rem;" >
  <div class="card-body">
  <div class="alert alert-success" role="alert" id="msg-label">
  Your Account is created successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</div>
   
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Your Otp."  name="otp">
    <small id="respone_otp" class="text-danger"></small>
    </div>
    <div class="form-group">
    <div class="text-center"> 
    <input type="submit" class="btn btn-success text-center " value="verify" id="verify_otp" >    
    </div>  </div>  
    <div class="text-right">
    <small  class="text-primary" id="otp_again" style="cursor: pointer;" id=""> Didn't receive otp? Send opt Again.</small>    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
        $(document).ready(function()
        {
            $("#verify_otp").click(function(){
                var otp_input=$('input[name="otp"]');
                var input={data:otp_input.val(),function:"verify_otp",email:"<?php echo $_GET['email']; ?>"};
                $.ajax({
                    url:"/controllers/php/verify_otp.php",
                    data:input,
                    method:'post',
                     dataType:'json',
                    success:function(res)
                    {   
                        if(res.type=="true")
                           {
                               
                            window.location.replace("/signUp.html");
                           }
                        else  if(res.type=="false")
                            {
                                otp_input.addClass("is-invalid");
                                $("#respone_otp").html(res.message);
                               
                            }
                    }
                });
    
            });

            $("#otp_again").click(function(){
                var input={function:"send_otp",email:"<?php echo $_GET['email']; ?>"};
                  $.ajax({
                    url:"/controllers/php/verify_otp.php",
                    data:input,
                    method:'post',
                    dataType:'json',
                    beforeSend:function(){
                      $(".loading").css("display","block");
                    },

                    success:function(response)
                    {
                            if(response.type=="success")
                            {
                                $("#msg-label").html(response.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>');
                                $(".loading").css("display","none");
                            }
                    }
                  });
            });
        });
    </script>
</body>
</html>