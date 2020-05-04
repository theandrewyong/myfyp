<?php
include "conn.php";
$mydemo = '<p id="demo"></p>';
if(isset($_POST["submit"])){
    $mydemo = '<p id="demo"></p>';
    $get_javascript = "";
    echo $mydemo;
}



?>
<form action="javascript_test.php" method="POST">
<select id="mySelect" onchange="myFunction()" name="select">
  <option value="Audi">Audi
  <option value="BMW">BMW
  <option value="Mercedes">Mercedes
  <option value="Volvo">Volvo
</select>
    <input type="submit" name="submit">
</form>


<p id="demo"></p>

<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>