<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php 
    $post_to = "support@milanjaukl.live";
    $post_to = "milanjaukl11@gmail.com";
    if (isset($_POST['submit'])) 
    {
        $msg = "Message From: ".$_POST['name']."\n";
        $msg .= "Email: ".$_POST['email']. "\n";
        $msg .= "Phone: ".$_POST['phone']. "\n";
        $msg .= wordwrap($_POST['message'], 70);
        mail($post_to,"subject", $msg);
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