<?php

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

	function showLogin() {
		?>
			<form action='.' method='post'>
			<br><br><br><br>
			<center>
			<table style='font-size:20px;'>
				<tr>
				 	<td>
						<span style='font-size:24px;'> siteAdminUsername </span>
					</td>
					<td>
						<input type='text' value='' name='admin_username' style='width:200px;' />
					</td>
				</tr>
				<tr>
				 	<td>
						<span style='font-size:24px;'> siteAdminPassword </span>
					</td>
					<td>
						<input type='password' value='' name='admin_password' style='width:200px;' />
					</td>
				</tr>
			</table> <br>
			<input type='submit' value="Log In" />
			</center>
			</form>
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
	
	function createCookie() {
		setcookie("doctorsclinic-login", "admin_username", time()+86400, "/");
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
		if($_POST['admin_username']=='username' && $_POST['admin_password']=='password') {
			createAlertMessage(array(1, "Welcome $_POST[admin_username]"));
			createCookie();
			refresh();
		} else if($_POST['admin_username']) {
			createAlertMessage(array(0, "Invalid username or password."));
			refresh();
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
				
		echo "<center><table>";
		while($line = mysqli_fetch_array($tables)) {
			?>
				<tr> 
					<td id='main_table'>
						<?php echo changeName($line[0]); ?>
					</td>
					<td id='main_table_side'>
						<a href="./?view=<?php echo $line[0]; ?>" style='color:white;'> View </a>
					</td>
					<td id='main_table_side'>
						<a href="./?edit=<?php echo $line[0]; ?>" style='color:white;'> Edit </a>
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
			echo "<center> <table>";
			echo "<tr>";
			for($i=0;$i<count($afields);$i++) {
				echo "<td style='padding:10px;color:green;font-size:22px;'>";
				echo changeName($afields[$i]);
				echo "</td>";
			}
			while($line=mysqli_fetch_array($result)) {
				echo "<tr>";
				for($j=0;$j<count($line);$j++) {
					echo "<td style='padding-left:10px; padding-right:10px; padding-top:10px;'>";
					echo $line[$j];
					echo "</td>";
				}
				echo "</tr>";
			}
			echo "</tr>";			
			echo "</table> </center>";	
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

		<div style='font-size:25px';> <center> Add data to <strong> <?php echo changeName($name_table); ?> </strong> </center> </div> <br><br> <center> <form> <table>
			
		<?php

		$connect = mysqli_connect($database_host,$database_user,$database_password,$database_name);
		$fields = mysqli_query($connect, "describe $name_table;");
		$afields = array();
		
		while($field=mysqli_fetch_assoc($fields)) {
			echo "<tr><td>";
			echo changeName($field['Field']);
			echo "</td><td>";
			echo "<input " .  printInputFormAccordingToDataType($field['Type']) . " name=\"" . $field['Field'] . "\" />";
			echo "</td></tr>";	
		}
		
		echo "</table>";
		?> <input type='text' style='display:none;' name='edited' value='<?php echo $name_table; ?>'> </input>  <?php  
		echo "<input type='submit' value='Add Data'>  </input> </form></center>";				
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
		
		for($i=0;$i<count($afields);$i++) {

		$query_mid = $query_mid . fieldsWithQuotes($afields[$i][1]) . $_REQUEST[$afields[$i][0]] . fieldsWithQuotes($afields[$i][1]);

			if($i<count($afields)-1)
				$query_mid = $query_mid . ",";							
		}

		$query = $query_start . $query_mid . $query_end;
		$result = mysqli_query($connect,$query);
		$error = mysqli_error($connect);
		echo $query;
		if($result) {
			$toAlert = array(1,"Added a record to $name_table");
			createAlertMessage($toAlert);
			header("Location: ./?view=$name_table");			
		} else {
			$toAlert = array(0,"Fill form properly.");
			createAlertMessage($toAlert);
			header("Location: ./?edit=$name_table");
		}
	}
?>
