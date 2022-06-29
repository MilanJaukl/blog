<?php 
include $_SERVER['DOCUMENT_ROOT']. '/cms/php/include.php';

if (!empty($_GET)) 
{
    if (isset($_GET['usersonline'])) 
    {
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 5;

        $query = "SELECT * FROM user_online WHERE ". 'session'. " = '$session'";
        $result = Database::get_result_from_query($query);
        $count = mysqli_num_rows($result);

        if ($count == NULL)
        {
            $query = "INSERT INTO user_online (".'session'.", time) VALUES ('$session', $time)";
            $result = Database::get_result_from_query($query);
        } 
        else 
        {
            $query = "UPDATE user_online SET time = $time WHERE session = "."'$session'";
            $result = Database::get_result_from_query($query);
        }
        $query = "SELECT * FROM user_online WHERE ($time - time) <= $time_out_in_seconds";
        $result = Database::get_result_from_query($query);
        echo mysqli_num_rows($result);
        }
}
