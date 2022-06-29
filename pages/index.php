<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php
    $data = [];
// pagination
    $startP = 0;
    $page = 1;
    $numberOfPosts = 5;
    $countOfPosts = 0;
// filtr
    $selectCategory = [];

// requests
    if(isset($_GET['category']))
    {
        if ($_GET['category'] != "all") 
        {
            $selectCategory['category_id'] = $_GET['category'];
        }
    }
    
    if (isset($_GET['page'])) 
    {
        $startP = ($_GET['page']-1)*$numberOfPosts;
        $page = $_GET['page'];
    }

     $data = Post::getAdvanced($selectCategory, ['id' => 'DESC'], $startP,$numberOfPosts);
     $countOfPosts = Post::getCountOfAdvancedSelect($selectCategory);

?>

    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg');margin-bottom: 20px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section style="margin-left: 36px;margin-right: 36px;padding-right: 12px;padding-left: 12px;border-top-width: 1px;border-top-style: solid;border-bottom-width: 1px;border-bottom-style: solid;">
        <div class="col-2">
            <form method="get">
                <label for="exampleFormControlSelect1">Vyber kategorii</label>
                <select <?php if (isset($_GET['category']) && $_GET['category'] != "all") {echo "style='background-color:yellow'";}?> name="category" class="form-control" id="exampleFormControlSelect1" onchange="javascript:this.form.submit()">    
                <option <?php if (isset($_GET['category']) && $_GET['category'] == "all") { echo "selected";}?> value="all">Všechny</option>
                    <?php 
                    foreach (Category::getAll() as $category){ ?>
                    <?php
                        if (isset($_GET['category']) && $_GET['category'] == $category->data['id'])
                        {
                            echo "<option value={$category->data['id']} selected>{$category->data['name']}</option>";
                        }
                        else
                        {
                            echo "<option value={$category->data['id']}>{$category->data['name']}</option>";
                        }
                    }  
                    ?>
                </select>
            </form>
        </div>          
        <?php if (isset($_POST['submit'])) { echo $_POST['search']; }?>
    </section>

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
                        <?php foreach($data as $post) {?>
                                <div class="post-preview">
                                        <div class="row">
                                            <div class="col-4 d-xxl-flex justify-content-xxl-center align-items-xxl-center"><a href="post.php?post=<?php echo $post->data['id']?>"><img src="../images/<?php echo $post->data['image'] ?>" width="260px" style="width: 280px;"></a></div>
                                            <div class="col-8">
                                                <div style="padding-top: 30px;">
                                                    <a href="post.php?post=<?php echo $post->data['id']?>">
                                                        <h2 class="post-title"><?php echo $post->data['title']?></h2>
                                                    </a>
                                                    <p class="post-meta" style="margin-top: 10px;margin-bottom: 0;">Posted by&nbsp;<a href="#"><?php echo $post->getAuthor(). " ". $post->data['date_published']?></a></p>
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
                        <nav aria-label="pagination">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                                </li>
                                <?php for ($i=1; $i <= ceil($countOfPosts/$numberOfPosts); $i++) {?>
                                    <li class="page-item <?php if ($page == $i) {echo "active";}?>">
                                        <a class="page-link" href="index.php?page=<?php echo $i?>"><?php echo $i; ?></a>
                                    </li>
                                <?php }?>

                                <!-- <li class="page-item active">
                                    <a class="page-link" href="#"><?php echo $i; ?></a>
                                </li> -->
                                <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="clearfix"><button class="btn btn-primary float-end" type="button">Older Posts&nbsp;⇒</button></div>
                        <?php } ?>
            </div>
            <div class="col">
                <div></div>
            </div>
        </div>
    </div>

    <script>

    </script>

    <?php include "includes/footer.php" ?>