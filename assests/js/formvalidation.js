var flag=false;
$(document).ready(function(){
    //validation for register form
    $("#register-form").submit(function(){
        checkform();
        let fname,email,password,passbool =true,emailbool=true,namebool=true;
        fname=$("#fname");
        email=$("#email");
        password=$("#password");
        confirmpassword=$("#confirmpass");
        namebool=IsEmpty(fname); emailbool=validateEmail(email); passbool=validate_password(password,confirmpassword);


        // checking wheather form is proper validated or not.
           if(passbool==true && emailbool==true && namebool==true)
           {
            flag=true;
           }

    });
    //validation for login form
    $("#login-form").submit(function(){
            let email,password,boolemail=true,boolpassword=true;
            email=$("#email");
            password=$("#password");
            booleamil=IsEmpty(email); boolpassword=IsEmpty(password);
            if(boolemail == true && boolpassword == true)
            {
                    flag=true;
            }
    });
});


//cheking wheather the field is empty or not.
let IsEmpty=(input)=>
{  
    var value=$.trim($(input).val());
    var plcholder=$(input).attr("placeholder");
    var id=$(input).attr("id");
    if(value =="" || value == null)
    {
        $("#error_"+id).html(plcholder+" can't be Empty");
        return false;
    }
    else
    {
        $("#error_"+id).html("");
        return true;
    }
}

//validating the email
let validateEmail=(input)=>
{
    var validationemail= /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var attribute=input.attr("id");
    var value=input.val();
    if(IsEmpty(input)){
    if(!validationemail.test(value))
    {
        $("#error_"+attribute).html("your email id is not valid ");
        return false;
    }
        else   
        {
             $("#error_"+attribute).html("");
             return true;

        }
    }
    else
        return false;
}

// validating both the passwords
let validate_password=(pass,conpass)=>
{   var attribute=conpass.attr("id");
       
        if(!IsEmpty(pass))
        {
        $("#error_"+attribute).html("Please enter your password first.");
        return false;
    }
    else
    {
        if(pass.val()!=conpass.val())
        {
            $("#error_"+attribute).html("Passwords don't match.");
            return false;
        }
        else
        {
            $("#error_"+attribute).html("");
           return true;
        }
    }
        
}

const checkform=()=>
{
    return flag;
}
