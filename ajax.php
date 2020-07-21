
<?php
error_reporting(0);

include('conn.php');

if(isset($_POST["country_id"])){
    
	$country_id= $_POST['country_id'];
		
   $query = "SELECT id,state_name FROM state WHERE country_id = $country_id";
	$run_query = mysqli_query($conn, $query);
    
    $count = mysqli_num_rows($run_query);
   
    if($count > 0){
        echo '<option value="">Select </option>';
        while($row = mysqli_fetch_array($run_query)){
		$state_id=$row['id'];

                  
		$state_name=$row['state_name'];

        echo "<option value='$state_id' $selected>$state_name</option>";

        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"])){
	$state_id= $_POST['state_id'];
  
    $query = "SELECT id,city_name FROM city WHERE state_id = '$state_id'";
   // echo $query;
    $run_query = mysqli_query($conn, $query);
  
    $count = mysqli_num_rows($run_query);
    
  
    if($count > 0){
        echo '<option value="">Select</option>';
        while($row = mysqli_fetch_array($run_query)){
				//s$id = $row['id'];
        $city_id=$row['id'];
        //echo $city_id;
		$city_name=$row['city_name']; 
        echo "<option value='$city_id'>$city_name</option>";

        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>

