<?php
include('conn.php');

session_start();
error_reporting(0);

$id = $_SESSION['id'];
?>

<?php
$lname = "";
if(isset($id))
{
  if( $id!="")
  {
     $err_lname="";$err_dob=$err_gender=$err_address=$err_pincode=$err= $err_country=$err_state=$err_city="";
    if(isset($_POST['submit']))
    {
          if(empty($_POST['lname']) || $_POST['lname']=='NA' )
          {
            $err_lname = "Last name is required";
          }
          elseif(empty($_POST['dob']))
          {
            $err_dob = "Date of birth is required";
          }
          elseif(empty($_POST['gender']))
           {
            $err_gender = "Gender is required";
          }
          elseif(empty($_POST['address']) || $_POST['address']=='NA' ) 
          {
            $err_address = "Address is required";
          }
          elseif(empty($_POST['pincode']) || $_POST['pincode']=='NA' || !is_numeric($_POST['pincode']) )
          {
            $err_pincode = "Pincode is required and should be numeric";
            //return false;
          }
          elseif (empty($_POST['country']) )
          {
            $err_country = "Country is required";
          }
           elseif (empty($_POST['state']) )
          {
            $err_state = "State is required";
          }
           elseif (empty($_POST['city']) )
          {
            $err_city = "City is required";
          }

        else
          {
          $name1 = $_POST['name'];
         // echo $name1;
          $email1 = $_POST['email'];
          $mob1 = $_POST['mobile'];
          $lname1 = $_POST['lname'];
          $dob1 = $_POST['dob'];
          $gender1 = $_POST['gender'];
          $address1 = $_POST['address'];
          $pincode1 = $_POST['pincode'];
          $country1 = $_POST['country'];
          $state1 = $_POST['state'];
          $city1 = $_POST['city'];

          $file=$_FILES["file"]["name"];

          $path="uploads/".$file;
          $tmp_name=$_FILES["file"]["tmp_name"]; 

          $extension = substr($file,strlen($file)-4,strlen($file));
          $allowed_extensions = array("jpg","png");  
         

            if($_FILES["file"]["size"] > 20789000)
             {
              
                 echo "<script>alert('File size should be less than 2mb');
                 window.location.href = 'update.php' </script>";
                 return false;
                
             }elseif(!in_array($extension,$allowed_extensions))
              {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');
               
               window.location.href = 'update.php' </script>";
                return false;

              }

            else{
               
                 $data=move_uploaded_file($tmp_name,$path);
                 }

               // if($data)
               //   {
               //  echo "File Uploaded..";
               //  }
                // else
                // {
                //   echo "File Not Uploaded";
                // }

        $up_query = "update signup SET name = '$name1',email = '$email1',mobile = '$mob1',last_name = '$lname1',dob = '$dob1',gender = '$gender1',address = '$address1',pincode = '$pincode1',country = '$country1',state = '$state1',city = '$city1',file = '$file' where id=$id" ;
             
            if (mysqli_query($conn, $up_query)) 
            {
                  $_SESSION['update'] = "Record updated successfully";
            } else 
            {
               echo "Error: " . $up_query . "<br>" . mysqli_error($conn);
            }
          }
   
     }
  }
}


$sql = "select * from signup where id = '$id'";
$row = mysqli_query($conn,$sql);
while($res = mysqli_fetch_assoc($row))
{
  $id = $res['id'];
  $name = $res['name'];
  $email = trim($res['email']);
  $mobile = $res['mobile'];
  $lname = $res['last_name'];
  $address = $res['address'];
  $dob2 = $res['dob'];
  $pincode = $res['pincode'];
  $country = $res['country'];
  $gender = $res['gender'];
  $file1 = $res['file'];
  $state = $res['state'];
  $city = $res['city'];
}
?>


