<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php 
    if (isset($_GET['post'])) 
    {
        $post = Post::getById($_GET['post']);
        $post->increaseView();
    }
    

    if (isset($_POST['comment'])) 
    {
        $data = Form::clearPost($_POST, 'comment');
        $data['post_id'] = $post->data['id'];
        $data['user_id'] = 0;
        Comment::create($data);
    }
?>

    <header class="masthead" style="background-image:url('assets/img/post-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="post-heading">
                        <h1><?php echo $post->data['title'] ?></h1>
                        <?php 
                           if ($USER != false)
                           {
                                if ($USER->data['id'] == $post->data['user_id']) 
                                {
                                    echo "<a class='btn btn-success' href='./admin/post.php?update={$post->data['id']}'>upravit</a>";
                                }
                           }
                        ?>
                        <h2 class="subheading">Druhý nadpis static</h2>
                        <span class="meta">Posted by&nbsp;<a href="author.php?author=<?php echo $post->author->data['id']?>"><?php echo $post->getAuthor(); ?></a>&nbsp;on August 24, 2018</span>
                        <span>Zobrazeno: <?php echo $post->data['view_count']?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <article>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <p>
                        <?php echo $post->data['text']; ?>
                    </p>         
                    <a href="#"><img class="img-fluid" src="../images/<?php echo $post->data['image']; ?>"></a><span class="text-muted caption">To go places and do things that have never been done before – that’s what living is all about.</span>
                    
                </div>
            </div>
        </div>
    </article>

    <section class="mb-5 col-5 mx-auto">
        <div class="card bg-light">

            <div class="card-body">
                <!-- Comment form-->
                <i class="bi bi-person-circle"></i> Anonym
                <form method="post" class="mt-2 mb-4">
                    <textarea name="text" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" required></textarea>
                    <input class="mt-2 btn btn-primary" name="comment" type="submit" value="Přidat komentář">
                </form>

                <?php foreach (Comment::byPost($post->data['id']) as $comm) { ?>

                <!-- Single comment-->
                <div class="mt-3 d-flex">
                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                    <div class="ms-3">
                        <div class="fw-bold"><?php if ($comm->getAuthor() != null) {echo $comm->getAuthor()->data['name'];} else { echo "Anonym";} echo " ".$comm->data['date_of_create'];   ?></div>
                        <div><?php echo $comm->data['text']?></div>
                        <button>Odpovědět</button>
                        <button>Like</button>
                         
                    </div>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include "includes/footer.php" ?>