<meta charset="UTF-8">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


	
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = '80.12.242.10';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    //$mail->Username = 'user@example.com';                 // SMTP username
    //$mail->Password = 'secret';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
	foreach($mail2 as $mails){
	$logMail = $mails["mail"];
    $mail->setFrom('Admin@gmail.com', 'Admin');
    $mail->addAddress($logMail);   
	}	
	// Add a recipient        // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
	foreach($log as $login){
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Votre compte a ete approuver';
    $mail->Body    = 'Bonjour '.$login["nom"].',<br><br> Votre compte a ete accepter, votre login est '.$login["login"].$login["nom"].', et votre mot de passe est : '.$login["password"].' <br><br> 
	Pour toute questions merci de contacter l administrateur sur notre site : <a href="http://172.17.0.15/GSBPIO/index.php?uc=accueil">GSBPIO</a><br><br> Cordialement, <br>L administrateur </b>';
	$compte = $login["login"].$login["nom"];
	$pdo->EnregistrerLogin($compte, $login["password"], $idU);
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	}
	
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>