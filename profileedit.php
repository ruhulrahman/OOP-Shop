<?php include "inc/header.php"; ?>

<?php

	$login = Session::get("cmrLogin",true);
	if($login == false){
		header("Location: login.php");
	}
	$id = Session::get("cmrId");
	$customerData = $cmr->getAllCustomerData($id);
?>
<style>
  .customerEdit{width: 500px; margin: 0 auto; border: 1px solid #ddd; padding: 10px 20px}
  .customerEdit h3{font-size: 30px; color: green; text-align: center; padding: 20px 0px; border-bottom: 1px solid #ddd;}
  .customerEdit table{}
  .customerEdit table tr{}
  .customerEdit table tr td{text-align: right}
  .submit{}
  .submit td{text-align: center;}
  .button{padding: 10px 30px;}
  .button:hover{color: white; background: gray;}
</style>
<div class="main">
  <div class="content">
  	<?php
  		
  		while($result = $customerData->fetch_assoc()){
        $id = $result['customerId'];
  			$name = $result['name'];
  			$city = $result['city'];
  			$zip = $result['zip'];
  			$email = $result['email'];
  			$address = $result['address'];
  			$country = $result['country'];
        $phone = $result['phone'];
  			$password = $result['password'];
  		}
  	?>


  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $updateCmr = $cmr->CustomerUpdate($_POST, $id);
    }
  ?>
    <div class="customerEdit">
			<h3>User Profile Edit</h3>
      <form action="" method="post">
        <table class="tblone">
            <tr>
              <td>Name</td>
              <td><input type="text" name="name" value="<?php echo $name;?>"/></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><input type="text" name="address" value="<?php echo $address;?>
              +"/></td>
            </tr>
            <tr>
              <td>City</td>
              <td><input type="text" name="city" value="<?php echo $city;?>"/></td>
            </tr>
            <tr>
              <td>Zip Code</td>
              <td><input type="text" name="zip" value="<?php echo $zip;?>"/></td>
            </tr>
            <tr>
              <td>Country</td>
              <td><input type="text" name="country" value="<?php echo $country;?>"/></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><input type="text" name="email" value="<?php echo $email;?>"/></td>
            </tr>
            <tr>
              <td>Phone</td>
              <td><input type="text" name="phone" value="<?php echo $phone;?>"/></td>
            </tr>
            <tr>
              <td>Change Password</td>
              <input type="hidden" name="password" value="<?php echo $password;?>" />
              <td><input type="text" name="password"/></td>
            </tr>
            <tr class="submit">
              <td colspan="2"><button class="button" name="update">Save</button></td>
            </tr>
        </table>
        <span><?php
                if(isset($updateCmr)){
                  echo $updateCmr;
                }
        ?></span>  
      </form>	
    </div>
 </div>
</div>

<?php include "inc/footer.php"; ?>