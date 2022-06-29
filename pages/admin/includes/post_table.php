<?php
    if (isset($_GET['delete'])) 
    {
        Post::deleteById($_GET['delete']);
    }

    if (isset($_POST['check'])) {
        if ($_POST['action'] == 'delete') 
        {
            foreach ($_POST['check'] as $key) {
                Post::deleteById($key);
            }
            echo 'delete';
        }
        if ($_POST['action'] == 'publish') 
        {
            foreach ($_POST['check'] as $key) {
                Post::updateById($key, ['published' => 1]);
            }
        }
        if ($_POST['action'] == 'not_publish') 
        {
            foreach ($_POST['check'] as $key) {
                Post::updateById($key, ['published' => 0]);
            }
        }
        if ($_POST['action'] == 'clone') 
        {
            foreach (array_reverse($_POST['check']) as $key) {
                $dat = Post::getById($key)->data;
                $dat['title'].= ' Cloned';
                unset($dat['id']);
                Post::create($dat);
            }
        }
        if ($_POST['action'] == 'reset_view_count') 
        {
            foreach (array_reverse($_POST['check']) as $key) {
                Post::resetViewCountById($key);
            }
        }
    }
?>

<h4>Pridavani Příspěvků</h4>
<div>
    <a class="btn btn-primary" href='post.php?add'>Přidat příspěvek</a>
</div>
<hr>
<div>
    Status
    <form method="get">
        <select name="published" id="" onchange="javascript:this.form.submit()">
            <option value="all" <?php if (!isset($_GET['published'])) { echo "selected";} else {if ($_GET['published'] == 'all') { echo "selected";}} ?>>Vše </option>
            <option value="0" <?php if(isset($_GET['published'])) { if($_GET['published'] == 0) { echo "selected";} } ?>>Nepublikováno</option>
            <option value="1"  <?php if(isset($_GET['published'])) { if($_GET['published'] == 1) { echo "selected";} } ?> >Publikováno</option>
        </select>
    </form> 
</div>
<hr>

<form method="post">
<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold">Výpis příspěvků</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 text-nowrap">
                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>&nbsp;</label></div>
            </div>
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
            </div>
        </div>
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table my-0" id="dataTable">
            <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Kategorie</th>
                        <th>Image</th>
                        <th>Published</th>
                        <th>Počet komentářů</th>
                        <th>Počet shlédnutí</th>
                        <th>Vytvořeno</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($_GET['published'])) 
                        {
                            if ($_GET['published'] != 'all') 
                            {
                                $posts = Post::filtrByOption('published', $_GET['published']);
                            }
                            else 
                            {
                                $posts = Post::getAll();
                            }
                        }
                        else 
                        {
                            $posts = Post::getAll();
                        }

                        foreach ($posts as $post) 
                        { ?>
                        <tr data-id="<?php echo $post->data['id']; ?>" class="showModal"> 
                            <td><input value="<?php echo $post->data['id'];?>" type="checkbox" name="check[]" class="check"></td>
                            <td><?php echo $post->data['id'];?></td>
                            <td><?php echo $post->data['user_id'];?></td>
                            <td><?php echo $post->data['title'];?></td>
                            <td><?php echo Category::getById($post->data['category_id'])->data['name'];?></td>
                            <td><img style="width: 70px;" src="<?php echo "../../images/".$post->data['image'];?>"> </img></td>
                            <td><?php if($post->isPublished()) {echo "Publikováno";}else {echo "Nepublikováno";} ?></td>
                            <td><?php echo $post->getCountOfComments()?></td>
                            <td><?php echo $post->data['view_count']; ?></td>
                            <td><?php echo $post->data['date_created'];?></td>
                            <td><a href="../post.php?post=<?php echo $post->data['id'];?>" target="_blank" rel="noopener noreferrer">Zobrazit</a></td>
                            <td><a href="post.php?delete=<?php echo $post->data['id'];?>">Smazat</a></td>
                            <td><a href="post.php?update=<?php echo $post->data['id'];?>">Upravit</a></td>
                        </tr>

                    <?php  } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td><input type="checkbox" name="" id="checkAll">Vybrat vse</td>
                        <td><strong><button name='action' value="delete" type="submit">Smazat</button></strong></td>
                        <td><strong><button name="action" value="publish" type="submit">Publish</button></strong></td>
                        <td><strong><button name="action" value="not_publish" type="submit">Not Publish</button></strong></td>
                        <td><strong><button name="action" value="clone" type="submit">Clone</button></strong></td>
                        <td><strong><button name="action" value="reset_view_count" type="submit">Reset View Count</button></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
            </div>
            <div class="col-md-6">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</form>