<?php
$username = "";

$password = "";

$hostname = "localhost";

$database = "expert";

$dbUser="root";
$dbHost="localhost";
$dbPasswd="";
$dbName="vkb_db";

$conn=mysqli_connect($dbHost,$dbUser,$dbPasswd,$dbName);
if (!$conn) {
    die("Database connection failed: " . mysqli_error());
}

mysqli_set_charset($conn,"utf8");
mysqli_select_db($conn,$dbName);


$sSQL = "
SELECT U_id,u_fname,u_keyboard,count(phrase_typed),((max(l_timestamp)-min(f_timestamp))/60000) 

time  FROM `session_details_table` inner join userdetails on userdetails._id=session_details_table.u_id 

where edit_distance=0 and s_id in(1,32) and f_timestamp!=0 group by u_id
ORDER BY `f_timestamp`  DESC";

$result = mysqli_query($conn,$sSQL);
echo "\n<html><body>";
echo "<table border=\"1\">";
echo"<td>ID</td><td>Name</td><td>keyboard</td><td>Correct_words</td><td>Time</td>";
while($row = mysqli_fetch_array($result)){

echo "<tr>";
echo "<td>".$row[0]."</td>";
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";



echo "</tr>";
}
echo "</table>";
echo "\n</body></html>";
mysqli_close($conn);

?>