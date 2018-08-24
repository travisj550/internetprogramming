<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<title>Contact Manager</title>
</head>
<body>
	
	<?php
	
	session_start();

	//listContacts();

	//Display login name
	if(isset($_SESSION["uid"])) {
		$uid = $_SESSION["uid"];
	}
/*
	echo '<script type="text/javascript">
	document.getElementById("user").innerHTML = "<?php 
	echo "Logged in as ".$uid; ?>";
	</script>';

	echo $uid."<br>";
	echo $_SESSION["uid"]."<br>";
*/
	//search("Ozzie Osprey", " ", " ");

	//$_SESSION["request"] = "search";
	
	//ini_set('display_errors', 1); 
	//error_reporting(E_ALL);
	//$user;
	//$pw;

	function sanitize($input) {
	
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
	}
	function listContacts() {

		$file = "contacts";
		$fileHandle = fopen($file, 'r') or die("Contacts list unavailable.");

		$number = 1;
		while(!feof($fileHandle)) {

				echo $number.".<br>";
				echo "Name: ".trim(fgets($fileHandle))."<br>";
				$email = trim(fgets($fileHandle));
				echo 'Email: <a href="mailto:'.$email.'">'.$email.'</a><br>';
				echo "Phone: ".trim(fgets($fileHandle))."<br>";
				echo "Modified: ".trim(fgets($fileHandle))."<br>";
				echo "------------<br>";

				fgets($fileHandle);
				$number++;
			}
		fclose($fileHandle);		
	}
	function search($name, $email, $phone) {
		
		$file = "contacts";
		$fileHandle = fopen($file, 'r') or die("Contacts list unavailable.");

		//Different formatting of names?
		//Only one part of full name?
		//Search by other info?

		$line = 0;

		while(!feof($fileHandle)) {

			$temp = trim(fgets($fileHandle));
			$line++;

			if($name == $temp) {
				$email = trim(fgets($fileHandle));
				$phone = trim(fgets($fileHandle));
				$line += 3;

				//echo $line."<br>";
				echo "Name: ".$temp."<br>";
				echo "Email: ".$email."<br>";
				echo "Phone: ".$phone."<br>";
				echo "Date Modified: ".trim(fgets($fileHandle));

				return true;
			}
		}

		fclose($fileHandle);

		return false;
	}
	function add($name, $email, $phone) {

		$file = "contacts";
		$fileHandle = fopen($file, 'r') or die("Contacts list unavailable.");
		
		if(search($name, $email, $phone)) {

			echo "Contact already exists.";
		}
		else {
			
			$fileHandle = fopen($file, 'a') or die("Contacts list unavailable.");
			fwrite($fileHandle, $name."\n".$email."\n".
			$phone."\n".date('m/d/Y')."\n----");
			echo "Contact added.<br>";
		}
		fclose($fileHandle);
	}
	function modify($name, $email, $phone, $delete) {

		$file = "contacts";
		$fileHandle = fopen($file, 'r') or die("Contacts list unavailable.");
		$new = "";
		$found = false;
		$line = 0;
		
			while(!feof($fileHandle)) {

				$temp = trim(fgets($fileHandle));
				$line++;
	
				if($name == $temp && $delete != "1") {
					//echo "found<br>";
					$found = true;
					$new = $new."\n".$name."\n".$email."\n".
					$phone."\n".date('m/d/Y')."\n----";
					fgets($fileHandle);
					fgets($fileHandle);
					fgets($fileHandle);
					fgets($fileHandle);
					$line += 4;

					echo "Contact modified.<br>";

					continue;
				}
				if($name == $temp && $delete == "1") {
					//echo "deletion<br>";
					fgets($fileHandle);
					fgets($fileHandle);
					fgets($fileHandle);
					fgets($fileHandle);
					//fgets($fileHandle);

					$line += 4;

					echo "Contact deleted.<br>";

					continue;
				}
				else {
					if($line != 1)
						$new = $new."\n".$temp;
					else
						$new = $temp;
				}
		}
		if(found) {
			$fileHandle = fopen($file, 'w') or die("Contacts list unavailable.");
			fwrite($fileHandle, $new);
		}
		else{
			echo "Contact not found.";
		}
		fclose($fileHandle);
	}
	?>
	
	<table align="center">	
	<tr><td align="center"><h1>Contact Manager</h1></td></tr>
	
	<tr><td align="center"><p>Logged in as <?php echo $_SESSION["uid"]; ?></p></td></tr>

	<tr><td align="center">

	<p align="left">
	Output will appear below the forms. To list all contacts, click "List all contacts".
	</p>
	<form name="list" accept-charset="utf-8" method="post" action="<?php
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	?>">
	<input type="hidden" name="action" value="list">
	<input type="submit" value="List all contacts">
	</form>
	<hr>
	<h3>Search for a contact</h3>
	<p align="left">To search for a contact, type in a Full Name and click "Search".<br></p>

	<form name="search" id="search" accept-charset="utf-8" method="post" action="<?php 
	//$_SESSION["request"] = "search";
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	?>">
	Full Name: <br><input type="text" name="name" required><br>
	<!--
	E-mail Address: <br><input type="text" name="email"><br>
	Phone Number: <br><input type="text" name="phone"><br>
	-->
	<input type="hidden" name="action" value="search">
	<input type="submit" value="Search">
		<p id="error"></p>
	</form>
	<hr>
	<h3>Add a contact</h3>
	<p align="left">	To add a contact, enter a full name, email address, and phone number below, then click "Add".<br></p>
	<form name="add" id="add" accept-charset="utf-8" method="post" action="<?php 
	//$_SESSION["request"] = "add";
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	?>">
	Full Name: <br><input type="text" name="name" required><br>
	E-mail Address: <br><input type="text" name="email" required><br>
	Phone Number: <br><input type="text" name="phone" required><br>
	<input type="hidden" name="action" value="add">
	<input type="submit" value="Add">
		<p id="error"></p>
	</form>
	<hr>
	<h3>Modify or delete a contact</h3>
	<p align="left">	To modify a contact, enter at least the Full Name of that contact. To remove it, check the box for "Delete contact?".<br></p>
	<form name="modify" id="modify" accept-charset="utf-8" method="post" action="<?php 
	//$_SESSION["request"] = "modify";
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	?>">
	Full Name: <br><input type="text" name="name" required><br>
	E-mail Address: <br><input type="text" name="email"><br>
	Phone Number: <br><input type="text" name="phone"><br><br>
	Delete contact? <input type="checkbox" name="delete" value=1>Yes<br>
	<input type="hidden" name="action" value="modify">
	<input type="submit" value="Modify">
		<p id="error"></p>
	</form>
	<hr>
	</td></tr>

	<tr><td>
	<?php 
	$name = "";
	$email = "";
	$phone = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//echo var_dump($_POST)."<br>";

		if($_POST["action"] == "search") {

			$name = sanitize($_POST["name"]);
			$email = sanitize($_POST["email"]);
			$phone = sanitize($_POST["phone"]);


			search($name, $email, $phone);
		}
		if($_POST["action"] == "add") {

			$name = sanitize($_POST["name"]);
			$email = sanitize($_POST["email"]);
			$phone = sanitize($_POST["phone"]);

			add($name, $email, $phone);
		}
		if($_POST["action"] == "modify") {

			$name = sanitize($_POST["name"]);
			$email = sanitize($_POST["email"]);
			$phone = sanitize($_POST["phone"]);
			$delete = sanitize($_POST["delete"]);

			modify($name, $email, $phone, $delete);
		}
		if($_POST["action"] == "list") {

			listContacts();
		}
		
	}
	?>
	<div id="list"></div>
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