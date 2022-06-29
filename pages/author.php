<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php 
    $auth_id = $_GET['author'];
    $data= Post::filtrByOption('user_id', $auth_id);

?>

<header class="masthead" style="background-image: url('assets/img/home-bg.jpg');margin-bottom: 20px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto position-relative">
                <div class="site-heading">
                    <h1>Author</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<section>

<div class="container" style="margin-top: 20px;">

<div class="row">
    <div class="col-md-10 col-lg-8">
        <?php 
            if (empty($data)) 
            {
                echo '<div class="alert alert-primary" role="alert">
                ŽÁDNÉ PŘÍSPĚVKY
              </div>';
            }
            else 
            {
                ?>
                <?php foreach ($data as $post) { ?>
                        <div class="post-preview">
                                <div class="row">
                                    <div class="col-4 d-xxl-flex justify-content-xxl-center align-items-xxl-center"><a href="post.php?post=<?php echo $post->data['id']?>"><img src="../images/<?php echo $post->data['image'] ?>" width="260px" style="width: 280px;"></a></div>
                                    <div class="col-8">
                                        <div style="padding-top: 30px;">
                                            <a href="post.php?post=<?php echo $post->data['id']?>">
                                                <h2 class="post-title"><?php echo $post->data['title']?></h2>
                                            </a>
                                            <p class="post-meta" style="margin-top: 10px;margin-    bottom: 0;">Posted by&nbsp;<a href="#"><?php echo $post->getAuthor(). " ". $post->data['date_published']?></a></p>
                                            <p class="post-meta" style="margin-top: 10px;margin-bottom: 0;">Kategorie:&nbsp;<a href="#"><?php echo $post->getCategory()?></a></p>
                                            <p class="post-meta" style="margin-top: 10px;margin-bottom: 0;">Přečteno: 50krát&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Like(0) Dislike (0)</p>
                                            <p class="post-meta" style="margin-top: 10px;">#akcie #ekonomika #neco</p>
                                        </div>
                                    </div>
                                    <p class="post-meta" style="margin-top: 5px;"><?php echo substr($post->data['text'],0,250) ?></p>
                                </div>
                            </div>
                        <hr>
                <?php } ?>
                <div class="clearfix"><button class="btn btn-primary float-end" type="button">Older Posts&nbsp;⇒</button></div>
                <?php } ?>
    </div>
    <div class="col">
        <div></div>
    </div>
</div>
</div>
</section>

<?php include "includes/footer.php" ?>