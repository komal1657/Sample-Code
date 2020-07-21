<?php 

include('conn.php');
session_start();
error_reporting(0);

 
if(isset($_POST['submit']))
{	
	
	$email = $_POST['email1'];

	$query1 = "select * from signup where email='$email'";
  	$qu = mysqli_query($conn,$query1);
 	$count=mysqli_num_rows($qu);
 	$row = mysqli_fetch_assoc($qu);
 	$name = $row['name'];


	
	 if($count==1)
	 {
		$str = base64_encode($email);
		//print_r($str);
		//echo "Dear $name , your forgot password link is:<a href = 'change_pass.php?verify=$str'>Change Password</a> ";

	
		$password = $row['password'];
		$to = $row['email'];
		$subject = "Your Recovered Password";
		 
		$message = "Please use this password to login " . $password?>
		<br>
		<?php echo "Your forgot password link is:<a href = 'change_pass.php?verify=$str'>Change Password</a> ";

		$headers = "From : l.komal@sparken.net";
		if(mail($to, $subject, $message, $headers)){
			echo "Your Password has been sent to your email id";
		}else{
			echo "Failed to Recover your password, try again";
		}

	}else{
		$chk_email = "Please enter valid Email Id";
		$_SESSION['email'] = $chk_email;
	}
}

?>

<?php 
	if(isset($_POST['cancel']))
	{
		header("location:login.php");
	}
?>

<html>
<head>

  <link href="css1.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


</head>
<body>
<div class="login-page">
 <h2 align="center">Forgot Password?</h2>
  <div class="form">
   
    <form class="login-form" action="" method = "POST">
    		
    			
    		
          <input type="text" placeholder="Email Id" name="email1"/>
          <h4><span style = "color:red" ><?php echo $_SESSION['email'];?></span></h4>
          <?php
    			unset($_SESSION['email']);
    		 ?>
      
      <button name = "submit" value = "submit">Submit</button><br><br>
      <button name = "cancel" value = "cancel">Back</button>
      
    </form>
  </div>
</div>
</body>
</html>


