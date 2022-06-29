<?php

include $_SERVER['DOCUMENT_ROOT']. '/cms/php/database.php';

class Database_object
{
    // parr
    public $data = [];

    // construct
    function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (is_null($value)) 
            {   
                $this->data[$key] =  'null';
            }
            else 
            {
                $this->data[$key] =  $value;
            }
            
        }
    }

    public static function getAdvanced ($options, $orderBy, $limitStart, $limitEnd) 
    {
        $class = strtolower(static::class);
        $query = "SELECT * FROM $class";
        // projet filtr 
        if (!empty($options)) 
        {
            $query .= " WHERE " ;
            foreach ($options as $column => $value) {
                if (is_numeric($value)) 
                {
                    $query .= "$column = $value AND";
                }
                else 
                {
                    $query .= "$column = '$value' AND";
                }
            }
            // smazat posledni and
            $query = substr($query, 0, -3);
        }
        
        // projet order 
        $query .= " ORDER BY";
        foreach ($orderBy as $column => $order) {
            if ($order == 'DESC') 
            {
                $query .= " $column DESC,";
            }
            else 
            {
                $query .= " $column ASC,";
            }
        }
        $query = substr($query, 0, -1);
        $query .= " LIMIT $limitStart, $limitEnd";
        echo $query;
        $result = Database::get_result_from_query($query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($data, new $class($row));
        }
        return $data;


    }

    public static function getCountOfAdvancedSelect ($options) 
    {
        $class = strtolower(static::class);
        $query = "SELECT count(1) FROM $class";
        // projet filtr 
        if (!empty($options)) 
        {
            $query .= " WHERE " ;
            foreach ($options as $column => $value) {
                if (is_numeric($value)) 
                {
                    $query .= "$column = $value AND";
                }
                else 
                {
                    $query .= "$column = '$value' AND";
                }
            }
            // smazat posledni and
            $query = substr($query, 0, -3);
        }
        $result = Database::get_result_from_query($query);
        return mysqli_fetch_assoc($result)['count(1)'];
    }

    // static crud
    public static function getAll()
    {
        $class = strtolower(static::class);
        $query = "SELECT * FROM $class WHERE deleted = 0 ORDER BY id DESC";
        $result = Database::get_result_from_query($query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($data, new $class($row));
        }
        return $data;
    }


    public static function getAllPaginate($start, $number)
    {
        $class = strtolower(static::class);
        $query = "SELECT * FROM $class WHERE deleted = 0 ORDER BY id DESC LIMIT $start, $number";
        $result = Database::get_result_from_query($query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($data, new $class($row));
        }
        return $data;
    }
    
    public static function getById($id) 
    {
        $class = strtolower(static::class);
        $query = "SELECT * FROM $class WHERE deleted = 0 AND id = $id";
        $result = Database::get_result_from_query($query);
        return new $class(mysqli_fetch_assoc($result));
    }

    public static function create($data) 
    {
        $class = $class = strtolower(static::class);
        $startQuery = "INSERT INTO $class ";
        $parr = "(";
        $values = "(";

        // podle poskytnutých dat vytořím dynamcky query
        foreach ($data as $key => $value) {
            $value = Database::clean_string_input($value);
            $parr = $parr.$key.",";
            // pokud to je číslo
            if (is_numeric($value)) 
            {
                $values = $values.$value.",";
            }
            else 
            {
                $values = $values."'".$value."'".",";
            }
            
        }
        $parr = substr($parr, 0, -1);
        $values = substr($values, 0, -1);
        $parr = $parr.")";
        $middle = " VALUES ";
        $values = $values.")";
        $fullQ = $startQuery.$parr.$middle.$values;
        $result = Database::get_result_from_query($fullQ);
        if  (!$result) 
        {
            return false;
        }
        else 
        {
            // $query = "SELECT * FROM post WHERE user_id = ".$data['user_id']." AND title = '".$data['title']."'";
            // return new $class(mysqli_fetch_assoc(Database::get_result_from_query($query)));
            return true;
        }
    }

    public static function deleteById ($id) 
    {
        $class = $class = strtolower(static::class);
        $query = "UPDATE $class SET deleted = 1 WHERE id = $id";
        $result = Database::get_result_from_query($query);
    }

    public static function updateById($id, $data) 
    {
        $class = $class = strtolower(static::class);
        $query = "UPDATE $class SET ";
        foreach ($data as $key => $value) {
            $mem = $key. "= ";
            if (is_numeric($value)) 
            {
                // $mem .= $value 
                $mem = $mem.$value;
            }
            else 
            {
                $mem = $mem."'".$value."'";  
            }
            $query = $query.$mem.",";
        }
        $query = substr($query, 0, -1);
        $query = $query." WHERE id = $id";
        $result = Database::get_result_from_query($query);
    }

    // non-static

    public function updateColumn ($column, $value) 
    {
        $class = strtolower(static::class);
        $query = "UPDATE $class SET $column = $value WHERE id = {$this->data['id']}";
        echo $query;
    }

    public function isDeleted () 
    {
        if ($this->data['deleted'] == 1) 
        {
            return true;
        }
        return false;
    }

    public function isDeletedText () 
    {
        if ($this->data['deleted'] == 1) 
        {
            return "Ano";
        }
        return "Ne";
    }

    public function getData() 
    {
        global $data;
        return $data;
    }

    function getByAttributs () 
    {
        
    }

    public function showDataColumn () 
    {
        return array_keys($this->data);    
    }
    

    public function getId () 
    {
        return $this->data['id'];
    }

    public static function getChildClass() 
    {
        
    }

}