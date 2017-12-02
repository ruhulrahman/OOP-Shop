<?php include_once '../classes/Customer.php';?>
<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>

<?php
    if(!isset($_GET['customerId']) || $_GET['customerId'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $id = $_GET['customerId'];
    }

    $cmr = new Customer();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['CustomerName'];
        $updateCat = $cmr->CatUpdate($catName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Customer</h2>
               <div class="block copyblock"> 
                 <?php
                $getCustomerData = $cmr->getAllCustomerData($id);
                if($getCustomerData){
                    while($result = $getCustomerData->fetch_assoc()){ ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zip']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                     <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>