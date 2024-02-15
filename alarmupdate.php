<?php 

$con = mysqli_connect("localhost","test","1234","test") or die ("Can't access DB");
$query = "update alarm set problem = 1 where pid = '0004C053982'";
$resut=mysqli_query($con, $query);

mysqli_close($con);

?>
