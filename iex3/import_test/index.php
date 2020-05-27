
<!doctype>
<html>
<head>
</head>
<body>
<?php

    
    include '../../conn.php';
require_once "Classes/PHPExcel.php";

		$tmpfname = "test.xls";
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		
		echo "<table>";
		for ($row = 1; $row <= $lastRow; $row++) {
			// echo "<tr><td>";
			// echo $worksheet->getCell('A'.$row)->getValue() . ',';
			// echo "</td><td>";
			// echo $worksheet->getCell('B'.$row)->getValue();
			// echo "</td><td>";            
			// echo $worksheet->getCell('C'.$row)->getValue();
			// echo "</td><tr>";
            
            //insert to array
         $my_array[] = $worksheet->getCell('A'.$row)->getValue();
         $my_epf_start[] = $worksheet->getCell('D'.$row)->getValue();
            
            //mysqli_query($conn, "UPDATE epf_formula SET epf_formula_year = ''");
		}
    $count = 0;
    //echo $my_epf_start[1];
    foreach($my_array as $ma){
        
        echo $count . '<br>';
        
        $my_epf_start[$count];
        
       // echo $ma . '<br>'; // ma is ID
        //do update based on ID
        //get all ID based on MA
        $get_epf_id_sql = mysqli_query($conn, "SELECT * FROM epf_formula WHERE epf_formula_id = '$ma'");
        $gei_result = mysqli_fetch_assoc($get_epf_id_sql);
        $gr_id = $gei_result["epf_formula_id"];
        //do update
        $update_sql = mysqli_query($conn, "UPDATE epf_formula SET epf_formula_year = '$my_epf_start[$count]' WHERE epf_formula_id = '$gr_id'");
        $count = $count + 1;
    }
    
    
    
		echo "</table>";	
?>

</body>
</html>