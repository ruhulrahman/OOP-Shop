<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/Slider.php';

    if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    	echo '<script>window.location = siderlist.php;</script>';
    }else{
    	$id = $_GET['sliderid'];
    }

    $sdr = new Slider();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        //All fields are getting by global variable $_POST and $_FILES
        $updateSlider = $sdr->SliderUpdate($_POST, $_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
    <div class="block">
         <?php
            if(isset($updateSlider)){
                echo $updateSlider;
            }


            $getSlider = $sdr->getSliderById($id);
            if ($getSlider) {
            	while ($result = $getSlider->fetch_assoc()) { ?>
            		
                      
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $result['title'];?>" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    	<img src="<?php echo $result['image'];?>" width="50" height="50" /></br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
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