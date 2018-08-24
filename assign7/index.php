<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<title>CPU Table with Filter</title>
    <script type="text/javascript" src="script.js"></script>
</head>
<body>

	<?php
	
	session_start();
	
	//ini_set('display_errors', 1); 
	//error_reporting(E_ALL);

	function sanitize($input) {
	
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
	
		return $input;
    }

    function isSelect($brand, $brand2) {

        if($brand == $brand2) {
            //echo "selected";
            return "selected";
        }
    }

    echo '<table align="center"><tr><td align="center" colspan="9"><h1>CPU Table with Filter</h1></td></tr>
    <tr><td align="left" colspan="9"><p>Information about different CPUs is listed below.<br>
    <ul>
        <li>To filter the table, enter a value or term associated with one or more CPUs in the box below the table.
        Results appear as text is typed.</li>
    </ul></td></tr>
    
    <tr><td>
    ';
        
    echo '<table class="a" align="center">
    <tr><th class="a" >Brand</th><th class="a" >Model</th>
    <th class="a" >Frequency (mhz)</th><th class="a" >Cores</th><th class="a" >Threads</th><th class="a" >Socket</th>
    <th class="a" >iGPU</th><th class="a" >L1 Cache</th><th class="a" >L2 Cache</th>
    <th></th></tr>';

    $servername = "localhost";
    $username = "n00436223";
    $password = "summer2018436223";
    $database = "n00436223";

    //echo "test 1 ";

    try {

        $conn = new PDO("mysql:host=$servername; dbname=$database",
         $username, $password);
         //echo "test 2 ";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "test 3 ";

        $stmt = $conn->prepare("SELECT cpuID, cpuBrand, cpuModel, cpuFreq, 
        cpuCoreCount, cpuThreadCount, cpuSocket, cpuIGPU, cpuL1, cpuL2 FROM Cpus");
          //  echo "test 4 ";

        $stmt->execute();
        //echo "test 5 ";

        //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //echo "test 6 ";
        $id = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          //  echo "test 7 ";

          $forJS = json_encode($row);

          array_push($id, $row['cpuID']);
    
            echo "
            <tr id='".$row['cpuID']."'>

            <form id='modify' accept-charset='utf-8' method='post' action='modify.php'>
            <input name='0' type='hidden' value='".$row['cpuID']."'></input>

            <td class='a'><div id='0 ".$row['cpuID']."'>".$row['cpuBrand']."</div>
            <select style='display:none;' id='input0 ".$row['cpuID']."' name='1'>
                <option ".isSelect($row['cpuBrand'], 'Intel')." value='Intel'>Intel</option>
                <option ".isSelect($row['cpuBrand'], 'AMD')." value='AMD'>AMD</option>
                <option ".isSelect($row['cpuBrand'], 'Motorola')." value='Motorola'>Motorola</option>
                <option ".isSelect($row['cpuBrand'], 'IBM')." value='IBM'>IBM</option>
                <option ".isSelect($row['cpuBrand'], 'IBM/Motorola')." value='IBM/Motorola'>IBM/Motorola</option>
                <option ".isSelect($row['cpuBrand'], 'Apple')." value='Apple'>Apple</option>
                <option ".isSelect($row['cpuBrand'], 'Samsung')." value='Samsung'>Samsung</option>
                <option ".isSelect($row['cpuBrand'], 'Qualcomm')." value='Qualcomm'>Qualcomm</option>
            </select>
            </td>

            <td class='a'><div id='1 ".$row['cpuID']."'>".$row['cpuModel']."</div>
            <input style='display:none;' id='input1 ".$row['cpuID']."' name='2' class='a' type='text' value='".$row['cpuModel']."'></input></td>
            
            <td class='a'><div id='2 ".$row['cpuID']."'>".$row['cpuFreq']."</div>
            <input style='display:none;' id='input2 ".$row['cpuID']."' name='3' class='a' type='number' value='".$row['cpuFreq']."'></input></td>
            
            <td class='a'><div id='3 ".$row['cpuID']."'>".$row['cpuCoreCount']."</div>
            <input style='display:none;' id='input3 ".$row['cpuID']."' name='4' class='a' type='number' value='".$row['cpuCoreCount']."'></input></td>
            
            <td class='a'><div id='4 ".$row['cpuID']."'>".$row['cpuThreadCount']."</div>
            <input style='display:none;' id='input4 ".$row['cpuID']."' name='5' class='a' type='number' value='".$row['cpuThreadCount']."'></input></td>
            
            <td class='a'><div id='5 ".$row['cpuID']."'>".$row['cpuSocket']."</div>
            <input style='display:none;' id='input5 ".$row['cpuID']."' name='6' class='a' type='text' value='".$row['cpuSocket']."'></input></td>
            
            <td class='a'><div id='6 ".$row['cpuID']."'>".$row['cpuIGPU']."</div>
            <input style='display:none;' id='input6 ".$row['cpuID']."' name='7' class='a' type='text' value='".$row['cpuIGPU']."'></input></td>
            
            <td class='a'><div id='7 ".$row['cpuID']."'>".$row['cpuL1']."</div>
            <input style='display:none;' id='input7 ".$row['cpuID']."' name='8' class='a' type='number' value='".$row['cpuL1']."'></input></td>
            
            <td class='a'><div id='8 ".$row['cpuID']."'>".$row['cpuL2']."</div>
            <input style='display:none;' id='input8 ".$row['cpuID']."' name='9' class='a' type='number' value='".$row['cpuL2']."'></input></td>

            <td id='".$row['cpuID']." submit' class='a'>
            <input style='display:none;' id='input9 ".$row['cpuID']."' class='a' type='submit' value='Submit'>
            <div id='9 ".$row['cpuID']."'><a href='javascript:modifyRow(\"".$row['cpuID']."\", ".$forJS.")'>Edit</a>/
            <a href='javascript:removeRow(\"".$row['cpuID']."\", ".$forJS.")'>Remove</a></div>
            </td>

            </form>
            
            </tr>";
    
        }

        $forJSID = json_encode($id);

        //Add new row at bottom with a form. Similar to script.js form
        echo "<tr><form id='add' accept-charset='utf-8' method='post' action='".
        htmlspecialchars("add.php")."'>";

        for($i=0; $i<9; $i++) {

            if($i == 0){
                echo "
                <td class='a'>
                <select form='add' name='".$i."'>
                <option value='Intel'>Intel</option>
                <option value='AMD'>AMD</option>
                <option value='Motorola'>Motorola</option>
                <option value='IBM'>IBM</option>
                <option value='IBM/Motorola'>IBM/Motorola</option>
                <option value='Apple'>Apple</option>
                <option value='Samsung'>Samsung</option>
                <option value='Qualcomm'>Qualcomm</option>
            </select>
            </td>
                ";
            }
            else if($i > 1 && $i < 5 || $i > 6 && $i < 9) {
                echo "
                <td class='a'><input class='a' type='number' name='".$i."'></input></td>
                ";
            }
            else {
                echo "
                <td class='a'><input class='a' type='text' name='".$i."'></input></td>
                ";
            }

        }

        echo "
        <td class='a'><input class='a' type='submit' value='Add'></input></td>
        </form></tr>

        
        ";
    }
    catch(PDOException $e) {

        echo "Connection failed: ".$e->getMessage();
    }
    $conn = null;

    echo '</td></tr></table>

    <tr>
    <th align="center"><div style="margin-top:10px; font-size: 25px;">Filter Results:</div></th>
    <tr>
    <td align=\'center\' colspan=\'9\'>
    <form id=\'filter\' accept-charset=\'utf-8\'>
    <input style=\'font-size: 25px; padding: 5px 5px 5px 5px;margin-bottom: 10px; display: inline-block; border: 3px solid black;\' type=\'text\' onkeyup=\'javascript:filterTable(this.value, '.$forJSID.')\'></input>
    </form>
    </td>
    </tr>
    ';

    echo '
    </table>
    <br>
    
        <table id="back" style="width:0px;" align="center">
        <tr><td>
            <a href="../index.html">Back to ePortfolio</a>
        
        </td>
        </tr>
        </table>
        
        <!--
        <div id="test">test</div>
        <div id="test2">test2</div>
        -->
        ';

    ?>
</body>
</html>