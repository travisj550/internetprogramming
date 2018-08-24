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

    $brand = sanitize($_POST['0']);
    $model = sanitize($_POST['1']);
    $freq = sanitize($_POST['2']);
    $cores = sanitize($_POST['3']);
    $threads = sanitize($_POST['4']);
    $socket = sanitize($_POST['5']);
    $igpu = sanitize($_POST['6']);
    $l1 = sanitize($_POST['7']);
    $l2 = sanitize($_POST['8']);

    //echo "test 1 ";

    try {

        $conn = new PDO("mysql:host=$servername; dbname=$database",
         $username, $password);
         //echo "test 2 ";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "test 3 ";

        $stmt = $conn->prepare("INSERT INTO Cpus (cpuBrand, cpuModel, cpuFreq, 
        cpuCoreCount, cpuThreadCount, cpuSocket, cpuIGPU, cpuL1, cpuL2) 
        VALUES('".$brand."','".$model."','".$freq."','".$cores."','".$threads.
        "','".$socket."','".$igpu."','".$l1."','".$l2."');
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