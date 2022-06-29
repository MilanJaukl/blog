<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>

    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg');margin-bottom: 20px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="d-xxl-flex justify-content-xxl-center site-heading">
                        <section class="login-clean" style="background: rgba(241,247,252,0);padding: 55px 0px;width: 500px;border-radius: 10px;">
                            <?php 
                                if (isset($_SESSION['login_fail'])) 
                                {
                                    unset($_SESSION['login_fail']);
                                    echo "<p>Spatny email nebo heslo!</p>";
                                }
                            ?>
                            <form method="post" action="../php/authMiddle.php" style="border-width: 5px;">
                                <h2 class="visually-hidden">Login Form</h2>
                                <div class="illustration"><i class="fas fa-user"></i></div>
                                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Heslo"></div>
                                <div class="mb-3"><input class="btn btn-primary d-block w-100" type="submit" name="login" value="Přihlásit se"></div>
                                <div>
                                    <a href="register.php">Ještě nemáte účet? Registruj se!</a>
                                    <a class="forgot" href="forgetPassword.html">Zapomenuté heslo</a>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php include "includes/footer.php" ?>
