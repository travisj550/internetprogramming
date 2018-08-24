<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<title>Contact Manager Login</title>
</head>
<body>
	
	<?php
	
	session_start();
	
	//ini_set('display_errors', 1); 
	//error_reporting(E_ALL);
	//$user;
	//$pw;

	function sanitize($input) {
	
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
	}
	function authenticate($user, $pw) {
		
		$file = "credential";
		$fileHandle = fopen($file, 'r') or die("Login unavailable");
		$valid_u = trim(fgets($fileHandle));
		$valid_pw = trim(fgets($fileHandle));
		
		//echo $valid_u."<br>";
		//echo $valid_pw."<br>";
		
		//echo strcmp($user,$valid_u)."<br>";
		//echo strcmp($pw,$valid_pw)."<br>";
			
			if($user == $valid_u && $pw == $valid_pw) {
				//echo "test";
				$_SESSION["uid"] = $_POST["user"];
				header('Location: admin.php');
				unset($_SESSION['attempts']);
			}
			elseif(isset($_SESSION['attempts'])) {
				//echo "false";
				echo '<script type="text/javascript">
					document.getElementById("error").innerHTML = "This user name and password combination is incorrect.";
					document.getElementById("user").focus();
					setTimeout(function(){document.getElementById("error").innerHTML = ""}, 3000);
					</script>';
			}
		$_SESSION['attempts'] = 1;
			
		fclose($fileHandle);
	}
	?>
	
	<table align="center">	
	<tr><td align="center"><h1>Contact Manager </h1></td></tr>
	<tr><td align="left"><p>Enter a user name and password below, then press submit to login.</p></td></tr>
	<tr><td align="center"><form name="login" accept-charset="utf-8" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	User: <br><input type="text" name="user" required><br>
	Password: <br><input type="text" name="pw" required><br>
	<input type="submit">
		<p id="error"></p>
	</form></td></tr>
	
	<tr><td>
	<?php 
	$user = "";
	$pw = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//echo var_dump($_POST)."<br>";

		$user = sanitize($_POST["user"]);
		$pw = sanitize($_POST["pw"]);

		authenticate($user, $pw);
	}
	?>
	</td></tr>
	
</table>

<br>

	<table id="back" style="width:0px;" align="center">
	<tr><td>
		<a href="../index.html">Back to ePortfolio</a>
	
	</td>
	</tr>
	</table>

</body>
</html>