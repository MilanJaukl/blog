<?php $post = Post::getById($id); ?>
<?php 
  if (isset($_POST['update'])) 
  {
    print_r($_POST);
    // print_r($_FILES);
    // print_r($_FILES['image']);
    // echo $_FILES['image']['name'];
    $data = Form::clearPost($_POST, "update");
    if (!empty($_FILES['image']['name'])) 
    {
      $data['image'] = $_FILES['image']['name'];
      unlink("../../images/".$post->data['image']);
      move_uploaded_file($_FILES['image']['tmp_name'], "../../images/".$data['image']);
      
    }
    if (isset($_POST['published']))
    {
      $data['published'] = 1;
    }
    else 
    {
      $data['published'] = 0;
    }
    Post::updateById($post->data['id'], $data);
    $post = Post::getById($post->data['id']);
    echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img class="rounded me-2" alt="...">
              <strong class="me-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              úspěšně aktualizován <a href= "../post.php?post='.$post->data['id'].'" target="_blank" rel="noopener noreferrer">Odkaz</a>
            </div>
          </div>
        </div>';
    echo "<script> new bootstrap.Toast(document.getElementById('liveToast')).show();</script>";
    echo "ahoj";
    
  }
?>

Upravit
<form method="post" enctype="multipart/form-data">
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
      <div class="col">
      <div class="form-outline">
      <label class="form-label">Autor</label>
      <select name="user_id" class="form-select" aria-label="Default select example">
            <?php foreach (User::getPosibleAuthors() as $auth){?>
                <option value="<?php echo $auth->data['id'] ?>" <?php if($post->data['user_id'] == $auth->data['id']){echo "selected";} ?>><?php echo $auth->data['id']." - ".$auth->data['username'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Nadpis</label>
        <input name="title" value="<?php echo $post->data['title'];?>" type="text" id="form6Example1" class="form-control" />
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
      <label class="form-label">Kategorie</label>
      <select name="category_id" class="form-select" aria-label="Default select example">
            <option selected>Vyber kategorii</option>
            <?php foreach (Category::getAll() as $cat){?>
                <option value="<?php echo $cat->data['id'] ?>" <?php if($post->data['category_id'] == $cat->data['id']){echo "selected";} ?>><?php echo $cat->data['name'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>
  </div>

  <!-- File input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example3">Obrázek</label>
    <img style="width: 500px;" src="<?php echo "../../images/".$post->data['image'] ?> "></img>
    <input name="image" type="file" id="form6Example3" class="form-control" />
  </div>


  <!-- Text input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example7">Text</label>
    <textarea name="text" class="form-control" id="form6Example7" rows="4"><?php echo $post->data['text']?></textarea>
  </div>

  <div class="form-check form-switch">
    <input name="published" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php if ($post->isPublished()) {echo "checked";}?>>
    <label class="form-check-label" for="flexSwitchCheckDefault">Publikovat</label>
  </div>  

  <hr>

  <!-- Submit button -->
  <input value="Uložit" name="update" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="post.php" class="btn btn-warning">zrušit</a>
</form>