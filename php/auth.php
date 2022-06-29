<?php
require_once "model/user.php"; 
require_once "database.php";

class Auth 
{
    private static $user;

    public static function login ($email, $pass) 
    {
        global $user;
        $query = "SELECT * FROM user WHERE email = '$email' ";
        $results = Database::get_result_from_query($query);
        $row = mysqli_fetch_assoc($results);
        //nenasel uzivatele
        if ($row == null) 
        {
            echo "nenašel uživatele";
            return 0;
        }
        // nasel uzivatele
        else 
        {
            //spravne heslo
            if (password_verify($pass, $row['password'])) 
            {
                //ulozim uzivatele 
                echo "prihlasen";
                return $row['id'];
                
            }

            else 
            {
                echo $pass;
                echo "spatne heslo";
                return 0;
            }
        }
    }

    public static function isLogged () 
    {
        global $user;
        if ($user != null) 
        {
            return true;
        }
    }
}