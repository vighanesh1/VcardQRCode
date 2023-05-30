<?php
$servername ="localhost";
$username ="root";
$password = "";
$dbname = "emp_contacts";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
	//echo "connection established";
}
else
{
	echo "connection failed";

}