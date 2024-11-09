<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = isset($_POST['form_name']) ? htmlspecialchars($_POST['form_name']) : '';
    $email = isset($_POST['form_email']) ? htmlspecialchars($_POST['form_email']) : '';
    $phone = isset($_POST['form_phone']) ? htmlspecialchars($_POST['form_phone']) : '';
    $subject = isset($_POST['form_subject']) ? htmlspecialchars($_POST['form_subject']) : 'No Subject';
    $message = isset($_POST['form_message']) ? htmlspecialchars($_POST['form_message']) : '';

    // Validate required fields (optional, you can add more validation)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Recipient email (where the message will be sent)
        $to = 'emmisonguzman@gmail.com'; // Replace with your email

        // Email subject
        $email_subject = "New Contact Form Message: $subject";

        // Email body
        $email_body = "You have received a new message from the contact form.\n\n" .
                      "Name: $name\n" .
                      "Email: $email\n" .
                      "Phone: $phone\n" .
                      "Message:\n$message";

        // Email headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            // Redirect to a success page (optional)
            header("Location: success.html");
            exit();
        } else {
            // Handle failure (optional)
            echo "Failed to send the message. Please try again.";
        }
    } else {
        // Handle missing required fields
        echo "Please fill out all required fields.";
    }
} else {
    // If the form was not submitted, redirect to the contact form page (optional)
    header("Location: contact.html");
    exit();
}
?>
