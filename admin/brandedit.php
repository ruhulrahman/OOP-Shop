<?php include '../classes/Brand.php';?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script>window.lobrandion = 'brandlist.php';</script>";
    }else{
        $id = $_GET['brandid'];
    }

    $brand = new Brand();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $updatebrand = $brand->brandUpdate($brandName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit brandegory</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                               <?php
                                    if(isset($updatebrand)){
                                        echo $updatebrand;
                                    }
                               ?>
                        <?php
                            $getbrand = $brand->getbrandById($id);
                            while($result = $getbrand->fetch_assoc()){
                                $brandNm = $result['brandName'];
                            }                               
                        ?>
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $brandNm; ?>" placeholder="Enter brandegory Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>