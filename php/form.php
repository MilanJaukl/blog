<?php 

class Form 
{
    public static function clearPOSTSubmit ($post) 
    {
        unset($post['submit']);
        return $post;
    }
    public static function clearPOSTUpdate ($post) 
    {
        unset($post['update']);
        return $post;
    }

    public static function clearPost($post, $submit) 
    {
        unset($post[$submit]);
        return $post;
    }
}
    

