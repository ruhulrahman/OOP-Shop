<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath."/../lib/Database.php");
	include_once($filepath."/../helpers/Format.php");
?>

<?php

class Customer{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}


	public function CustemerRegistration($data){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$password = md5(mysqli_real_escape_string($this->db->link, $data['password']));

		$mailQuery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
		$mailCheck = $this->db->select($mailQuery);
		if($mailCheck){
			echo "This email already existed!";
		}else{
			$query = "INSERT INTO tbl_customer(name, city, zip, email, address, country, phone, password) VALUES('$name','$city','$zip','$email','$address','$country','$phone','$password')";
			$result = $this->db->insert($query);
			if($result){
				return $msg = "<span class='success'>Registration has been successfully completed</span>";
			}else{
				return $msg = "<span class='error'>Registration has not been successfully completed</span>";
			}
		}
	}


	public function loginCustomer($data){
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = md5(mysqli_real_escape_string($this->db->link, $data['password']));

		$query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
		$result = $this->db->select($query);
		if($result != false){			
			$value = $result->fetch_assoc();
			Session::set("cmrLogin",true);
			Session::set("cmrId",$value['customerId']);
			Session::set("cmrName",$value['name']);
			header("Location: orderdetails.php");
		}else{
			return $msg = "<span style='color:red;'>Email or password not match</span>";
		}
	}


	public function getAllCustomerData($id){
		$query = "SELECT * FROM tbl_customer WHERE customerId='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function CustomerUpdate($data, $id){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$password = md5(mysqli_real_escape_string($this->db->link, $data['password']));

		$query = "UPDATE tbl_customer SET name='$name', city='$city', zip='$zip', email='$email', address='$address', country='$country', phone='$phone', password='$password' WHERE customerId='$id'";
		$result = $this->db->update($query);
		if($result){
			return $msg = "<span class='success'>Update Successfully completed</span>";
		}else{
			return $msg = "<span class='error'>Update didn't not Successfull</span>";
		}
	}
}