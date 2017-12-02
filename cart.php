<?php include "inc/header.php"; ?>

<?php
	if(isset($_GET['delProductId'])){
		$id = $_GET['delProductId'];
		$delProduct = $ct->delProductById($id);
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$catUpdate = $ct->UpdateCart($quantity, $cartId);
	}

	$sum = 0;
	$vat = 0;
	$grandTotal	= 0;

	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0; URL=?id=LBW' />";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    		<span style="color: green">
			    			<?php
			    				if(isset($catUpdate)){
			    					//echo "Product Updated Successfully";
			    					header("Location:cart.php");
			    				}
			    			?>
			    		</span>
						<table class="tblone">
							<tr>
								<th width="5%">SL.</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
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
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>Tk. <?php echo $result['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>Tk. <?php echo $total = $result['price'] * $result['quantity']; ?></td>
								<td><a href="?delProductId=<?php echo $result['cartId'];?>">X</a></td>
							</tr>
							<?php
								$sum = $sum + $total;
								$qty = $qty + $result['quantity'];
								

								Session::set("qty", $qty);
								Session::set("sum", $sum);
								$vatRate = 0.1; //10% vat
								$vat = $sum * $vatRate;
								$grandTotal = $sum + $vat;
							?>

							<?php } } ?>
							
						</table>
						<?php
							$getData= $ct->checkCartTable();
							if($getData){
						?>

						<table style="float:right;text-align:left;" width="45%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. <?php echo $sum;?></td>
							</tr>
							<tr>
								<th>VAT (10%): </th>
								<td>TK. <?php echo round($vat);?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php echo round($grandTotal);?></td>
							</tr>
					   </table>
					   <?php }else{
					   			//echo "Cart empty! Please shop now.";
					   			header("Location:index.php");
					   	} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?php include "inc/footer.php"; ?>