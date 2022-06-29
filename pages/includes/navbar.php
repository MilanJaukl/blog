<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="index.php">Brand</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <div class="float-start float-md-end mt-5 mt-md-0 search-area"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Domů</a></li>
                    <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">O nás</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontakt</a></li>

                    <?php 
                        if (isset($_SESSION['user']))
                        {
                            $role = unserialize($_SESSION['user'])->data['role'];
                            if ($role == User::ROLE_USER) 
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="admin/index.php">Profil</a></li>'; 
                            }
                            elseif ($role == User::ROLE_AUTHOR)
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="admin/index.php">Správce blogu</a></li>';
                            }
                            else 
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="admin/index.php">Správce webu</a></li>';
                            }
                        }
                    ?>

                    <div class="dropdown" style="font-size: 15px;">
                        <button class="nav-item dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if (isset($_SESSION['user'])){ $user = unserialize($_SESSION['user']);?>
                            <img class="rounded-circle me-2" width="30" height="30" src="../images/userProfiles/<?php echo $user->data['image']; ?>"><?php echo $user->data['first_name']. " ".$user->data['second_name'] ?> 
                        <?php } else { ?>
                        <i class="far fa-user"></i>&nbsp;Přihlásit se
                        <?php } ?>
                        
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php if (isset($_SESSION['user'])){ ?>
                                <button>Nastavení</button>
                                <button>Upozornění</button>
                                <hr>
                                <button><a href="/cms/php/authMiddle.php">Odhlásit se</a></button>    

                            <?php }else{?>

                            <form action="../php/authMiddle.php" method="post">
                                <p class="hint-text">Sign in with your social media account</p>
                                <div class="form-group social-btn clearfix">
                                    <a href="#" class="btn btn-secondary facebook-btn float-left"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="#" class="btn btn-secondary twitter-btn float-right"><i class="fa fa-twitter"></i> Twitter</a>
                                </div>
                                <div class="or-seperator"><b>or</b></div>
                                <div class="form-group">
                                    <input name="email" type="text" class="form-control" placeholder="Username" required="required">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" placeholder="Password" required="required">
                                </div>
                                <input name="login" type="submit" class="btn btn-primary btn-block" value="Login">
                                <div class="text-center mt-2">
                                    <a href="#">Forgot Your password?</a>
                                </div>
                            </form>
                            <hr>
                            <a href="register.php">Registrovat se</a>

                            <?php } ?>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
</nav>