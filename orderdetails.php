<?php include "inc/header.php"; ?>
<?php
	$login = Session::get("cmrLogin",true);
	if($login == false){
		header("Location: login.php");
	}
?>
<?php
    if(isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
        $price = $_GET['price'];
        $time = $_GET['time'];

        $confirm = $ct->productShiftedConfirm($id, $price, $time);
    }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="orderPage">
    			<h1>Order Details Page</h1>
                <table class="tblone">
                            <tr>
                                <th>SL.</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php
                                $cmrId = Session::get("cmrId");
                                $getProduct = $ct->getOrderProduct($cmrId);
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
                                <td>Tk. <?php echo $result['quantity']; ?></td>
                                <td>Tk. <?php echo $total = $result['price'] * $result['quantity']; ?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td><?php 
                                    if($result['status'] == 0){
                                        echo "Pending";
                                    }else if($result['status'] == 1){
                                        echo "Shifted";
                                    }else{
                                        echo "Ok";
                                    }
                                ?></td>

                                <?php
                                    if($result['status'] == 1){ ?>                                
                                <td><a href=""><a href="?shiftid=<?php echo $result['customerId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Confirm</a></a></td>        
                                <?php }else if($result['status'] == 0){ ?>                                
                                <td>N/A</td>
                                <?php }else{ ?>
                                <td>Ok</td>
                                <?php    } ?>
                            </tr>
                            <?php } }else{
                                echo "You didn't order yet.";
                                } ?>
                            
                        </table>
    		</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?php include "inc/footer.php"; ?>