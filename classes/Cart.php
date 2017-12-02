<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

class Cart{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity, $id){
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);

		$sId = session_id();

		//Select Quary
		$query = "SELECT * FROM tbl_product WHERE productId='$productId'";
		$result = $this->db->select($query)->fetch_assoc();

		$productName = $result['productName'];
		$price = $result['price'];
		$image = $result['image'];

		//Check Quary from cart table
		$checkQuery = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
		$getPd = $this->db->select($checkQuery);
		if($getPd){
			$msg = "Product already added!";
			return $msg;
		}else{
			//Insert Query
			$query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
			$insertcart = $this->db->insert($query);
			if($insertcart){
				header("Location: cart.php");
			}else{
				header("Location: 404.php");
			}
		}
	}


	public function getCartProduct(){
		$sId = session_id();

		//Select Quary
		$query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function UpdateCart($quantity, $cartId){
		$sId = session_id();

		//Select Quary
		$query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";
		$result = $this->db->update($query);
		return $result;
	}

	public function delProductById($id){
		//Select Quary
		$query = "DELETE FROM tbl_cart WHERE cartId='$id'";
		$result = $this->db->delete($query);
		return $result;
	}


	public function checkCartTable(){
		$sId = session_id();
		//Select Quary
		$query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result = $this->db->select($query);
		return $result;
	}


	public function delCustomerCart(){
		$sId = session_id();
		//Select Quary
		$query = "DELETE FROM tbl_cart WHERE sId='$sId'";
		$result = $this->db->delete($query);
		return $result;
	}


	public function orderProduct($customerId){
		$sId = session_id();
		//Select Quary
		$query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result = $this->db->select($query);
		if($result)	{
			while($value = $result->fetch_assoc()){
				$productId = $value['productId'];
				$productName = $value['productName'];
				$quantity = $value['quantity'];				
				$price = $value['price'] * $quantity;
				$image = $value['image'];

				//Insert Query
				$query = "INSERT INTO tbl_order(customerId, productId, productName, price, quantity, image) VALUES('$customerId','$productId','$productName','$price','$quantity','$image')";
				$this->db->insert($query);
			}
		}
	}

	public function payableAmount($cmrId){
		$query = "SELECT price FROM tbl_order WHERE customerId='$cmrId' AND date=now()";
		$result = $this->db->select($query);
		return $result;
	}

	public function getOrderProduct($cmrId){
		$query = "SELECT * FROM tbl_order WHERE customerId='$cmrId' ORDER BY orderId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getOrderAllProduct(){
		$query = "SELECT * FROM tbl_order ORDER BY date";
		$result = $this->db->select($query);
		return $result;
	}


	public function productShifted($id, $price, $time){
		$id = mysqli_real_escape_string($this->db->link, $id);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$time = mysqli_real_escape_string($this->db->link, $time);

		//Update Quary
		$query = "UPDATE tbl_order SET status='1' WHERE customerId='$id' AND price='$price' AND date='$time'";
		$result = $this->db->update($query);
		if($result){
			return $msg = "<span class='success'>Update Successfully completed</span>";
		}else{
			return $msg = "<span class='error'>Update didn't not Successfull</span>";
		}
	}

	public function delProductShifted($id, $price, $time){
		$id = mysqli_real_escape_string($this->db->link, $id);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$time = mysqli_real_escape_string($this->db->link, $time);

		$query = "DELETE FROM tbl_order WHERE customerId='$id' AND price='$price' AND date='$time'";
		$result = $this->db->delete($query);
		if($result){
			return $msg = "<span class='success'>Product removed successfully</span>";
		}else{
			return $msg = "<span class='error'>Product didn't Remove</span>";
		}
	}

	public function productShiftedConfirm($id, $price, $time){
		$id = mysqli_real_escape_string($this->db->link, $id);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$time = mysqli_real_escape_string($this->db->link, $time);

		//Update Quary
		$query = "UPDATE tbl_order SET status='2' WHERE customerId='$id' AND price='$price' AND date='$time'";
		$result = $this->db->update($query);
		if($result){
			return $msg = "<span class='success'>Update Successfully completed</span>";
		}else{
			return $msg = "<span class='error'>Update didn't not Successfull</span>";
		}
	}
}