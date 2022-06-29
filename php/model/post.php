<?php
require_once "database_object.php";

class Post extends Database_object
{
    var $author;
    var $category;
    const STATUS_NOTPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->author = User::getById($this->data['user_id']);
        $this->category = Category::getById($this->data['category_id']);
    }

    public static function getPublishedPosts () 
    {
        $query = "SELECT * FROM post WHERE deleted = 0 AND published = 1";
        $result = Database::get_result_from_query($query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            array_push($data, new Post($row));
        }
        return $data;
    }

    public static function filtrByCategory ($data, $categoryId) 
    {
        $fil = [];
        foreach ($data as $post) {
            if ($post->category->data['id'] == $categoryId) 
            {
                $fil[] = $post;
            }
        }
        return $fil;
    }

    public static function filtrByOption ($option, $value) 
    {
        $data = [];
        foreach (Post::getAll() as $post) 
        {
            if ($post->data[$option] == $value)  
            {
                array_push($data, $post);
            }
        }
        return $data;
    }

    public static function resetViewCountById ($id) 
    {
        $query = "UPDATE post SET view_count = 0 WHERE id = $id";
        Database::get_result_from_query($query);
    }

    public function increaseView () 
    {
        $view_count = $this->data['view_count'] + 1;
        $this->data['view_count'] = $view_count;
        $class = strtolower(static::class);
        $query = "UPDATE $class SET view_count = $view_count WHERE id = {$this->data['id']}";
        Database::get_result_from_query($query);
    }
    public function isPublished () 
    {
        if ($this->data['published'] == 1) 
        {
            return true;
        }
        return false;
    }

    public function like_counter () 
    {
        $query = "SELECT ";
    }

    public function getCountOfComments () 
    {
        return count(Comment::byPost($this->data['id']));
        
    }

    public function getAuthor () 
    {
        return $this->author->data['first_name']." ".$this->author->data['second_name'] ;
    }

    public function getCategory () 
    {
        return $this->category->data['name'];
    }
}
