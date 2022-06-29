<?php
    session_start();
    // core
    include_once "auth.php";
    include_once "config.php";
    include_once "database.php";
    include_once "form.php";
    // models
    include_once "model/category.php";
    include_once "model/post.php";
    include_once "model/user.php";  
    include_once "model/comment.php";  