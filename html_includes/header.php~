<!DOCTYPE html>
<html>
<head>
<title>
DoctorsClinic
</title>
<style>

input[type="text"] {
    margin-left:10px;
    padding-left:10px;
    color:green;
    font-size:24px;
}

input[type="password"] {
    margin-left:10px;
    padding-left:10px;
    color:green;
    font-size:24px;
}

input[type="submit"] {
    color:green;
    font-size:20px;
}

#main_table {
	color:white;
	font-size:30px;
	background-color:#3B5998;
	padding:15px;
	padding-left:30px;
	padding-right:30px;
	font-size:20px;
}

#main_table_side {
	color:white;
	font-size:30px;
	background-color:#3B5998;
	padding:15px;
	padding-left:10px;
	padding-right:10px;
	font-size:15px;
}

#main_table:hover {
	color:yellow;
	font-size:30px;
	background-color:#3B5998;
	padding:15px;
	padding-left:30px;
	padding-right:30px;
	font-size:20px;
}

#alert-box {
	position:absolute;
	top:0px;
	left:400px;
	width:400px;
	

<?php

//	print_r($alert_message);

	if($alert_message && $alert_message[0]==1) {
		echo "background-color:green;";
	}
	if($alert_message && $alert_message[0]==0) {
		echo "background-color:red;";
	}
?>

	padding-bottom:10px;
	padding-top:10px;
	text-align:center;
	font-size:20px;
	border-radius:10px;
	border:1px solid white;
}

</style>
</head>
<body>

<div id='header' style="position:absolute; top:0px; left:0px; width:100%; height:60px;background-color:#3B5998;padding-left:30px;">

    <div style='color:white;font-size:30px;padding-top:10px;'>
	  <a href='.' style="color:white; text-decoration: none;">  facebook | doctors clinic </a>
    </div>

</div>

<?php
	if($alert_message) {
?>




<div id='alert-box' style='opacity:1'>
	<?php echo $alert_message[1]; ?>
</div>

<script>
	var elem = document.getElementById('alert-box');
	var value=100;
	var timeout = setInterval(function() {
		value-=1;
		if(value<0){
			 elem.setAttribute('style', 'opacity:' + 0 + ';')
			 clearInterval(timeout);
		}
		elem.setAttribute('style', 'opacity:' + value/100 + ';')
	}, 50);
	
</script>


<?php
	}
?>

<br><br><br><br>
