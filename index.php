<?php
require 'mail.php';

function validate($name, $email, $subject, $message, $form) {
    return !empty($name) && !empty($email) && !empty($subject) && !empty($message);
}

$status = "";

if ( isset($_POST["form"]) ) {
    if( validate(...$_POST) ) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $body = "$name <$email> sends you the following message: <br><br> $message";

        // Send the mail
        sendMail($subject, $body, $email, $name, true);

        $status = "success";
    } else {
        $status = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact Form</title>
</head>
<body>

    <?php if ($status == "danger"): ?>
    <div class="alert danger">
        <span>There was a problem</span>
    </div>
    <?php endif; ?>

    <?php if ($status == "success"): ?>
    <div class="alert success">
        <span>Message sent succesfully!</span>
    </div>
    <?php endif; ?>

    <form action="./" method="POST">

        <h1>Contact us!</h1>

        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
        </div>

        <div class="input-group">
            <label for="email">Mail:</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="input-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject">
        </div>

        <div class="input-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message"></textarea>
        </div>

        <div class="button-container">
            <button name="form" type="submit">Send</button>
        </div>

        <div class="contact-info">
            <div class="info">
                <span><i class="fas fa-map-marker-alt"></i> 13 Saw Mill Circle, North Olmested.</span>
            </div>
            <div class="info">
                <span><i class="fas fa-phone"></i>+1 123 456 7890</span>
            </div>
        </div>

    </form>

    <script src="https://kit.fontawesome.com/fa0cbd05f5.js" crossorigin="anonymous"></script>

</body>
</html>