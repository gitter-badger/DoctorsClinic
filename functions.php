<?php
	function printUsernameAccountType() {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
	
		$query = "SELECT * from login_info";
		$result = mysqli_query($connect,$query);
	
		while($row=mysqli_fetch_assoc($result)) {
			echo $row[username] . ":" . "'" .  $row[account_type] . "'" . ",";
		}		
	}

	function checkNameChangeForDoctor($R, $username,$eid) {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		if($R[changeName]) {
			if(strlen($R[changeName])>5) {
				$query = "UPDATE employees_info SET name='$R[changeName]' WHERE e_id=$eid;";
				$result = mysqli_query($connect,$query);
				if($result) {
					$toAlert = array(1,"Name Succesfully updated.");
					createAlertMessage($toAlert);
					refresh();

				} else {
					$toAlert = array(0,"Some error occured");
					createAlertMessage($toAlert);
					refresh();
				}
			} else {
				$toAlert = array(0,"Name very small.");
				createAlertMessage($toAlert);
				refresh();
			}
		}
	}

	function checkPasswordChangeForDoctor($R,$username) {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		if($R[changePassword]) {
			if(strlen($R[changePassword])>4) {
				$query = "UPDATE login_info SET password='$R[changePassword]' WHERE username='$username';";
				$result = mysqli_query($connect,$query);
				if($result) {
					$toAlert = array(1,"Password successfully changed.");
					createAlertMessage($toAlert);
					refresh();

				} else {
					$toAlert = array(0,"Some error occured");
					createAlertMessage($toAlert);
					refresh();
				}
			} else {
				$toAlert = array(0,"Password very small.");
				createAlertMessage($toAlert);
				refresh();
			}
		}
	}

	function printInputFormAccordingToDataType($input_type) {
		if(strpos($input_type,"int")!== false) {
			return " type=\"number\" ";
		} else if(strpos($input_type, "varchar")!==false)  {
			return " type=\"text\" maxlength=\"" . preg_replace('/\D/', '', $input_type) . "\" ";
		} else {
			return " type=\"" . $input_type . "\" ";
		}
	}

	function fieldsWithQuotes($input_type) {
		if(strpos($input_type,"int")!== false) {
			return '';		
		}
		return "'";
	}

	function checkSomeoneDeletingSomething() {
		if($_REQUEST['delete']) {
			if(checkTable($_REQUEST['delete'])) {
				include 'database_config.php';
				$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
				$quote = '';
				if(getPrimaryKeyField($_REQUEST['delete'])=='username') {
					$quote = "'";
				}
				$query = "DELETE FROM " . $_REQUEST['delete'] . " WHERE ";
				$query = $query . getPrimaryKeyField($_REQUEST['delete']);
				$query = $query . "=" . $quote . $_REQUEST['key'] . $quote;

				mysqli_query($connect,$query);
				$toAlert = array(1,"Deleted one record.");
				createAlertMessage($toAlert);
				header('Location: ./?view=' . $_REQUEST['delete']);
			}
		}
	}

	function getPrimaryKeyField($name_table) {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$query = "SHOW KEYS FROM $name_table WHERE Key_name = 'PRIMARY'";
		$result = mysqli_query($connect,$query);
		$result = mysqli_fetch_assoc($result);
		return $result['Column_name'];
	}

	function showLogin() {

		?>
   <div class='container'>
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>

                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action='./' method='post'>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>

                            <div style="margin-bottom: 15px" class="input-group">
                                        <span class="input-group-addon"> <small> Account Type </small> </span>
                                        <input id="account_type" type="text" class="form-control"  value="admin" disabled="true">
                            </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type='submit' class="btn btn-success" value='Login' /> 
                                    </div>
                                </div>


  
                            </form>     



                        </div>                     
                    </div>
		
		</div>
	</div>


		<div class='row' id='information'><br><br><br>
			<div class='col-sm-1'> </div>
			<div class='col-sm-3'>  <img src='http://doctorsclinichouston.com/wp-content/themes/silent-blue/images/Photos/about-us.jpg'> </img> </div>
			<div class='col-sm-5'>
			
				Doctor's clinic is a health care facitily that is primarily devoted to the care of 
				patients. It is privately operated and managed. It typically covers the primary health
				needs of population in nearby locations of Vaishali Nagar, Jaipur. In contrast, to 
				larger hospitals which offer specialised treatments to a mass of people, Doctor's 
				clinic serves the need for a smaller number of people and admits in patients for 
				over-night stay. The clinic is operated under supervision of two docors 
				namely, Dr. A.K. Saxena (MD) and Dr. Alok Mittal (MBBS).
				<br> <br> <br> 
				<ul>
					<li> The clinic is mainly ran by group of 6 doctors of which 2 are specialised in their fields and 4 are MBBS docotrs. </li>
					<li> For medical helps there are 3 nurses, 2 lab-assistants for various physical testing labs (like blood test, ECG.. etc). </li>
					<li> One shopkeeper at medical store is also there. </li>
					<li> One sweeper is also required for cleaning of the clinic. </li>

				</ul>
			</div>
			<div class='col-sm-3'>
				<div class='row'>
					<img src='http://fitfx.com/wp-content/uploads/Doctors-Clinic-Logo.png' width='100%'> </img>
				</div>
				<div class='row'> <center>
					<img src='http://doctorsclinichouston.com/wp-content/themes/silent-blue/images/Photos/doctor-steth.jpg' width='60%'> </img> </center>
				</div>
			</div>
		</div>
		
	</div>

	<button id="replace" style="position:absolute;top:15px;right:300px;" class="btn btn-success" login="1">
		Login <small> to doctors clinic </small>
	</button>

		<?php
	}

	function showLogoutButton() {
		?>
			<div style='position:fixed;top:0px;right:0px;color:white;z-index:2;padding-right:20px;padding-top:20px;font-size:30px;'> <a href='./?logout=true' style='color:white'> Logout </a> </div>
		<?php
	}

	function checkAlert() {
		if($_COOKIE['doctorsclinic-alert'])
			return true;
		return false;
	}

	function giveAlert() {
		return  unserialize($_COOKIE['doctorsclinic-alert']);
	}
	
	function createCookie($param) {
		setcookie("doctorsclinic-login", serialize($param), time()+86400, "/");
	}

	function clearCookie() {
		setcookie("doctorsclinic-login", "admin_username", time()-86400, "/");
	}

	function createAlertMessage($value) {
		setcookie("doctorsclinic-alert", serialize($value), time()+86400, "/");
	}

	function removeAlertMessage() {
		setcookie("doctorsclinic-alert", "123", time()-86400, "/");
	}

	function refresh() {
		header('Location: ./');
	}

	function checkSomeoneIsLoggingIn() {
		if($_POST['username']) {
			include 'database_config.php';
			$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
			$query = "SELECT * FROM login_info WHERE username='$_POST[username]' AND password='$_POST[password]';";
			$result = mysqli_query($connect, $query);
			$result = mysqli_fetch_assoc($result);
			if($result) {
				createCookie(array($result['username'],$result['account_type'], $result['e_id']));
				createAlertMessage(array(1, "Welcome $_POST[username]"));
				refresh();
			} else {
				createAlertMessage(array(0, "Invalid username/password"));
				refresh();
			}
		}
	}

	function checkSomeoneAlreadyLoggedIn() {	
		if($_COOKIE['doctorsclinic-login'])
			return true;
		return false;
	}
	function checkIfUserWantToLogOut() {
		if($_REQUEST['logout']) {
			clearCookie();
			refresh();
		}
	}
	
	function showTables() {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$tables = mysqli_query($connect, "show tables;");
		
		?>
			<center>
			<div id='title' style='margin-top:10px;margin-bottom:10px;font-size:25px;'> Tables in <strong> doctorsclinic </strong> </div>
			<br>
			</center>
		<?php
				
		echo "<center><table class='table-bordered'>";
		while($line = mysqli_fetch_array($tables)) {
			?>
				<tr> 
					<td id='main_table'>
						<a href="./?view=<?php echo $line[0]; ?>" style='color:white;text-decoration:none;'> <?php echo changeName($line[0]); ?> </a>
					</td>
					<td id='main_table_side'>
						<a href="./?view=<?php echo $line[0]; ?>" style='color:white;'> View </a>
					</td>
					<td id='main_table_side'>
						<a href="./?edit=<?php echo $line[0]; ?>" style='color:white;'> Add new record </a>
					</td>
				</tr>
			<?php
		}
		echo "</table></center>";
	}

	function checkMode() {
		if($_REQUEST['view']) {
			$mode = 'view';
		} else if($_REQUEST['edit']) {
			$mode = 'edit';
		} else {
			$mode = 'normal';
		}
		return $mode;
	}

	function checkTable($name_table) {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$tables = mysqli_query($connect, "show tables;");
		$found = false;
		while($line=mysqli_fetch_array($tables)) {
			if($line[0]==$name_table) $found = true;
		}
		return $found;
	}

	function display($name_table) {
			require('database_config.php');
		
		?>
			<div style='font-size:25px';> <center> In view mode for <strong> <?php echo changeName($name_table); ?> </strong> </center> </div>
				<br><br>
		<?php

			$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
			$fields = mysqli_query($connect, "describe $name_table;");
			$afields = array();
		
			while($field=mysqli_fetch_array($fields)) {
				$afields[] = $field[0];
			}
		//	print_r($afields);
			$query = "SELECT * from $name_table";
			$result = mysqli_query($connect, $query);
			echo "<center> <div class='row'> <div class='col-sm-2'> </div> <div class=\"col-sm-8 table-responsive\"> <table class=\"table table-striped table-bordered\" >";
			echo "<tr>";
			for($i=0;$i<count($afields);$i++) {
				echo "<th style='padding:10px;color:green;font-size:22px;'>";
				echo changeName($afields[$i]);
				echo "</th>";
			}
			
			while($line=mysqli_fetch_array($result)) {
				echo "<tr>";
				for($j=0;$j<count($line)/2;$j++) {
					echo "<td style='padding-left:10px; padding-right:10px; padding-top:10px;'>";
					echo $line[$j];
					echo "</td>";
				}
				
				echo "<td style='padding-left:10px; padding-right:10px; padding-top:10px;'>";
				echo "<a href=\"./?delete=$name_table&key=" . $line[getPrimaryKeyField($name_table)] . "\"> Delete </a>";
				echo "</td> <td style='padding-left:10px; padding-right:10px; padding-top:10px;'>";
				echo "<a href=\"./?edit=$name_table&key=" . $line[getPrimaryKeyField($name_table)] . "\"> Update </a>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</tr>";			
			echo "</table> </div> <div class='col-sm-2'> </div> </div> </center>";
		?>
		<center> 
			<br> <a href='./?edit=<?php echo $name_table; ?>'> <button class="btn btn-primary"> Add record to <?php echo $name_table; ?> </button> </a>
		</center>
		<?php
	}

	function changeName($name) {
		require('fields_info.php');
		if($map[$name]) return $map[$name];
		return $name;
	}

	function editTable($name_table) {
		include 'database_config.php';
		require('fields_info.php');
		?>

		<h2> <center> 
		<?php if(isset($_REQUEST['key'])) { ?> Update data in <?php } else { ?> Add data in <?php } ?>
		<strong> <?php echo changeName($name_table); ?> </strong> </center> </h2> <br><br> <center> <div class='row'> <div class='col-sm-3'> </div> <div class='col-sm-6'> <form>  <table class="table table-stripped">
			
		<?php

		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$fields = mysqli_query($connect, "describe $name_table;");
		$afields = array();
		$quotee = "";
		if(getPrimaryKeyField($name_table)=='username') $quotee = "'";
		$values = mysqli_query($connect, "SELECT * FROM $name_table WHERE " . getPrimaryKeyField($name_table) . "=" . $quotee . $_REQUEST['key'] . $quotee . ";");
		$values = mysqli_fetch_assoc($values);
		
		while($field=mysqli_fetch_assoc($fields)) {
			echo "<tr><td>";
			echo changeName($field['Field']);
			echo "</td><td>";
			$value = '';

			if(isset($_REQUEST['key'])) {
				$value = $values[$field['Field']];
			}

			echo "<input class='col-sm-10' " .  printInputFormAccordingToDataType($field['Type']) . " value=\"$value\" name=\"" . $field['Field'] . "\" /> ";
			echo "</td></tr>";	
		}
		
		echo "</table>";
		?> <input type='text' style='display:none;' name='edited' value='<?php echo $name_table; ?>'> </input>  
		<?php
			if(isset($_REQUEST['key'])) {
				?>
					<input type='text' style='display:none;' name='updated' value='true' />
				<?php
			}
		echo "<br> <input type='submit' value='Add Data' class=\"btn btn-primary\">  </input> </form> </div> <div class='col-sm-3'> </div> </div> </center>";
	}

	function checkSomeoneSubmittingForm($list) {
		if(isset($list['edited'])) {
			return true;
		}
		return false;
	}

	function enterData() {
		include 'database_config.php';
		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$name_table = $_REQUEST['edited'];
		
		$fields = mysqli_query($connect, "describe $name_table;");
		$afields = array();

		while($field=mysqli_fetch_array($fields)) {
			$afields[] = array($field[0],$field[1]);
		}
	//	print_r($afields);
		$query_quote = "'";
		$query_start = "INSERT INTO $name_table VALUES(";
		$query_end = ");";
		$query_mid = "";

		$query_update_start = "UPDATE $name_table SET ";
		$query_quotee = '';
		if(getPrimaryKeyField($name_table) == 'username') $query_quotee = "'";
		$query_update_end = " WHERE " . getPrimaryKeyField($name_table) . "=" . $query_quotee . $_REQUEST[getPrimaryKeyField($name_table)] . $query_quotee;
		$query_update_mid = "";
		
		for($i=0;$i<count($afields);$i++) {

			$query_mid = $query_mid . fieldsWithQuotes($afields[$i][1]) . $_REQUEST[$afields[$i][0]] . fieldsWithQuotes($afields[$i][1]);
			$query_update_mid = $query_update_mid . $afields[$i][0] . "=" . fieldsWithQuotes($afields[$i][1]) . $_REQUEST[$afields[$i][0]] . fieldsWithQuotes($afields[$i][1]);

			if($i<count($afields)-1) {
				$query_mid = $query_mid . ",";							
				$query_update_mid = $query_update_mid . ", ";
			}
		}
		$query_update = $query_update_start . $query_update_mid . $query_update_end;
		$query = $query_start . $query_mid . $query_end;
	
		if(isset($_REQUEST['updated'])) $query = $query_update;
		$result = mysqli_query($connect,$query);
		$error = mysqli_error($connect);
		if($result) {
			if(isset($_REQUEST['updated'])) {
				$toAlert = array(1,"Update a record in $name_table");
				createAlertMessage($toAlert);
				header("Location: ./?view=$name_table");
			} else {
				$toAlert = array(1,"Added a record to $name_table");
				createAlertMessage($toAlert);
				header("Location: ./?view=$name_table");
			}
		} else {
			if($_REQUEST['updated']) {
				$toAlert = array(0,"Update with proper values.");
				createAlertMessage($toAlert);
				header("Location: ./?edit=$name_table&key=" . $_REQUEST[getPrimaryKeyField($name_table)] );
			} else {
				$toAlert = array(0,"Fill form properly.");
				createAlertMessage($toAlert);
				header("Location: ./?edit=$name_table");
			}
		}
	}
	
	function displayAccordingToDoctor($username,$eid) {
		?>
			<div class='container'>
				<div class='row'>
					<div class='col-sm-4'>

						<?php
							include 'database_config.php';
							$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
							$query = "select name from employees_info where e_id in (select e_id from login_info where username='$username');";
							$result = mysqli_query($connect,$query);
							$result = mysqli_fetch_assoc($result);
							
							$name = $result['name'];

						?>

						<h3> Welcome, <strong> Dr. <?php echo $name; ?> </strong> </h3>
					</div>
					<div class='col-sm-4'>
					</div>
					<div class='col-sm-4'>
					</div>
				</div>
				<br><br>
				<div class='row'>
					<div class='col-sm-6'>
						<div class='row'> <center>
						<h4> <strong> Patients </strong> under you. </h4>
						</center>
						</div>
						<br><br>
				
						<?php
							
							$query = "SELECT * from patient_info WHERE treated_by in (SELECT doctor_id from	doctors_info WHERE e_id=$eid);";
							
							$result = mysqli_query($connect,$query);

							?>
								<table class="table table-striped table-bordered" >
								<tr>
									<th> Patient  Id  </th>
									<th> Gender  </th>
									<th> Name  </th>
									<th> Age  </th>
									<th> Phone  </th>
									<th> Patient History </th>
								</tr>

								

							<?php
								
							while($row=mysqli_fetch_assoc($result)) {
							 ?>	<tr> <?php
							
							 	echo "<td>$row[p_id]</td>";
							 	echo "<td>$row[gender]</td>";
							 	echo "<td>$row[name]</td>";
							 	echo "<td>$row[age]</td>";
								echo "<td>$row[phone]</td>";
						 		echo "<td>$row[patient_history]</td>";
							 ?>	</tr>		  <?php
							}
							
						?>
					</table>

				</div>

				<div class='col-sm-6'>
					<center>
					<div class='row'>
							<h3> Quick Links </h3>
						<br><br>
					</div>
					<div class='row'>
						<table class="table">
							
							<tr>
								<td style='float:right;'>
									<form action='.'>
									<input type='text' name='changePassword' />
								</td>
								<td>
									<input type='submit' class="btn btn-primary" value="Change Password"> </btn>
									</form>
								</td>
							</tr>
							<tr>
								<td style='float:right;'>
									<form action='.'>		
									<input type='text' name='changeName' />
								</td>
								<td>
									<input type='submit' class="btn btn-primary" value="Change Name">  </btn>
									</form>
								</td>
							</tr>

						</table>
					</div>
					</center>
				</div>

				</div>

			</div>
		<?php
	}

	function displayAccordingToPatient($pid) {
		?>
			<div class='container'>
				<div class='row'>
				
				<div class='col-sm-6'>
						<h3> Welcome <strong> 
						<?php

							include 'database_config.php';
							$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);

							$result = mysqli_query($connect,"SELECT name from patient_info where p_id=$pid;");
							$result = mysqli_fetch_assoc($result);
							echo $result['name'];

						?>
						</strong> </h3> <br>
						<h4> You are being treated by Dr. 
						<?php 
							$query = "select name from employees_info where e_id in (select e_id from doctors_info where doctor_id in (select treated_by from patient_info where p_id=$pid));";
							$result = mysqli_query($connect, $query);
							$result = mysqli_fetch_assoc($result);
							echo "<strong>" . $result[name] . "</strong>";
						?>
						</h4>
				</div>
				<div class='col-sm-6'> <br><br><br><br>
					<center> <h3> Medicines prescribed to you. </h3> </center> <br>
					<table class="table table-striped table-bordered">
						<tr>
							<td> <h4> Medicine ID &nbsp; &nbsp; </h4> </td>
							<td> <h4> Medicine name </h4> </td>
							<td> <h4> Price </h4> </td>
						</tr>
						<?php
							
							$query = "SELECT medicines_set FROM medicines_prescribed WHERE p_id=$pid;";
							$result = mysqli_query($connect, $query);
							$result = mysqli_fetch_assoc($result);
							$result = explode(',',$result['medicines_set']);
							
					

							$result2 = mysqli_query($connect, "SELECT * FROM medicine_info");
							$result3 = array();

							while($line = mysqli_fetch_row($result2)) {
								$result3[intval($line[0])] = array($line[1], $line[3]);
							}

								
							foreach($result as $key=>$resu) {
								echo "<tr> <td> <center> $resu </center> </td> ";
								echo "<td>" . $result3[intval($resu)][0] . "</td>";
								echo "<td>" . $result3[intval($resu)][1] . "</td> </tr>";
							}
						?>
					</table>
				</div>
				</div>
			</div>
		<?php
	}

?>
