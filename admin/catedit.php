<?php include '../classes/Category.php';?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $id = $_GET['catid'];
    }

    $cat = new Category();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['categoryName'];
        $updateCat = $cat->CatUpdate($catName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                               <?php
                                    if(isset($updateCat)){
                                        echo $updateCat;
                                    }
                               ?>
                        <?php
                            $getCat = $cat->getCatById($id);
                            while($result = $getCat->fetch_assoc()){
                                $catNm = $result['catName'];
                            }                               
                        ?>
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="text" name="categoryName" value="<?php echo $catNm; ?>" placeholder="Enter Category Name..." class="medium" />
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