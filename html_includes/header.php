<!DOCTYPE html>
<html>
<head>
   <link href="css/bootstrap.min.css" rel="stylesheet">
<title>
DoctorsClinic
</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>





<script>

	var box;

	mapper = {
		<?php printUsernameAccountType(); ?>
	};

	var username;
	var xx;

	$(document).ready(function() {
		box = document.getElementById('replace');
		$('#login').hide();
		box.addEventListener("click", replace);
		username = document.getElementById("login-username");
		xx = document.getElementById("account_type");
		setInterval(function() {
			xx.setAttribute("value", mapper[$('#login-username').val()]);
			if(mapper[$('#login-username').val()]) {
				xx.setAttribute('style', "border:1px solid green;");
			} else {
				xx.setAttribute('style', "border:1px solid red;");
			}
		}, 750);
	});

	function replace() {
		if(box.getAttribute('login')==='1') {
			$('#information').hide();
			$('#loginbox').show();
			box.setAttribute('login', '0');
			box.innerHTML = "<small>Back to </small> Information Page";
		} else {
			$('#information').show();
			$('#loginbox').hide();
			box.setAttribute('login', '1');
			box.innerHTML = "Login to <small> doctors clinic </small>";
		}
	}

</script>





<style>

body {
    overflow-x: hidden;
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
	background-color:#3BAA98;
	padding:15px;
	padding-left:30px;
	padding-right:30px;
	font-size:20px;
}

#alert-box {

	position:absolute;
	top:70px;
	right:10px;
	width:400px;
	

}

.panel-info>.panel-heading {
	background-color:#3B5998;
	color:white;
}
.panel-info>.panel-heading>.panel-title {
	color:white;
}

#loginbox {
	display:none;
}


</style>
</head>
<body>

<div id='header' style="position:absolute; top:0px; left:0px; width:100%; height:60px;background-color:#3B5998;padding-left:30px;">

    <div style='color:white;font-size:30px;padding-top:10px;'>
	  <a href='.' style="color:white; text-decoration: none;"> doctors clinic </a>
    </div>

</div>

<?php
	if($alert_message) {
?>


    <div class="alert <?php if($alert_message[0]==1) { ?> alert-success <?php } else { ?> alert-danger <?php } ?>" id='alert-box'  style='opacity:1'>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
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
