<?php
	
	session_start();
	
	//ini_set('display_errors', 1); 
	//error_reporting(E_ALL);

	function sanitize($input) {
    
        $input = strtolower($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
    }

    $servername = "localhost";
    $username = "n00436223";
    $password = "summer2018436223";
    $database = "n00436223";

    $in1 = sanitize($_GET['in1']);

    //echo "test 1 ";

    try {

        $conn = new PDO("mysql:host=$servername; dbname=$database",
         $username, $password);
         //echo "test 2 ";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "test 3 ";
        //Iterate through an array of user inputs?
        $stmt = $conn->prepare("SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuBrand) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuModel) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuFreq) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuCoreCount) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuThreadCount) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuSocket) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuIGPU) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuL1) > 0 UNION
        SELECT cpuID FROM Cpus WHERE LOCATE('".$in1."', cpuL2) > 0");

        //  echo "test 4 ";

        $stmt->execute();
        //echo "test 5 ";
        $result = $stmt->fetchAll();

        echo json_encode($result);
    }
    catch(PDOException $e) {

        echo "Connection failed: ".$e->getMessage();
    }
    $conn = null;

    //header('Location: index.php');
?>