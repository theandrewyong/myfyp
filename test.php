employee table

<table border="1">
    <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Wages</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Andrew</td>
        <td>100</td>
    </tr>
</table>

Payslip table
<table border="1">
    <tr>
        <th>Payslip ID</th>
        <th>Name</th>
        <th>Wages</th>
    </tr>
    <tr>
        <td>p1</td>
        <td>Andrew</td>
        <td>100</td>
    </tr>
</table>

form for processing
<form action="test.php" method="post" enctype="multipart/form-data">
    <input type="hidden" value="1" name="emp_id">
    emp name<input type="text" name="emp_name">
    emp wages<input type="text" name="emp_wages">
    <input type="submit" name="submit">
</form>

<?php
$emp_id = "";
$emp_name = "";
$emp_wages = "";
$payslip_id = "";

if(isset($_POST["submit"])){
    //get emp info first
    $emp_id = $_POST["emp_id"];
    $emp_name = $_POST["emp_name"];
    $emp_wages = $_POST["emp_wages"];
    
    //for payslip, create payslip with existing info
    //created id etc for payslip table.
    $payslip_id = "p1";
    //after create, update it with its required info
    //update payslip where is is p1
    
}



?>


Processed payslip table
<table border="1">
    <tr>
        <td><?php echo $emp_id; ?></td>
        <td><?php echo $emp_name; ?></td>
        <td><?php echo $emp_wages; ?></td>
        <td><?php echo $payslip_id; ?></td>
    </tr>
</table>

Processed epf table
<table border="1">
    <tr>
        <td><?php echo $emp_id; ?></td>
        <td><?php echo $emp_name; ?></td>
        <td><?php echo $emp_wages; ?></td>
        <td><?php echo $payslip_id; ?></td>
    </tr>
</table>