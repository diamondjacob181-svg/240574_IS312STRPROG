<?php
/*
Author: George Jacob
ID: 240574
Date: 3/21/2026
Unit: IS312 

Description:
This script processes the form data submitted from new-program.html.
It retrieves Program Code and Program Name using POST method.
The data is validated and then inserted into the Program table in the FRU10 database.
It displays a success message if insertion is successful, otherwise an error message.
*/
?>



<?php
$conn = new mysqli("localhost", "root", "", "FRU10");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only run when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if values exist
    if (isset($_POST['programCode']) && isset($_POST['programName'])) {

        $code = $_POST['programCode'];
        $name = $_POST['programName'];

        // Prevent empty input
        if (empty($code) || empty($name)) {
            echo "All fields are required!";
            exit();
        }

        // Check duplicate first
        $check = "SELECT * FROM Program WHERE ProgramCode='$code'";
        $result = $conn->query($check);

        if ($result->num_rows > 0) {
            echo "Program Code already exists!";
        } else {

            $sql = "INSERT INTO Program (ProgramCode, ProgramName)
                    VALUES ('$code', '$name')";

            if ($conn->query($sql) === TRUE) {
                echo "Program added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }

    } else {
        echo "Form data not received!";
    }
}

$conn->close();
?>