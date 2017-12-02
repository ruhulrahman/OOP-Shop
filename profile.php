<?php include "inc/header.php"; ?>

<?php

	$login = Session::get("cmrLogin",true);
	if($login == false){
		header("Location: login.php");
	}
	$id = Session::get("cmrId");
	$customerData = $cmr->getAllCustomerData($id);
?>

 <div class="main">
    <div class="content">
    	<?php
    		
    		while($result = $customerData->fetch_assoc()){
    			$name = $result['name'];
    			$city = $result['city'];
    			$zip = $result['zip'];
    			$email = $result['email'];
    			$address = $result['address'];
    			$country = $result['country'];
    			$phone = $result['phone'];
    		}
    	?>
    	<div class="support">
  			<div class="support_desc">
  				<h3>User Profile</h3>
  				<h3>Name: <?php echo $name; ?></h3>
  				
				<h2>Adress: <?php echo $address; ?></h2>
				<h2>City: <?php echo $city; ?></h2>
				<h2>Zip Code: <?php echo $zip; ?></h2>
				<h2>Country: <?php echo $country; ?></h2>
				<h2>Email: <?php echo $email; ?></h2>
				<h2>Phone: <?php echo $phone; ?></h2>
  				
  				<p></p>
  			</div>
  				<img src="images/contact.png" alt="" />
          <a href="profileedit.php" title="">Edit profile</a>
  			<div class="clear"></div>
  		</div>   	
    </div>
 </div>
</div>

<?php include "inc/footer.php"; ?>