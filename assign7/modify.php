<?php
	
	session_start();
	
	ini_set('display_errors', 1); 
	error_reporting(E_ALL);

	function sanitize($input) {
	
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
    }

    $servername = "localhost";
    $username = "n00436223";
    $password = "summer2018436223";
    $database = "n00436223";

    $cpuid = sanitize($_POST['0']);
    $brand = sanitize($_POST['1']);
    $model = sanitize($_POST['2']);
    $freq = sanitize($_POST['3']);
    $cores = sanitize($_POST['4']);
    $threads = sanitize($_POST['5']);
    $socket = sanitize($_POST['6']);
    $igpu = sanitize($_POST['7']);
    $l1 = sanitize($_POST['8']);
    $l2 = sanitize($_POST['9']);

    //echo "test 1 ";

    try {

        $conn = new PDO("mysql:host=$servername; dbname=$database",
         $username, $password);
         //echo "test 2 ";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "test 3 ";

        $stmt = $conn->prepare("UPDATE Cpus SET cpuBrand = '".$brand."', 
        cpuModel = '".$model."', 
        cpuFreq = '".$freq."', 
        cpuCoreCount = '".$cores."', 
        cpuThreadCount = '".$threads."', 
        cpuSocket = '".$socket."', 
        cpuIGPU = '".$igpu."', 
        cpuL1 = '".$l1."', 
        cpuL2 = '".$l2."' 
        WHERE cpuID = '".$cpuid."';
        ");
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