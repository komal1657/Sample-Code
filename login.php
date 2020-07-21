
<?php 
  include('conn.php');
  error_reporting(0);
  session_start();
 
//echo $_SESSION['reg_success'];


?>
<?php 
$err_email="";
if(isset($_POST['submit']))
{
 
  
  if(empty($_POST["email1"]) )
    {
      $err_email = "Email is required";
    }elseif(!filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL))
    {
      $err_email =  "Should be in proper format";
    }elseif(empty($_POST['pass1']))
    {
      $err_pass = "Password is required";
    }
    elseif(!empty($_POST["remember"]))
     {
        setcookie ("email1",$_POST["email1"],time()+ 3600);
        //setcookie ("pass1",$_POST["pass1"],time()+ 3600);
        echo "Cookies Set Successfully";
      }
    
  else
  {
    $email1 = $_POST['email1'];
    $pass1 = $_POST['pass1'];

    $query1 = "select id,email,password from signup where email='$email1' and password='$pass1'";
    //echo $query1;
    $qu1 = mysqli_query($conn,$query1);
    $result = mysqli_fetch_assoc($qu1);
    $count=mysqli_num_rows($qu1);
    $sess_id = $result['id'];
    
    $_SESSION['id'] = $sess_id;
    
 

      if($count==1)
      {
          header("Location:update.php");
       
      } else {
          $_SESSION['login_unsuccess'] = "Login Unsuccessful";
          $login_un =  $_SESSION['login_unsuccess'];
      }
    }
}



//  else {
//   setcookie("email1","");
//   setcookie("pass1","");
//   echo "Cookies Not Set";
// }
 
?>

<html>
    <head>
      <link href="css1.css" rel="stylesheet" type="text/css" media="all" />
      <style>
        .error
      {
        color:red;
      }
      </style>
    </head>

    <body>
      <div class="login-page">
      <h2 align="center">Login Form</h2>
        <div class="form">
         
          <form class="login-form" action="" method = "POST" name = "myForm">
          
          
            <div style = "color:red"><?php echo $login_un;?></div>
            
          
          <?php 

          if(isset($_SESSION['reg_success']))
                {?>
                    <h4><span style = "color:green"><?php echo $_SESSION['reg_success'];?></span></h4>

                    <?php
                    unset($_SESSION['reg_success']);
                }
           ?>
           
           
            <input type="text" placeholder="Email Id" name="email1"  value = "<?php if(isset($_COOKIE["email1"])) { echo $_COOKIE["email1"]; } ?>"  class="input-field" maxlength="255"  />      
            <span class="error"><?php echo $err_email; ?></span>

            <input type="password" placeholder="Password" name="pass1" id = "pass1" value="<?php if(isset($_COOKIE["pass1"])) { echo $_COOKIE["pass1"]; } ?>" class="input-field" />
             <span class="error"><?php echo $err_pass; ?></span>
             <table>
               <tr>
                <td>
                    <input type="checkbox" name="remember" /> 
                </td>
                <td>Remember me</td>
              </tr>
            </table>
            <button name = "submit" name = "submit" value = "submit">Login</button>

            <p class="message">Forgot Password? <a href="forgot_pass.php">Reset Password</a></p>
            <p class="message">Not registered? <a href="registration.php">Create an account</a></p>
          </form>
        </div>
      </div>
  </body>
</html>




<script>

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});



// function checkEmail(str)
// {
//     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     if(!re.test(str))


//     var message = "Please enter a valid email address";
// }


</script>
