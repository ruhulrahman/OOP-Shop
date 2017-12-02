<?php include_once "inc/header.php"; ?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      		<?php $getBrandpd = $pd->getAcerProduct();
	      			if($getBrandpd){
	      				while($result = $getBrandpd->fetch_assoc()){ ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['productName'];?></h2>
					 <p><?php echo $result['description'];?></p>
					 <p><span class="price">TK. <?php echo $result['price'];?></span></p>
				     <div class="button"><span><a href="details.php?prodid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Samsung</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
					$getProd = $pd->getSamsungProduct();
					if($getProd){
						while($result = $getProd->fetch_assoc()){ ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['productName'];?></h2>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>				    
				     <div class="button"><span><a href="details.php?prodid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
	<div class="content_bottom">
    		<div class="heading">
    		<h3>Canon</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
					$getProd = $pd->getCanonProduct();
					if($getProd){
						while($result = $getProd->fetch_assoc()){ ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['productName'];?></h2>
					 <p><span class="price">$<?php echo $result['price'];?></span></p>				    
				     <div class="button"><span><a href="details.php?prodid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
    </div>
 </div>
</div>


<?php include "inc/footer.php"; ?>