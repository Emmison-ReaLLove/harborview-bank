<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['Name'] ?? '';
    $address = $_POST['Address'] ?? '';
    $bankName = $_POST['BankName'] ?? ''; // Adjusted to use consistent naming
    $dob = $_POST['DOB'] ?? '';
    $amount = $_POST['Amount'] ?? '';
    $swiftCode = $_POST['SwiftCode'] ?? ''; // Adjusted to use consistent naming
    $email = $_POST['EMail'] ?? '';
    $telephone = $_POST['Telephone'] ?? '';
    $accountType = $_POST['AccountType'] ?? ''; // Adjusted to use consistent naming

    // Perform server-side validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($telephone)) {
        $errors[] = "Telephone is required.";
    }
    if (empty($accountType)) {
        $errors[] = "Account type is required.";
    }

    // If there are no errors, process the data
    if (empty($errors)) {
        // Database connection
        $conn = new mysqli("localhost", "your_username", "your_password", "your_database_name");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO accounts (name, address, bank_name, dob, amount, swift_code, email, telephone, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssisss", $name, $address, $bankName, $dob, $amount, $swiftCode, $email, $telephone, $accountType);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Registration successful!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }

        // Close connections
        $stmt->close();
        $conn->close();
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
