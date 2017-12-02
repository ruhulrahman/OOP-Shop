<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Cart.php';?>
<?php include_once '../helpers/Format.php';?>
<?php
	$ct = new Cart();
	$fm = new Format();
?>

<?php
	//Product Shitted
	if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$price = $_GET['price'];
		$time = $_GET['time'];

		$shift = $ct->productShifted($id, $price, $time);
	}

	//Product Deleted
	if(isset($_GET['delprodid'])){
		$id = $_GET['delprodid'];
		$price = $_GET['price'];
		$time = $_GET['time'];

		$delOrder = $ct->delProductShifted($id, $price, $time);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">
                	<?php 
	                	if(isset($shift)){
	                		echo $shift;
	                	} 

	                	if(isset($delOrder)){
	                		echo $delOrder;
	                	}
                	?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL.</th>
							<th>Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Image</th>
							<th>Address</th>
							<th>Customer ID</th>
							<th>Order Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getPro = $ct->getOrderAllProduct();
							if($getPro){
								$i = 0;
								while($result = $getPro->fetch_assoc()){ 
									$i++;
							?>						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['productName'];?></td>
							<td>TK.<?php echo $result['price'];?></td>
							<td><?php echo $result['quantity'];?></td>
							<td><img src="<?php echo $result['image'];?>" width="70" height="70" alt=""></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId'];?>">View Details</a></td>
							<td><?php echo $result['customerId'];?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<?php if($result['status'] == 0){ ?>
								<td><a href="?shiftid=<?php echo $result['customerId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Sifted</a></td>
							<?php }else{ ?>
								<td><a href="?delprodid=<?php echo $result['customerId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Remove</a></td>
							<?php } ?>
						</tr>
						<?php }	} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
