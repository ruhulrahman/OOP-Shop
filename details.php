<?php include "inc/header.php"; ?>
<style>
	.mybutton{
		width: 40%;
		float: left;
	}
</style>

<?php

	if(isset($_GET['prodid'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['prodid']);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$addCart = $ct->addToCart($quantity, $id);
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
		$productId = $_POST['productId'];
		//$cmrId from header.php
		$inserCompare = $pd->insertProductData($cmrId, $productId);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
		$productId = $_POST['productId'];
		//$cmrId from header.php
		$inserwlist = $pd->insertWishList($cmrId, $productId);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$getPdBydId = $pd->getSingleProductById($id);
    			if($getPdBydId){
    				while($result = $getPdBydId->fetch_assoc()){ ?>

    		
				<div class="cont-desc span_1_of_2">

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?></h2>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>	
					<span style="color:red;">
			    		<?php
							if(isset($addCart)){
			    				echo $addCart;
			    			}
						?>
					</span>			
				</div>
				<div class="add-cart">
					<?php if($login == true){ ?>
					<div class="mybutton">
						<?php
							if(isset($inserCompare)){
								echo $inserCompare;
							}
						?>
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
							<input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
						</form>
					</div>	
					<?php } ?>

					<?php if($login == true){ ?>
					<div class="mybuttton">
						<?php
							if(isset($inserwlist)){
								echo $inserwlist;
							}
						?>
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
							<input type="submit" class="buysubmit" name="wishlist" value="Add to wishlist"/>
						</form>	
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['description'];?></p>
	    </div>
				
	</div>
	<?php } } ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>				      
				      <?php 
				      	$getCat = $cat->getAllCat();
				      	if($getCat){
				      		while($result = $getCat->fetch_assoc()){ ?>
				      	<li><a href="productbycat.php?catId=<?php echo $result['catId'];?>"><?php echo $result['catName'];?></a></li>	
				      <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>

	<?php include "inc/footer.php"; ?>