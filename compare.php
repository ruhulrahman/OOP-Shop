<?php include "inc/header.php"; ?>
<?php

	$login = Session::get("cmrLogin",true);
	if($login == false){
		header("Location: login.php");
	}
?>
<style>
	.tblone{}
	.tblone tr{}
	.tblone tr td{
		vertical-align: middle;
	}
	.tblone tr td img{
		width: 100px;
		height: 100px;
	}
</style>

<?php
	$getProduct = $pd->getComparePrduct($cmrId);
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th>SL.</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
							<?php
								if($getProduct){
									$i = 0;
									while($result = $getProduct->fetch_assoc()){ 
										$i++
							?>							
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>Tk. <?php echo $result['price'];?></td>
								<td><a href="details.php?prodid=<?php echo $result['productId'];?>">View</a></td>
							</tr>
	

							<?php } }else{
								echo "There is no Data Here.";
								} ?>
							
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?php include "inc/footer.php"; ?>