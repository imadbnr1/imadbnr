<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the registration form is submitted
    if (isset($_POST["register"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Establish a database connection
        $conn = new mysqli('localhost', 'root', '', 'mywebsite');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to insert a new record into the database
        $stmt = $conn->prepare("INSERT INTO registration (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        // Execute the statement and check if the registration was successful
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            echo "Registration successful...";
            // Redirect the user to a page after successful registration
            header("Location: account.html");
            exit;
        } else {
            echo "Registration failed.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>