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


$sSQL = "SELECT u_id,u_fname,u_keyboard,avg((char_length(phrase_typed)-1)/((l_timestamp -f_timestamp)/60000)) avg,(round(sum(edit_distance))) Edit_Distance,(avg((char_length(phrase_typed)-1)/((l_timestamp -f_timestamp)/60000)))-(sum(edit_distance)*0.1) adjusted,max(session_type)-1 FROM `session_details_table` inner join userdetails on userdetails._id=session_details_table.u_id where session_type between 2 and 31  group by u_id
ORDER BY `f_timestamp`  DESC";

$result = mysqli_query($conn,$sSQL);
echo "\n<html><body>";
echo "<table border=\"1\">";
echo"<td>ID</td><td>Name</td><td>keyboard</td><td>Avg_speed</td><td>Edit_Distance</td><td>Adjusted_cpm</td>
<td>Max_Session_no</td>";
while($row = mysqli_fetch_array($result)){

echo "<tr>";
echo "<td>".$row[0]."</td>";
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "<td>".$row[5]."</td>";
echo "<td>".$row[6]."</td>";


echo "</tr>";
}
echo "</table>";
echo "\n</body></html>";
mysqli_close($conn);

?>