<?php

require_once('../../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMail {
  private $email;
  public function __construct() {
    $this->email = $_GET['email'];
    $this->resetPass();
  }
  public function resetPass() {
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'ghosh.ishan.27@gmail.com';                     //SMTP username
      // $mail->Password   = 'vkdawjpgdghhthuh';                               //SMTP password
      $mail->Password   = 'SMPT-password';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      //Recipients
      $mail->setFrom('ghosh.ishan.27@gmail.com', 'Ishan Ghosh');
      $mail->addAddress($this->email, 'Recipient User');     //Add a recipient
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = "Reset MySQL One Password";
      $mail->Body    = "Link To Reset Password - http://mysite.ishan.com/mysql-practice/p1/resetpass.php?email=" . urlencode($this->email);
      $mail->send();
      $resetSuccess = "Password Reset Mail Has Been Sent To ". $this->email;
      header("location: ../login.php?passreset=" . urlencode($resetSuccess));
    }
    catch (\Exception $e) {
      $mailError = "Reset Password Link Could Not Be Sent. Please Enter Correct Email ID";
      header('Location: ../forgotpass.php?forgoterror=' . urlencode($mailError));
    }
  }

}

$sendMail = new SendMail();

?>
