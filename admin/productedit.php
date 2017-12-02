<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Product.php';?>
<?php
   $brand = new Brand();
   $cat = new Category();

   if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
       echo "<script>window.location = productlist.php;</script>";
   }else{
        $id = $_GET['productid'];
   }

    $pd = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        //All fields are getting by global variable $_POST and $_FILES
        $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">
        <?php
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>

        <?php
            $getProduct = $pd->getProductById($id);
            if($getProduct){
                while($value = $getProduct->fetch_assoc()){
        ?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName'];?>" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php
                                $getcat = $cat->getAllCat();
                                if($getcat){
                                    while($result = $getcat->fetch_assoc()){                                    
                            ?>
                            <option
                            <?php
                                if($value['catId'] == $result['catId']){ ?>
                                    selected = "selected";
                            <?php } ?>
                             value="<?php echo $result['catId'];?>"><?php echo $result['catName']; ?></option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">                        
                            <option>Select Brand</option>                      

                            <?php
                                $getbrand = $brand->getAllbrand();
                                if($getbrand){
                                    while($result = $getbrand->fetch_assoc()){                                    
                            ?>
                            <option
                                <?php
                                    if($value['brandId'] == $result['brandId']){ ?>
                                        selected = "selected";
                                <?php  } ?> value="<?php echo $result['brandId'];?>"><?php echo $result['brandName']; ?></option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="Description"><?php echo $value['description'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price'];?>" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width="70" height="70" src="<?php echo $value['image'];?>"></br>
                        <input type="file" name="image" /> 
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if($value['type'] == 0) {?>
                            <option value="0" selected="selected">Featured</option>
                            <option value="1">General</option>
                            <?php }else{ ?>
                            <option value="0">Featured</option>
                            <option value="1" selected="selected">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>               
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


