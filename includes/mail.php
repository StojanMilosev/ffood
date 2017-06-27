<?php
    $cfg = include('config.php');

    if(array_key_exists('email', $_POST)){
       date_default_timezone_set('Etc/UTC');

    require 'PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
    $mail->Host = $cfg->smtp_host;
    $mail->Port = $cfg->smtp_port;
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $cfg->smtp_username;                 // SMTP username
    $mail->Password = $cfg->smtp_password;
    $mail->SMTPSecure = 'tls';
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->From = 'fast@food.com';
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('stojancina@hotmail.com');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'PHPMailer contact form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            echo $mail->ErrorInfo;
        } else {
            echo 'Order sent! Thanks for contacting us.';
        }
    } else {
        echo 'Invalid email address, message ignored.';
    } 
    }
    
?>

      