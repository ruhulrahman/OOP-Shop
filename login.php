<?php include "inc/header.php"; ?>
<?php
	$login = Session::get("cmrLogin",true);
	if($login == true){
		header("Location: orderdetails.php");
	}
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$login = $cmr->loginCustomer($_POST);
	}
?>




 <div class="main">
    <div class="content">
    	 <div class="login_panel">

        	<?php
        		if(isset($login)){
        			echo $login;
        		}
        	?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" id="member">
            	<input name="email" type="text" placeholder="Email" class="field" required />
                <input name="password" type="password" placeholder="Password" class="field" required />

             <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
             </form>
             <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
         </div>
    	<div class="register_account">
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		$customerReg = $cmr->CustemerRegistration($_POST);
	}
?>
    		<?php
    			if(isset($customerReg)){
    				echo $customerReg;
    			}
    		?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
								<input type="text" name="name" placeholder="Name" required />
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" required />
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code"" required />
							</div>
							<div>
								<input type="text" name="email" placeholder="Email" />
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address" required />
						</div>
		    		<div>
						<input type="text" name="country" placeholder="country" required />
		    		<!-----------Select Option --------------
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>

		         </select>
		        ------------------------>
				 </div>		        
	
		          <div>
		          	<input type="text" name="phone" placeholder="Phone" required />
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password" required />
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?php include "inc/footer.php"; ?>