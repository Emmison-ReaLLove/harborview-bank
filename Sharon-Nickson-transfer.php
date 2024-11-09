<?php
// Any PHP processing logic can go here if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <script language="javascript" type="text/javascript">
        if (confirm('Thank you for the transfer. Please wait for the Process. Click OK to proceed.')) {
            window.location = 'Sharon-Nickson-process-page.html'; // Redirect to process page if OK is clicked
        } else {
            window.location = 'Sharon-Nickson-transfer-page.html'; // Redirect to transfer page if Cancel is clicked
        }
    </script>
</body>
</html>
