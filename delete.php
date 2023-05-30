<?php
include("emp_contacts.php");
$quer=$_GET['del'];
echo $quer;
$delete="DELETE FROM employee_contacts WHERE `number` = '$quer'";
$con = mysqli_query($conn,$delete);
if($con > 0)
{
	echo '<script>alert("DATA DELETED SUCCESSFULLY")</script>';
	header("location:display.php ");
}

$data="$quer.png";
        $dir = "qrcode";
        $dirHandle = opendir($dir);
        while ($file = readdir($dirHandle)) {
            if($file==$data) {
                unlink($file);
            }
        }

        closedir($dirHandle);


?>