
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #DF58D3;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #EEA62F;
        }

        img {
            width: 100px;
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-bottom: 16px;
        }

        a{

            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-bottom: 16px;
            margin-right: 10px;
        }
        }
        .search{ background-color: lightcoral;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float:left;
            margin-left: 16px;


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
        margin-right: 0;
    }

    .tab-link:hover {
        background-color: #ccc;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function exportToPDF(firstName, lastName, department, designation, contactNumber, email, qrCodeUrl) {
            // Create a new HTML element with the row data
            var content = `
                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Contact Number </th>

<th>Email</th>
<th>QR Code</th>
</tr>
<tr>
<td>${firstName}</td>
<td>${lastName}</td>
<td>${department}</td>
<td>${designation}</td>
<td>${contactNumber}</td>
<td>${email}</td>
<td><img src="${qrCodeUrl}" alt="QR Code" width="100" height="100"></td>
</tr>
</table>
`;
// Generate PDF using html2pdf
html2pdf().from(content).save(contactNumber + ".pdf");
}
</script>
<script >  function searchTable() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("employeeTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var found = false;
                for (var j = 0; j < cells.length - 1; j++) {
                    var cellText = cells[j].innerText.toUpperCase();
                    if (cellText.indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? "" : "none";
            }
        } </script>

</head>
<body>
<div class="tab-container">
    <a class="tab-link" href="home.php">Home</a>
    <a class="tab-link" href="form.php">QRCode Form</a>
</div>
<dvi>
        <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()"> 
    </div>


</body>
</html>
<?php

include("emp_contacts.php");

// Fetch all employee contacts
$query = "SELECT * FROM `employee_contacts`";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table id='employeeTable'>";
    echo "<tr><th>First Name</th><th>Last Name</th><th>Department</th><th>Designation</th><th>Email</th><th>Contact Number</th><th>QR Code</th><th>Operations</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['lname'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['designation'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['number'] . "</td>";

        $qrFilename = "qrcode/" . $row['number'] . ".png";
        if (file_exists($qrFilename)) {
            echo "<td><img src='$qrFilename' alt='QR Code' width='100' height='100'></td>";
        } else {
            echo "<td>QR Code not available</td>";
        }

        echo "<td>";        
        echo "<button onclick='exportToPDF(\"" . $row['fname'] . "\", \"" . $row['lname'] . "\", \"" . $row['department'] . "\", \"" . $row['designation'] . "\", \"" . $row['number'] . "\", \"" . $row['email'] . "\", \"" . $qrFilename . "\")'>Download PDF</button> <a href = 'delete.php ? del=$row[number];' > Delete </a>  <a href = 'update.php ? id=$row[number];' > Update </a>" ;
        echo "</td>" ;  
        

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h2>No data found!</h2>";
}

mysqli_close($conn);
?>

