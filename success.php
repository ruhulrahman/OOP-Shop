<?php include "inc/header.php"; ?>

<?php

	$login = Session::get("cmrLogin",true);
	if($login == false){
		header("Location: login.php");
	}

?>

<style>
  .psuccess{width: 500px; min-height: 200px; text-align: center; margin: 0 auto; padding: 50px; border: 1px solid #ddd;}
  .psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
</style>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="psuccess">
        <h2>Order Successfull</h2>
        <?php
          $cmrId = Session::get("cmrId");
          $amount = $ct->payableAmount($cmrId);

            $sum = 0;
          if($amount){
            while($result = $amount->fetch_assoc()){
              $price = $result['price'];
              $sum = $sum + $price;
            }
          }
        ?>
        <p style="color: red; border-bottom: 1px solid #ddd; margin-bottom: 10px; padding-bottom: 10px;">Total payable amount (including vat) : TK. <?php 
            $vatrat = 0.1;
            $vatTotal = $sum * $vatrat;
            $totalPrice = $sum + $vatTotal;
            echo $totalPrice;
        ?> </p>
        <p>Thanks for purchase. Your order successfully completed. We will contact with you as soon as possible with delivery details. Here is your order details ........ <a href="orderdetails.php">Visit Here......</a></p>
      </div>
    </div>
  </div>
</div>

<?php include "inc/footer.php"; ?>