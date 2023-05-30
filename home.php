
<?php session_start(); 

if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
   // Redirect the user to the login page
   header("Location: login.php");
   exit();

   setcookie($_SESSION['user_id'], "", time() - 600);
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style>
      img {
      width: 100px;
      border-radius: 50%;}
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #EEEEEE;
        color:blue;
      }
      .container {
        width: 80%;
        margin-top: 10%;
        margin-left: 10%;
        display: table;
      }
      .row {
        display: table-row;
      }
      .cell {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        opacity: 0.97;
    background: transparent;
      }
      .cell:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
      }
      .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #ffffff;
        text-decoration: none;
        border-radius: 0px;
        transition: all 0.3s ease;
      }
      .button:hover {
        background-color: #3e8e41;
      }
      h2{color: red;}
    </style>
  </head>
  <body>

    <center><h2>NITCO QR Code Generting System</h2></center>
    <center><img src = "logo.png"></center>
    <div class="container">
      <div class="row">
        <div class="cell">
          <a href="form.php" class="button">Generate QR Code</a>
        </div>
         <div class="cell">
          <a href="display.php" class="button">Display QR Codes </a>
        </div>
        
    </div>
  </body>
</html>
