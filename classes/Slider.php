<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

class Slider{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function SliderInsert($data, $file){
		$title = mysqli_real_escape_string($this->db->link, $data['title']);

		//for image
		$permited = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/slider/".$unique_image;

		if($title == "" || $file_name == ""){
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}else if($file_size > 1048567){
			return $msg = "<span class='error'>Image size should be less than 1MB</span>";
		}else if(in_array($file_ext, $permited) === false){
			return $msg = "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_slider(title, image) VALUES('$title','$uploaded_image')";
			$result = $this->db->insert($query);
			if($result){
				return $msg = "<span class='success'>Slider inserted successfully</span>";
			}else{
				return $msg = "<span class='error'>Slider not inserted!</span>";
			}
		}
	}


	public function getAllSlider(){
		//SQL query
		$query = "SELECT * FROM tbl_Slider ORDER BY sliderId DESC";		
		$result = $this->db->select($query);
		return $result;
	}

	public function getSliderById($id){
		$query = "SELECT * FROM tbl_Slider WHERE SliderId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function SliderUpdate($data, $file, $id){
		$title = mysqli_real_escape_string($this->db->link, $data['title']);

		//for image
		$permited = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/slider/".$unique_image;

		if($title == ""){
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}else{
			if(!empty($file_name)){
				if($file_size > 1048567){
					return $msg = "<span class='error'>Image size should be less than 1MB</span>";
				}else if(in_array($file_ext, $permited) === false){
					return $msg = "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";
				}else{
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_Slider SET title='$title', image='$uploaded_image' WHERE sliderId='$id'";
					$result = $this->db->update($query);
					if($result){
						return $msg = "<span class='success'>Slider updated successfully</span>";
					}else{
						return $msg = "<span class='error'>Slider not updated!</span>";
					}
				}
			}else{
				$query = "UPDATE tbl_Slider SET title='$title' WHERE sliderId='$id'";
				$result = $this->db->update($query);
				if($result){
					return $msg = "<span class='success'>Slider updated successfully</span>";
				}else{
					return $msg = "<span class='error'>Slider not updated!</span>";
				}
			}
		}
	}


	public function delSliderById($id){
		$query = "DELETE FROM tbl_slider WHERE sliderId='$id'";
		$result = $this->db->delete($query);
		if($result){
			return $msg = "<span class='success'>Slider deleted successfully</span>";
		}else{
			return $msg = "<span class='error'>Slider not deleted!</span>";
		}
	}
	
}