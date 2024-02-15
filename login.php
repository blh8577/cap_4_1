<?php 

$con = mysqli_connect("localhost","test","1234","test") or die ("Can't access DB");
$query = "select problem from alarm where pid = '0004C053982'";
$resut=mysqli_query($con, $query);
$row = mysqli_fetch_array($resut);



echo $row['problem'];

mysqli_close($con);
?>
