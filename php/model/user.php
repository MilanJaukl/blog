<?php

require_once "database_object.php";

class User extends Database_object
{
    // role
    const ROLE_USER = 0;
    const ROLE_AUTHOR = 1;
    const ROLE_ADMIN = 2;

    // status
    const STATUS_ONLINE = 0;
    const STATUS_BANNED = 1;

    public function __construct($data)
    {
        parent::__construct($data);
    }

    public static function getPosibleAuthors () 
    {
        $query = "SELECT * FROM user WHERE role = ".User::ROLE_AUTHOR." OR role = ".User::ROLE_ADMIN;
        $result = Database::get_result_from_query($query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) 
        {
            array_push($data, new User($row));
        }
        return $data;
    }

    public static function getArrayOfUserTypes () 
    {
        $array = [];
        $array['users'] = [];
        $array['authors'] = [];
        $array['admins'] = [];
        foreach (User::getAll() as $user) {
            if ($user->data['role'] == User::ROLE_USER) 
            {
                array_push($array['users'], $user);
            }
            if ($user->data['role'] == User::ROLE_AUTHOR) 
            {
                array_push($array['authors'], $user);
            }
            if ($user->data['role'] == User::ROLE_ADMIN) 
            {
                array_push($array['admins'], $user);
            }
        }
        return $array;
    }

    
    public static function loginUser ($email, $password) 
    {
        $query = "SELECT * FROM user WHERE email = .$email.";
        
    }

    public static function banUser ($id) 
    {
        $query = "UPDATE user SET status =".User::STATUS_BANNED." WHERE id = $id";
        return Database::get_result_from_query($query);
    }

    public static function unbanUser ($id) 
    {
        $query = "UPDATE user SET status =".User::STATUS_ONLINE." WHERE id = $id";
        return Database::get_result_from_query($query);
    }

    public static function registerUser ($data)
    {
        if (!array_key_exists('image', $data)) 
        { 
            $data['image'] = 'default_avatar.svg';
        }
        $data['password'] = Database::password_encrypt($data['password']);
        return User::create($data);
    }

    public function getNameOfRole () 
    {
        if ($this->data['role'] == User::ROLE_ADMIN) 
        {
            return "Admin";
        }
        elseif ($this->data['role'] == User::ROLE_AUTHOR)
        {
            return "Autor";
        }
        else 
        {
            return "Uživatel";
        }
    }

    public function getStatusText () 
    {
        if ($this->data['status'] == User::STATUS_ONLINE) 
        {
            return "Online";
        }
        elseif ($this->data['status'] == User::STATUS_BANNED)
        {
            return "Zabanován";
        }
    }

    public function isBanned () 
    {
        return $this->data['status'] == User::STATUS_BANNED ? true : false;
    }
    
}


//     
//     function update ($user, $change) 
//     {
//         global $conn;
//         $query = "UPDATE user SET username = '$change->name', password = '$change->password' WHERE id = '$user->id'";
//         $result = mysqli_query($conn, $query); 
//         if ($result)
//         {
//             echo "done";
//         }   
//         else 
//         {
//             die("QUERY failed". mysqli_error($conn));
//         }
//     }
//     function delete ($user)
//     {
//         global $conn;
//         $query = "DELETE from user WHERE id = '$user->id'";
//         $result = mysqli_query($conn, $query); 
//         if ($result)
//         {
//             echo "done";
//         }   
//         else 
//         {
//             die("QUERY failed". mysqli_error($conn));
//         }
//     }