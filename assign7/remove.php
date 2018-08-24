<?php
	
	session_start();
	
	//ini_set('display_errors', 1); 
	//error_reporting(E_ALL);

	function sanitize($input) {
	
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
    }

    $servername = "localhost";
    $username = "n00436223";
    $password = "summer2018436223";
    $database = "n00436223";

    $cpuid = sanitize($_POST['cpuid']);

    //echo "test 1 ";

    try {

        $conn = new PDO("mysql:host=$servername; dbname=$database",
         $username, $password);
         //echo "test 2 ";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "test 3 ";

        $stmt = $conn->prepare("DELETE FROM Cpus WHERE cpuID='".$cpuid."';");

        //  echo "test 4 ";

        $stmt->execute();
        //echo "test 5 ";
    }
    catch(PDOException $e) {

        echo "Connection failed: ".$e->getMessage();
    }
    $conn = null;

    header('Location: index.php');
?>