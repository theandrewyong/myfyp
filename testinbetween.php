<?php
include "conn.php";
$get_epf_table_sql = mysqli_query($conn, "SELECT process_payroll.epf_employee_deduction, process_payroll.epf_employer_deduction, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id");
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Employe Name</th>
        <th>Wages</th>
        <th>Employee</th>
        <th>Employer</th>
        <th>Total</th>
    </tr>
<?php
    $total_wages = 0;
    $total_employee_deduction = 0;
    $total_employer_deduction = 0;
    $total = 0;
    while($epf_table = mysqli_fetch_assoc($get_epf_table_sql)){
        $epf_emp_id = $epf_table["emp_id"];
        $epf_emp_full_name = $epf_table["emp_full_name"];
        $epf_emp_wages = $epf_table["emp_wages"];
        $epf_emp_employee_deduction = $epf_table["epf_employee_deduction"];
        $epf_emp_employer_deduction = $epf_table["epf_employer_deduction"];
        $epf_total = $epf_emp_employee_deduction + $epf_emp_employer_deduction;
        
        echo '<tr>';
        echo '<td>' . $epf_emp_id . '</td>';
        echo '<td>' . $epf_emp_full_name . '</td>';
        echo '<td>' . $epf_emp_wages . '</td>';
        echo '<td>' . $epf_emp_employee_deduction . '</td>';
        echo '<td>' . $epf_emp_employer_deduction . '</td>';
        echo '<td>' . $epf_total . '</td>';
        echo '</tr>';   
        //count everything and put in an array
        $total_wages += $epf_emp_wages;
        $total_employee_deduction += $epf_emp_employee_deduction;
        $total_employer_deduction += $epf_emp_employer_deduction;
        $total += $epf_total;
    }
?>
    <tr>
        <td></td>
        <td></td>
        <td><?php echo $total_wages; ?></td>
        <td><?php echo $total_employee_deduction; ?></td>
        <td><?php echo $total_employer_deduction; ?></td>
        <td><?php echo $total; ?></td>
    </tr>
</table>