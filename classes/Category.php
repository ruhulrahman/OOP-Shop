<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

class Category{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function CatInsert($catName){
		$catName = $this->fm->validation($catName);

		$catName = mysqli_real_escape_string($this->db->link, $catName);

		if(empty($catName)){
			$msg = "<span class='error'>You have to fill this field to create category list</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
			$result = $this->db->insert($query);
			if($result){
				return $msg = "<span class='success'>Category inserted successfully</span>";
			}else{
				return $msg = "<span class='error'>Category not inserted!</span>";
			}
		}
	}


	public function getAllCat(){
		$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCatById($id){
		$query = "SELECT * FROM tbl_category WHERE catId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function CatUpdate($catName, $id){
		$catName = $this->fm->validation($catName);

		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$id = mysqli_real_escape_string($this->db->link, $id);
		
		if(empty($catName)){
			$msg = "<span class='error'>You have to fill this field to create category list</span>";
			return $msg;
		}else{
			$query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
			$result = $this->db->update($query);
			if($result){
				return $msg = "<span class='success'>Category updated successfully</span>";
			}else{
				return $msg = "<span class='error'>Category not updated!</span>";
			}
		}
	}


	public function delCatById($id){
		$query = "DELETE FROM tbl_category WHERE catId='$id'";
		$result = $this->db->delete($query);
		if($result){
			header("catlist.php");
		}else{
			return $msg = "<span class='error'>Category not deleted!</span>";
		}
	}
	
}