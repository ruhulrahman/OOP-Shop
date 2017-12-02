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
  .payment{width: 500px; min-height: 200px; text-align: center; margin: 0 auto; padding: 50px; border: 1px solid #ddd;}
  .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
  .payment a{background: red; color: #FFF; padding: 15px; margin-top: 10px; border-radius: 5px;}
  .payment a:hover{background: green; color: #FFF; transition: 800ms;}
  .back{}
  .back a{margin: 0 auto; width: 150px; display: block; text-align: center; margin-top: 10px; border-radius: 5px; background: gray; padding: 10px 0px; color: white; border: 1px solid #888;}
</style>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="payment">
        <h2>Choose your payment option</h2>
        <a href="paymentonline.php">Online Payment</a>
        <a href="paymentoffline.php">Offline Payment</a>
      </div>
      <div class="back">
        <a href="cart.php">Previous</a>
      </div>
    </div>
  </div>
</div>

<?php include "inc/footer.php"; ?>