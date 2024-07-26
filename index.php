<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the action from the form
    $action = $_POST['action']; // This will contain values like 'stop', 'right', 'left', 'back', 'forward'

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "robot";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement based on the action
    switch ($action) {
        case 'stop'  $sql = "INSERT INTO move (action) VALUES ('stop')";:
        case 'right'  $sql = "INSERT INTO move (action) VALUES ('right')";:
        case 'left' $sql = "INSERT INTO move (action) VALUES ('left')";:
        case 'back' $sql = "INSERT INTO move (action) VALUES ('back')";:
        case 'forward' $sql = "INSERT INTO move (action) VALUES ('forward')";:
          
            $sql = "INSERT INTO move (action) VALUES ('$action')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
        default:
            // Handle unexpected actions or errors
            echo "Unknown action";
            break;
    }

    // Retrieve the last input from the 'move' table
    $sql_last_input = "SELECT action FROM move ORDER BY id DESC LIMIT 1";
    $result_last_input = $conn->query($sql_last_input);

    if ($result_last_input->num_rows > 0) {
        // Output data of the last row
        $row = $result_last_input->fetch_assoc();
        echo "Last input: " . $row["action"];
    } else {
        echo "No input found";
    }

}

$conn->close();
header("Location: ghh.php"); // Redirect to another page after processing
exit();
?>