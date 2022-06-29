<?php 
    require_once "include.php";
    if (isset($_POST['login']))
    {
        $data = $_POST;
        $result = Auth::login($data['email'], $data['password']);
        if ($result != 0) 
        {
            // nastavim uzivatele
            $_SESSION['user'] = serialize(User::getById($result));
            header("Location: ../pages/index.php");
        }
        else 
        {
            $_SESSION['login_fail'] = true;
            header("Location: ../pages/login.php");
        }
    }
    else 
    {
        unset($_SESSION['user']);
        header("Location: ../pages/index.php");
    }
    
?>