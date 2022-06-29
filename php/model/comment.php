<?php 

require_once "database_object.php";

class Comment extends Database_object 
{
    const STATUS_ONLINE = 0;
    const STATUS_BANNED = 1;
    var $author;


    public function __construct($data)
    {
        parent::__construct($data);
        if ($data['user_id'] == 0) 
        {
            $this->author = null;
        }
        else 
        {
            $this->author = User::getById($data['user_id']);
        }
    }

    public static function byPost ($id) 
    {
        $data = [];
        foreach (Comment::getAll() as $comm) {
            if ($comm->data['post_id'] == $id && !$comm->isBanned()) 
            {
                array_push($data, $comm);
            }
        }
        return $data;
    }

    public static function getReadiblePosts () 
    {
        $data = [];
        foreach (Comment::getAll() as $comm) {
            if (!$comm->isBanned()) 
            {
                array_push($data, $comm);
            }
        }
        return $data;
    }

    public function isBanned() 
    {
        if ($this->data['status'] == Comment::STATUS_BANNED) 
        {
            return true;
        }
        return false;
    }

    public function getAuthor () 
    {
        return $this->author;
    }
}