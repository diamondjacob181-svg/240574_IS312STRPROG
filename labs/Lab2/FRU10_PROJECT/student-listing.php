<?php
/*
Author: George Jacob
ID: 240574
Date: 3/21/2026
Unit: IS312 

Description:
This page retrieves all student records from the Student table
in the FRU10 database and displays them in a tabular format.
It connects to the database, executes a SELECT query,
and outputs the results in an HTML table.
*/
?>

<?php
$conn = new mysqli("localhost", "root", "", "FRU10");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Student");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Listing</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        text-align: center;
        margin-top: 60px;
    }

    h2 {
        color: #333;
    }

    table {
        margin: auto;
        border-collapse: collapse;
        width: 80%;
        background-color: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e9ecef;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
    }

    a:hover {
        background-color: #1e7e34;
    }
</style>

</head>
<body>

<h2>Student Listing</h2>

<table>
<tr>
    <th>StudentNo</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Gender</th>
    <th>ContactNo</th>
    <th>ProgramCode</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row['StudentNo']."</td>
        <td>".$row['Firstname']."</td>
        <td>".$row['Lastname']."</td>
        <td>".$row['Gender']."</td>
        <td>".$row['ContactNo']."</td>
        <td>".$row['ProgramCode']."</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
?>

</table>

<a href="index.html">Back to Home</a>

</body>
</html>

<?php $conn->close(); ?>