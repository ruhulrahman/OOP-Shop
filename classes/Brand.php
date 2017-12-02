<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

Class Brand{
	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

		public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);

		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if(empty($brandName)){
			$msg = "<span class='error'>You have to fill this field to create brandegory list</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$result = $this->db->insert($query);
			if($result){
				return $msg = "<span class='success'>Brand inserted successfully</span>";
			}else{
				return $msg = "<span class='error'>Brand not inserted!</span>";
			}
		}
	}


	public function getAllbrand(){
		$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getbrandById($id){
		$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function brandUpdate($brandName, $id){
		$brandName = $this->fm->validation($brandName);

		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		$id = mysqli_real_escape_string($this->db->link, $id);
		
		if(empty($brandName)){
			$msg = "<span class='error'>You have to fill this field to create brandegory list</span>";
			return $msg;
		}else{
			$query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";
			$result = $this->db->update($query);
			if($result){
				return $msg = "<span class='success'>brandegory updated successfully</span>";
			}else{
				return $msg = "<span class='error'>brandegory not updated!</span>";
			}
		}
	}


	public function delbrandById($id){
		$query = "DELETE FROM tbl_brand WHERE brandId='$id'";
		$result = $this->db->delete($query);
		if($result){
			return $msg = "<span class='success'>brandegory deleted successfully</span>";
		}else{
			return $msg = "<span class='error'>brandegory not deleted!</span>";
		}
	}
}

?>