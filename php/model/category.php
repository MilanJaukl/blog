<?php

require_once "database_object.php";

class Category extends Database_object
{

    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function isActive () 
    {
        if ($this->data['active'] == 1)
        {
            return true;
        }
        return false;
    }

    public function numberOfPosts () 
    {
        $id = $this->getId();
        $query = "SELECT * FROM post WHERE category_id = '$id'";
        $result = Database::get_result_from_query($query);
        
        return $result->num_rows;
        
    }


    
}
