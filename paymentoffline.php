<?php include "inc/header.php"; ?>

<?php

  $login = Session::get("cmrLogin",true);
  if($login == false){
    header("Location: login.php");
  }

  $id = Session::get("cmrId");
  $customerData = $cmr->getAllCustomerData($id);
?>
<?php

  if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
    $customerId = Session::get("cmrId");
    $Orderinsert = $ct->orderProduct($customerId);
    $delData = $ct->delCustomerCart();
    header("Location: success.php");
  }else{
    
  }
?>
<style>
  .division{width: 49.5%; float: left; display: block;}
  .division h3{text-align: center; font-size: 30px; color: orange;}
  .tblone{width: 500px; border: 1px solid #ddd;}
  .tbltwo{}
  .tbltwo tr td{text-align:right; border: 1px solid #ddd;}
  .tblUserProfile tr td{text-align: left;color: green}
  .orderB{text-align: center;}
  .orderB a{background:red;color: white; padding: 15px 30px; border-radius: 5px;}
</style>
<div class="main">
  <div class="content">
    <div class="section group">
      <div class="division">

              </span>
            <table class="tblone">
              <tr>
                <th>SL.</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>

              <?php
                $getProduct = $ct->getCartProduct();
                if($getProduct){
                  $i = 0;
                  $qty = 0;
                  $sum = 0;
                  while($result = $getProduct->fetch_assoc()){ 
                    $i++
              ?>              
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['productName'];?></td>
                <td>Tk. <?php echo $result['price'];?></td>
                <td><?php echo $result['quantity'];?></td>
                <td>Tk. <?php echo $total = $result['price'] * $result['quantity']; ?></td>
              </tr>
              <?php
                $sum = $sum + $total;
                $qty = $qty + $result['quantity'];
                $vatRate = 0.1; //10% vat
                $vat = $sum * $vatRate;
                $grandTotal = $sum + $vat;
              ?>

              <?php } } ?>
              
            </table>

            <table class="tblone tbltwo">
              <tr>
                <th>Sub Total : </th>
                <td>TK. <?php echo $sum;?></td>
              </tr>
              <tr>
                <th>VAT 10% : </th>
                <td>TK. <?php echo round($vat);?></td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>TK. <?php echo round($grandTotal);?></td>
              </tr>
             </table>
      </div>
      <div class="division">
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

            <h3>User Profile</h3>
            <table class="tblone tblUserProfile">
              <tr>
                <td>Name</td>
                <td>:</td>
                <td><?php echo $name; ?></td>
              </tr>
              <tr>
                <td>Adress</td>
                <td>:</td>
                <td><?php echo $address; ?></td>
              </tr>
              <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $city; ?></td>
              </tr>
              <tr>
                <td>Zip Code</td>
                <td>:</td>
                <td><?php echo $zip; ?></td>
              </tr>
              <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $country; ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $email; ?></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $phone; ?></td>
              </tr>
              <tr>
                <td colspan="3"><a href="profileedit.php">Update Details</a></td>
              </tr>
            </table>
      </div>
      <div class="orderB"><a href="?orderid=order">Order Now</a></div>
    </div>
 </div>
</div>

<?php include "inc/footer.php"; ?>