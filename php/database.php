<?php 
require_once "config.php";

class Database {

    // VARRIABLES
    static $conn;
    

    private static function check_connection_to_database() 
    {
        global $conn;
            if (($conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)) != false)
            {
                return true;
            }
            else 
            {
                echo 'error in connection to database';
                return false;
            }
    }

    static function get_connection () 
    {
        global $conn;
        return $conn;
    }

    // prevent sql injection 
    static function clean_string_input ($input)
    {
        global $conn;
        if (Database::check_connection_to_database()) 
        {
            return mysqli_real_escape_string($conn, $input);
    
        }
    }    

    static function password_encrypt ($input)
    {
        return password_hash($input, PASSWORD_ARGON2I);
    }

    static function get_result_from_query ($query)
    {
        if (Database::check_connection_to_database()) 
        {
            $result = mysqli_query(Database::get_connection(), $query);
            if (!$result) 
            {
                die( "error mysql ".Database::get_connection());
                return false;
            }
            else 
            {
                return $result;
            }
        }
        
    }
}

