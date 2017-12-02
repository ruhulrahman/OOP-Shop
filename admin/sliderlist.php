<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../helpers/Format.php';?>
<?php include '../classes/Slider.php';?>

<?php
	$sdr = new Slider();
	$fm = new Format();


	if (isset($_GET['delSlider'])) {
		$id = $_GET['delSlider'];
		$delSlider = $sdr->delSliderById($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getsdr = $sdr->getAllSlider();
					if($getsdr){
						$i = 0;
						while ($result = $getsdr->fetch_assoc()) { 
							$i++;
				?>				
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['title'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"/></td>				
					<td>
						<a href="slideredit.php?sliderid=<?php echo $result['sliderId'];?>">Edit</a> || 
						<a onclick="return confirm('Are you sure to Delete!');" href="?delSlider=<?php echo $result['sliderId'];?>" >Delete</a> 
					</td>
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