<html>
  <head>
    <script src="jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

     <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
      .img 
      {
      float: right;
      }
      .error
      {
        color:red;
      }
      .change_op{
      opacity: 0.7;
    }
   </style>
   
  </head>

  <body style="background-color:#ffffb3;">
    <span class = img><?php echo "Hello $name";?></span><br><br>

     <div style = "float:right;">
       <a href = "login.php"><button type = "button">Logout</button></a>
    </div>
    <h4>

      
       <div style="color:green"><?php echo $_SESSION['update'];?></div>
      
        <?php
        unset($_SESSION['update']);
        ?>
    </h4>
   
    <h3><font color="black">Update Form</font></h3>
    <form action = "update.php" name = "myForm" method = "POST" enctype="multipart/form-data">

  <table>
    <tr>
      <td>Name</td>
      <td><input type = "text" name = "name" id = "name" value = "<?php echo $name;?>"></td>

    </tr>
    <tr>
      <td>Last Name</td>
      <td><input type = "text" name = "lname" id = "lname" value = "<?php 
      echo ($lname == NULL)?'NA':$lname;
      ?>">
       <span class="error"><?php echo $err_lname; ?></span>

      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type = "text" class = "change_op" name = "email" id = "email" value ="<?php echo $email;?>" readonly ></td>
    </tr>
    <tr>
      <td>Mobile</td>
      <td><input type = "text" class = "change_op" name = "mobile" id = "mobile" value = "<?php echo $mobile;?>" readonly></td>
    </tr>
   
     <tr>
        <td>DOB</td>
        <td>
          <input class="datepicker" type="text" id="dob" name="dob" size='9' value= "<?php echo $dob2;?>" />
           <span class="error"><?php echo $err_dob; ?></span>

        </td>

     </tr>
    
    <tr>
      <td>Gender</td>
      <td>Male<input type = "radio" name = "gender" value = "male" <?php echo ($gender=='Male')?'checked':''?>>
      Female<input type = "radio" name = "gender" value = "female" <?php echo  ($gender=='Female')?'checked':''?>>
       <span class="error"><?php echo $err_gender; ?></span>

      </td>
    </tr>
    <tr>
      <td>Address</td>
      <td><textarea name = "address"><?php echo ($address == NULL ? 'NA' : $address);?></textarea>
         <span class="error"><?php echo $err_address; ?></span>

      </td>
    </tr>
    <tr>
      <td>Pincode</td>
      <td><input type = "text" name = "pincode" maxlength = "6" value = "<?php echo ($pincode == 0 ? 'NA' : $pincode);?>">
      <span style="color:red"><?php echo $err_pincode;?></span>
      </td>
    </tr>
    <tr>

      <td>Country</td>
      <td> <select name="country" id="country">
      
                <option value="" >Select</option>
              
                <?php
                   
                     $query = "SELECT id,country_name FROM country";
                    
                     $run_query = mysqli_query($conn, $query);
               
                      $count = mysqli_num_rows($run_query);
                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($run_query))
                        {

                        
                            $country_id=$row['id'];
                           if($country == $country_id)
                              {
                                                          
                                 $selected = "selected='selected'";

                                                
                              }
                              else
                              {
                                 $selected = "";


                             }
                             //echo $selected;
                            
                        
                            $country_name=$row['country_name'];

                            echo "<option value='$country_id' $selected> $country_name</option>"; 

                         }
                     }
                       else
                       {
                             
                          echo '<option value="">Country not available</option>';
                       }
                ?>
            </select>
             <span class="error"><?php echo $err_country; ?></span>

            </td>
    </tr>
    <tr>
      <td>State</td>
      <td>
        <select name="state" id="state">
                <option value="" >Select</option>
               
                <?php
                 
                   //echo $state;
                    $sql1 = "select id,state_name from state ";
                    // echo $sql1;
                    $result1 = mysqli_query($conn,$sql1);
                    while($row2 = mysqli_fetch_assoc($result1))
                  
                     {
                      
                        $state1 = $row2['id'];
                        $st_name = $row2['state_name'];
                        
                        if($state == $state1)
                        {

                        $selected = "selected='selected'";
                    
                       }
                      else 
                        {
                        $selected="";
                        }?>
                        <option value="<?php echo $row2['id']; ?>" 
                        <?php echo $selected; ?> ><?php echo $row2['state_name']; ?></option>
                              <?php 
                     }
                ?>

        </select>
         <span class="error"><?php echo $err_state; ?></span>

      </td>
    </tr>
    <tr>
      <td>City</td>
      <td>
        <select name="city" id="city">
                <option value="">Select</option>

                <?php
                 
                   
                    $sql2 = "select id,city_name from city ";
                    // echo $sql1;
                    $result2 = mysqli_query($conn,$sql2);
                    while($row3 = mysqli_fetch_assoc($result2))
                  
                     {
                      
                        $city1 = $row3['id'];
                        $city_name = $row3['state_name'];
                        
                        if($city == $city1)
                        {

                        $selected = "selected='selected'";
                    
                       }
                      else 
                        {
                        $selected="";
                        }?>
                        <option value="<?php echo $row3['id']; ?>" 
                        <?php echo $selected; ?> ><?php echo $row3['city_name']; ?></option>
                              <?php 
                     }
                ?>
        </select>
         <span class="error"><?php echo $err_city; ?></span>

      </td>
    </tr>
     <tr>
      <td>Upload Image</td>
      <td>
       <?php 
       if($file1!="")
        //echo $new_id;
       {
         echo "<img height = '75' width = '75' src = 'http://localhost/project1/uploads/".$file1."'>
          <span>".$file1."</span>";?>
          <input type='file' name = "file" id = "file" accept=".pdf,.doc,.jpeg"/>
       <?php  }else
        {
         ?>
         <br><br>
         <input type='file' name = "file" id = "file" accept=".pdf,.doc,.jpeg"/>
         <span style = "color:blue"><?php echo "(Only .pdf and .doc type is allowed)";?></span>
        <?php 
        }
        ?>
      </td>
      <td>
        <!--img id="blah" src="#" alt="your image" /-->
      </td>
     </tr>
  </table><br><br>
     
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" name = "submit" value = "Update">
     
    </form>
  </body>

</html>

<?php
unset($_SESSION['update']);
?>


<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        //alert("hello");
        var countryID = $(this).val();
        //alert($(this).val());
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select  </option>');
            $('#city').html('<option value="">Select  </option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        //alert("hi");
       // alert(stateID)
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select </option>'); 
        }
    });
});


$(function(){
    $('.datepicker').datepicker()
})

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

</script>
