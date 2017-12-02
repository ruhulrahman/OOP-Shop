<?php
	include_once("../lib/Session.php");

	Session::checkLogin();

	include_once("../lib/Database.php");
	include_once("../helpers/Format.php");
?>

<?php
//Admin Login Class
Class AdminLogin{

	//Variable Declaration
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function admin_login($adminUser, $adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if(empty($adminUser) || empty($adminPass)){
			$loginmsg = "Username or Password must not be empty";
			return $loginmsg;
		}else{
			$query = "SELECT * FROM tbl_admin WHERE user='$adminUser' AND pass='$adminPass'";
			$result = $this->db->select($query);
			if($result != false){
				$value = $result->fetch_assoc();
				Session::set("admin_login",true);
				Session::set("adminId",$value['id']);
				Session::set("adminUser",$value['user']);
				Session::set("adminName",$value['name']);

				header("Location:dashboard.php");
			}else{
				$loginmsg = "Username or Password not match!";
				return $loginmsg;
			}
		}
	}
}

?>