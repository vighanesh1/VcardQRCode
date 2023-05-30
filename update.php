
<?php
include("emp_contacts.php");
 $id=$_GET['id'];
$query = "SELECT * FROM `employee_contacts` where `number`='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .submit {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="reset"] {
      background-color: #f44336;
    }
    .tab-container {
        display: flex;
        justify-content: flex-start;
        background-color: #f2f2f2;
        padding: 10px;
    }

    .tab-link {
        padding: 10px 20px;
        text-decoration: none;
        color: #000;
        border-radius: 5px 5px 0 0;
        background-color: #e0e0e0;
        transition: background-color 0.3s ease;
        margin-right: 10px;

    }

    .tab-link:last-child {
        margin-right: 0px;
    }
    .tab-link:hover {
        background-color: #ccc;
    }
  .form {
  max-width: 1300px;
  margin: 0 auto;
  padding: 30px;
  background-color: #F5F5DC;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
    
  </style>
</head>
<body>


  <div class="tab-container">
    <a class="tab-link" href="home.php">Back</a>
    <a class="tab-link" href="display.php">Display QRCodes</a>
    </div>
    <div class= "form">

  <h1>Employee Details</h1>
  <form method="post" action="#">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstname"  value = "<?php echo $data['fname'];?>"required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastname" value = "<?php echo $data['lname'];?>" required>

    <label for="department">Department:</label>
    <input type="text" id="department" name="department" value = "<?php echo $data['department'];?>" required>

    <label for="designation">Designation:</label>
    <input type="text" id="designation" name="designation" value = "<?php echo $data['designation'];?>" required>

    <label for="email">Email ID:</label>
    <input type="email" id="email" name="email"  value = "<?php echo $data['email'];?>" required>

    <label for="contactNumber">Contact Number:</label>
    <input type="tel" id="contactNumber" name="contactnumber" value = "<?php echo $data['number'];?>" required>

    <input type="submit" class="submit" name="submit" ></input>
    <button type="reset" class="submit">Reset</button>
  </form>
</form>
</body>
</html>

<?php
include("emp_contacts.php");
require_once('phpqrcode/qrlib.php'); // Include QRCode library

if(isset($_POST['submit'])) {
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $department = $_POST['department'];
  $designation = $_POST['designation'];
  $email = $_POST['email'];
  $number = $_POST['contactnumber'];

  $query = "UPDATE   `employee_contacts` SET `fname` = '$fname', `lname` = '$lname', `department` = '$department', `designation` = '$designation', `email` = '$email', `number` = '$number'";
  $insert = mysqli_query($conn, $query);
  
            // Generate and save the QR code
 $vCard = "BEGIN:VCARD\n";
$vCard .= "VERSION:3.0\n";
$vCard .= "FN:$fname $lname\n";
$vCard .= "N:$lname;$fname;;;\n";
$vCard .= "ORG:'Nitco';$department;;;$designation\n";
$vCard .= "EMAIL:$email\n";
$vCard .= "TEL:$number\n";
$vCard .= "END:VCARD";

// Generate QR code with vCard data
$qrData = "data:text/vcard;charset=utf-8," . urlencode($vCard);


  $qrFilename = "C:/xampp/htdocs/barcode/qrcode/$number.png";

  QRcode::png($vCard, $qrFilename, QR_ECLEVEL_L, 10);

  echo "QR Code generated and saved as: $qrFilename";


        }




  

?>
