<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'milanjaukl11@gmail.com';                     //SMTP username
    $mail->Password   = 'mJ11032001*';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('support@milanjaukl.live', 'Mailer');
    $mail->addAddress('milanjaukl11@gmail.com', 'Milan Jaukl');     //Add a recipient



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>


<header class="masthead" style="background-image:url('assets/img/contact-bg.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto position-relative">
                <div class="site-heading">
                    <h1>Contact Me</h1><span class="subheading">Have questions? I have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
            <form action="contact.php" method="post" id="contactForm" name="sentMessage" novalidate="novalidate">
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input name="name" class="form-control" type="text" id="name" required="" placeholder="Name"><label class="form-label" for="name">Name</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input name="email" class="form-control" type="email" id="email" required="" placeholder="Email Address"><label class="form-label">Email Address</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><input name="phone" class="form-control" type="tel" id="phone" required="" placeholder="Phone Number"><label class="form-label">Phone Number</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div class="control-group">
                    <div class="form-floating controls mb-3"><textarea name="message" class="form-control" id="message" data-validation-required-message="Please enter a message." required="" placeholder="Message" style="height: 150px;"></textarea><label class="form-label">Message</label><small class="form-text text-danger help-block"></small></div>
                </div>
                <div id="success"></div>
                <div class="mb-3"><button class="btn btn-primary" id="sendMessageButton" type="submit" name="submit" value="contact">Send</button></div>
            </form>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>