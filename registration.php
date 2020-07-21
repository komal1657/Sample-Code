<?php
	include('conn.php');
	session_start();
	error_reporting(0);
?>

<?php
$err_name="";$err_email=$err_mob=$err_pass=$err_re_pass=$err=$err_msg= "";
if(isset($_POST['submit']))
	{   
		$pass = $_POST['psw'];
		$re_pass = $_POST['psw-repeat'];

		if(empty($_POST["name"]))
		{
			$err_name = "Name is required";
		}
		elseif(empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$err_email = "Email ID is required and should be valid";
		}
		elseif(empty($_POST['mob'])|| !is_numeric($_POST['mob']))
		{
			$err_mob = "Mobile no is required and should be numeric";
		}
		elseif(empty($_POST['psw']))
		{
			$err_pass = "Password is required";
		}
		elseif(empty($_POST['psw-repeat']))
		{
			$err_re_pass = "Repeat password is required";
		}
		if($pass != $re_pass)
		{
			$err_pass_mismatch = "Password and Repeat password should be same";
			// $_SESSION['err_pass'] = "Password and Repeat password should be same";
			//  // $re_pass.focus();
			//  // return false;
			// echo "hello";
			// die;
		}
		

	if($err_name!="" || $err_email!="" || $err_mob!="" || $err_pass!="" || $err_re_pass!="" || $err_pass_mismatch!="")
	{
		$err = "All fields are mandetory";



	}else
	{
		$name = $_POST['name'];
		//print_r($name);
		$email = trim($_POST['email']);
		//print_r($email);
		$mobile = $_POST['mob'];
		$pass = $_POST['psw'];
		$re_pass = $_POST['psw-repeat'];


		$select = "select email from signup where email = '$email'";
		
		$sql = mysqli_query($conn,$select);
		$count=mysqli_num_rows($sql);
		
		if($count == 1)
		{
			$msg = "Record already exist";
			//echo $msg;
			$_SESSION['rec_msg'] = $msg;
			
		}
		// elseif($pass != $re_pass)
		// {
			
		// 	$_SESSION['err_pass'] = "Password and Repeat password should be same";
		// 	 // $re_pass.focus();
		// 	 // return false;
		// }
		else
		{
			$query = "insert into signup(name,email,mobile,password,re_password) values('$name','$email','$mobile','$pass','$re_pass')";
			$qu = mysqli_query($conn,$query);

			if($qu)
			{
				//echo "Data inserted successfully";
				header("location:login.php");
				$_SESSION['reg_success'] = "Registration Succesfull,To activate your account please check your email";
				
				//echo $_SESSION['reg_success'];
				
			}else
			{
				echo "Data not inserted";
			}
		}	

	}
 }


 if(isset($_POST['cancel']))
	{   
		header("location:login.php");
	}
?>

<html>
<head>
<style>
.error
{
  color:red;
}

</style>
  <link href="css1.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

</head>
<body>

<div class="login-page">
<h3 align="center">Registration Form</h3>
  <div class="form">
 
  	<h4><span style="color:red"><?php echo $err;?></span></h4>
 
    <form class=""  name = "form" id = "form" action = "" method="POST">
    
      
     	
      <input type="text" placeholder="Name" name="name" id = "name" value ="<?php echo isset($_POST["name"]) ? $_POST["name"] : "";?>"/>
      <span class="error"><?php echo $err_name; ?></span>

      <input type="text" placeholder="Email address" name="email"  id = "email"  value = "<?php echo isset($_POST["email"]) ? $_POST["email"] : "";?>" />	
      <span class="error"><?php echo $err_email; ?></span>
      <h4><div style = "color:red" ><?php echo $_SESSION['rec_msg'];?></div></h4>
     	<?php
     	unset($_SESSION['rec_msg']);
     ?>

      <input type="text" placeholder="Mobile no" name="mob" id = "mob" maxlength = "10" minlength = "10" value = "<?php echo isset($_POST['mob']) ? $_POST['mob'] : "";?>"/>	
      <span class="error"><?php echo $err_mob; ?></span>

	  <input type="password" placeholder="Password" name="psw" id="psw"/>
	  <span class="error"><?php echo $err_pass; ?></span>

      <input type="password" placeholder="Repeat password" name="psw-repeat" id = "psw-repeat"/>
      <span class="error"><?php echo $err_re_pass; ?></span>
      <h4><div style = "color:red"><?php echo $err_pass_mismatch;
      	//unset($_SESSION['err_pass']);
      ?></div></h4>
     

      <!--input type="submit" name = "submit" value="Register"-->
      <button type = "submit" name = "submit" value = "save">Register</button><br><br>
      <button type = "submit" name = "cancel" value = "cancel" >Back</button>
    </form>
  </div>
</div>
</body>
</html>



<script>

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});



// function confirmthepasswords($pass,$re_pass)
// {

//   $passwordOK = "";

//   if($pass == $re_pass)
//     {
//     $passwordOK = $pass;
//     }

//   return $passwordOK;
// }

// function checkEmail(str)
// {
//     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     if(!re.test(str))
//     alert("Please enter a valid email address");
// }

// $("#name").on("blur", function() {
// 				    if ( $(this).val().match('^[a-zA-Z]{3,16}$') ) {
// 				        alert( "Valid name" );
// 				    } else {
// 				        alert("That's not a name");
// 				    }
// 				});


// $("#mob").on("blur", function() {
// 				    if ( $(this).val().match('/^\d{10}$/') ) {
// 				        alert( "Valid mobile no." );
// 				    } else {
// 				        alert("That's not a mobile no.");
// 				    }
// 				});


      $(document).ready(function () {
    $("#form").validate({
         rules: {
            "name": {
                required: true,
                minlength: 3
            },
            "email": {
                required: true,
                email: true
              }
            "mob": {

                required: true,
                mob: true,
                maxlength:10
            }
        },
         messages: {
            "name": {
                required: "Please,enter name"
            },
            "email": {
                required: "Please, enter Email Id",
                email: "Enter valid Email Id"
             }
            "mob": {
                required: "Please, enter mobile no",
                
            }
        },
        submitHandler: function (form) { 
            alert('Form submitted'); 
            return false;
        }
    });

});

		
</script>

