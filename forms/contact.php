<?php
// Retrieve form data
$jobPos = $_POST['job-pos'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Attachment handling
$file = $_FILES['userfile'];
$filename = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileError = $file['error'];
$fileSize = $file['size'];

// Email configuration
$toEmail = "chuahyongxie@gmail.com";  // Replace with your recipient email
$subject = "New Job Application: " . $jobPos;

// Compose email content
$body = "A new job application has been submitted:\n\n";
$body .= "Job Position: $jobPos\n";
$body .= "Full Name: $name\n";
$body .= "Email: $email\n";
$body .= "Phone Number: $phone\n";
$body .= "Message:\n$message\n";

// Error handling for attachment
if ($fileError > 0) {
    $body .= "\nError: Resume could not be attached.";
} else {
    // Attachment processing
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowedTypes = array('pdf');  // Allowed file types

    if (in_array($fileType, $allowedTypes)) {
        $uploadPath = "uploads/" . $filename;
        move_uploaded_file($fileTmpName, $uploadPath);

        // Attach the file to the email
        $attachment = chunk_split(base64_encode(file_get_contents($uploadPath)));
        $body .= "--PHP-mixed-" . "\r\n" .
                 "Content-Type: application/pdf; name=\"" . $filename . "\"\r\n" .
                 "Content-Transfer-Encoding: base64\r\n" .
                 "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n" .
                 $attachment . "\r\n" .
                 "--PHP-mixed--";
    } else {
        // Invalid file type
        $body .= "\nError: Invalid file type. Only PDF files are allowed.";
    }
}

// Send the email
$headers = "From: $email\r\n" .
           "MIME-Version: 1.0\r\n" .
           "Content-Type: multipart/mixed; boundary=\"PHP-mixed-\"\r\n";

if (mail($toEmail, $subject, $body, $headers)) {
    // Success message
    echo "Application submitted successfully!";
} else {
    // Error message
    echo "An error occurred while sending the email.";
}
