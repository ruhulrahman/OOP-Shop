<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

class Product{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function ProductInsert($data, $file){
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$Description = mysqli_real_escape_string($this->db->link, $data['Description']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		//for image
		$permited = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if($productName == "" || $catId == "" || $brandId == "" || $Description == "" || $price == "" || $file_name == "" || $type == ""){
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}else if($file_size > 1048567){
			return $msg = "<span class='error'>Image size should be less than 1MB</span>";
		}else if(in_array($file_ext, $permited) === false){
			return $msg = "<span class='error'>You can upload only:-".implode(', ',$permited)."</span>";
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(productName, catId, brandId, description, price, image, type) VALUES('$productName','$catId','$brandId','$Description','$price','$uploaded_image','$type')";
			$result = $this->db->insert($query);
			if($result){
				return $msg = "<span class='success'>Product inserted successfully</span>";
			}else{
				return $msg = "<span class='error'>Product not inserted!</span>";
			}
		}
	}


	public function getAllProduct(){
		//SQL query
		
		// $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
		// 		FROM tbl_product
		// 		INNER JOIN tbl_category
		// 		ON tbl_product.catId = tbl_category.catId
		// 		INNER JOIN tbl_brand
		// 		ON tbl_product.brandId = tbl_brand.brandId
		// 		ORDER BY tbl_product.productId DESC";
				

		//SQL query using Alias
		$query = "SELECT p.*, c.catName, b.brandName
				FROM tbl_product as p, tbl_category as c, tbl_brand as b
				WHERE p.catId = c.catId AND p.brandId = b.brandId
				ORDER BY p.productId DESC";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function getProductById($id){
		$query = "SELECT * FROM tbl_product WHERE productId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function productUpdate($data, $file, $id){
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$description = mysqli_real_escape_string($this->db->link, $data['Description']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		//for image
		$permited = array('jpg','jpeg','png','gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if($productName == "" || $catId == "" || $brandId == "" || $description == "" || $price == "" || $type == ""){
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
					$query = "UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', description='$description', price='$price', image='$uploaded_image', type='$type' WHERE productId='$id'";
					$result = $this->db->update($query);
					if($result){
						return $msg = "<span class='success'>Product updated successfully</span>";
					}else{
						return $msg = "<span class='error'>Product not updated!</span>";
					}
				}
			}else{
				$query = "UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', description='$description', price='$price', type='$type' WHERE productId='$id'";
				$result = $this->db->update($query);
				if($result){
					return $msg = "<span class='success'>Product updated successfully</span>";
				}else{
					return $msg = "<span class='error'>Product not updated!</span>";
				}
			}
		}
	}


	public function delproductById($id){
		$query = "DELETE FROM tbl_product WHERE productId='$id'";
		$result = $this->db->delete($query);
		if($result){
			return $msg = "<span class='success'>Product deleted successfully</span>";
		}else{
			return $msg = "<span class='error'>Product not deleted!</span>";
		}
	}

	public function getFeaturedProduct(){
		$query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getNewProduct(){
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getSingleProductById($id){
		//SQL query using Alias
		$query = "SELECT p.*, c.catName, b.brandName
				FROM tbl_product as p, tbl_category as c, tbl_brand as b
				WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId='$id'";
		$result = $this->db->select($query);
		return $result;
	}


	public function latestFromIphone(){
		$query = "SELECT * FROM tbl_product WHERE brandId='19' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId='20' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId='21' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function latestFromAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId='22' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProductByCat($id){
		$query = "SELECT * FROM tbl_product WHERE catId='$id' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}
	

	public function insertProductData($cmrId, $productId){
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
		$productId = mysqli_real_escape_string($this->db->link, $productId);

		//Compare Select Query
		$compare_query = "SELECT * FROM tbl_compare WHERE customerId='$cmrId' AND productId='$productId'";
		$compCheck = $this->db->select($compare_query);
		if($compCheck){
			return $msg = "<span style='color:red;'>Product already added!</span>";
		}

		//Select Query
		$query = "SELECT * FROM tbl_product WHERE productId='$productId'";
		$result = $this->db->select($query)->fetch_assoc();
		if($result){
				$productId = $result['productId'];
				$productName = $result['productName'];
				$price = $result['price'];
				$image = $result['image'];
			
				$query = "INSERT INTO tbl_compare(customerId, productId, productName, price, image) VALUES('$cmrId','$productId','$productName','$price','$image')";
				$insertCmpData = $this->db->insert($query);
				if($insertCmpData){
					return $msg = "<span class='success' style='color:green;'>Added to compare</span>";
				}else{
					return $msg = "<span class='error' style='color:red;'>Not Added!</span>";
				}

		}
	}

	public function getComparePrduct($cmrId){
		$query = "SELECT * FROM tbl_compare WHERE customerId='$cmrId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function delCustomerCompData($cmrId){
		$query = "DELETE FROM tbl_compare WHERE customerId='$cmrId'";
		$result = $this->db->delete($query);
		return $result;
	}


	public function insertWishList($cmrId, $productId){
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
		$productId = mysqli_real_escape_string($this->db->link, $productId);

		//Wishlist Check Query
		$wlist_query = "SELECT * FROM tbl_wishlist WHERE customerId='$cmrId' AND productId='$productId'";
		$wlistCheck = $this->db->select($wlist_query);
		if($wlistCheck){
			return $msg = "<span style='color:red;'>Product already added!</span>";
		}

		//Select Query
		$query = "SELECT * FROM tbl_product WHERE productId='$productId'";
		$result = $this->db->select($query)->fetch_assoc();
		if($result){
				$productId = $result['productId'];
				$productName = $result['productName'];
				$price = $result['price'];
				$image = $result['image'];
			
				$query = "INSERT INTO tbl_wishlist(customerId, productId, productName, price, image) VALUES('$cmrId','$productId','$productName','$price','$image')";
				$insertCmpData = $this->db->insert($query);
				if($insertCmpData){
					return $msg = "<span class='success' style='color:green;'>Added to wishlist</span>";
				}else{
					return $msg = "<span class='error' style='color:red;'>Not Added!</span>";
				}

		}
	}

	public function getWishlistData($cmrId){
		$query = "SELECT * FROM tbl_wishlist WHERE customerId='$cmrId' ORDER BY wishlistId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function deleteWishlistData($cmrId, $productId){
		$query = "DELETE FROM tbl_wishlist WHERE customerId='$cmrId' AND productId='$productId'";
		$result = $this->db->delete($query);
		if($result){
			return $msg = "<span class='success' style='color:green;'>Data has been deleted successfully.</span>";
		}else{
			return $msg = "<span class='error' style='color:red;'>Data didn't delete!</span>";
		}
	}


	public function getAcerProduct(){
		$query = "SELECT * FROM tbl_product WHERE brandId='22' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}


	public function getSamsungProduct(){
		$query = "SELECT * FROM tbl_product WHERE brandId='20' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}


	public function getCanonProduct(){
		$query = "SELECT * FROM tbl_product WHERE brandId='21' ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}
}