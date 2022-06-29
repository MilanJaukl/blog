<?php include_once "includes/header.php" ?>
<?php include_once "includes/navbar.php" ?>

<?php 
    $errors = [];
    $keys = ['username', 'email', 'password', 'password-repeat'];
    $error_msg = "Toto pole je povinné";

    if (isset($_POST['register'])) 
    {
        $data = Form::clearPost($_POST, 'register');
        foreach ($keys as $key) {
            if (empty($data[$key])) 
            {
                $errors[$key] = true;
            }
        }

        if ($data['password'] !== $data['password-repeat']) 
        {
            $errors['password_not_match'] = true; 
        }
         

        if (empty($errors))
        {
            $data = Form::clearPost($data, 'password-repeat');
            $respond = User::registerUser($data);
            if (!$respond) 
            {
                echo "chyba";
            }   
            else 
            {
                echo "registrace úspěšná";  
            }
         }
        }
    
?>
    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg');margin-bottom: 20px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <section class="register-photo" style="--bs-body-bg: var(--bs-blue);background: rgba(241,247,252,0);">
                            <div class="form-container">
                                <div class="image-holder" style="background: url(&quot;assets/img/bull.png&quot;) no-repeat;background-size: cover;"></div>
                                <form action="register.php" method="post">
                                    <h2 class="text-center">Vytvořit účet</h2>
                                    <div class="mb-3">
                                        <input <?php if(isset($errors['username'])){ echo 'style="border: 4px solid red;"';} ?> id="username" class="form-control" type="text" name="username" placeholder="Jméno" value="<?php if(isset($_POST['username']) && !array_key_exists('username', $errors)) { echo $_POST['username'];}?>">
                                        <?php if (isset($errors['username'])){ ?>
                                        <label style="color: red;" for="username">Toto pole je povinné</label>
                                        <?php }?>
                                    </div>
                                    <div class="mb-3">
                                        <input <?php if(isset($errors['email'])){ echo 'style="border: 4px solid red;"';} ?> class="form-control" type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email']) && !array_key_exists('email', $errors)) { echo $_POST['email'];}?>"></div>
                                        <?php if (isset($errors['email'])){ ?>
                                        <label style="color: red;" for="username">Toto pole je povinné</label>
                                        <?php }?>
                                    <div class="mb-3">
                                        <input <?php if(isset($errors['password'])){ echo 'style="border: 4px solid red;"';} ?> class="form-control" type="password" name="password" placeholder="Heslo" value="<?php if(isset($_POST['password']) && !array_key_exists('password', $errors)) { echo $_POST['password'];}?>">
                                        <?php if (isset($errors['password'])){ ?>
                                        <label style="color: red;" for="username">Toto pole je povinné</label>
                                        <?php }?>
                                    </div>
                                    <div class="mb-3">
                                        <input <?php if(isset($errors['password-repeat']) || isset($errors['password_not_match'])){ echo 'style="border: 4px solid red;"';} ?> class="form-control" type="password" name="password-repeat" placeholder="Heslo znova" value="<?php if(isset($_POST['password-repeat']) && !array_key_exists('password_not_match', $errors)) { echo $_POST['password'];}?>">
                                        <?php if (isset($errors['password-repeat'])){ ?>
                                        <label style="color: red;" for="username">Toto pole je povinné</label>
                                        <?php }?>
                                        <?php if (isset($errors['password_not_match'])){ ?>
                                        <label style="color: red;" for="username">Hesla se neshodují</label>
                                        <?php }?>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">Souhlasím s podmínkami&nbsp;</label></div>
                                    </div>
                                    <div class="mb-3">
                                        <input class="btn btn-primary d-block w-100" type="submit" name="register" value="register" placeholder="Registrovat se">
                                        <?php if(!empty($errors)) { echo "<p style='color:red'>musíte vyplnit povinná pole<p/>";}?>
                                    </div>
                                    <a class="already" href="login.html">Máte již vytvořený účet? Přihlásit se</a>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php include "includes/footer.php" ?>