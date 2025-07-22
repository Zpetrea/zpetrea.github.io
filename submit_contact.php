<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = isset($_POST["phone"]) ? strip_tags(trim($_POST["phone"])) : 'N/A';
    $message = trim($_POST["message"]);

    if ($name && $email && $message) {
        $to = "zpetrea1@gmail.com"; // Replace with your actual email address
        $subject = "New Contact or Quote Request from $name";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: $name <$email>";

        if (mail($to, $subject, $body, $headers)) {
            header("Location: contact.html?status=success");
            exit;
        } else {
            header("Location: contact.html?status=error");
            exit;
        }
    } else {
        header("Location: contact.html?status=invalid");
        exit;
    }
}
?>
