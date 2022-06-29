<?php 
    if (isset($_POST['create'])) 
    {
        $data = Form::clearPost($_POST, 'create');

        if (isset($data['blocked'])) 
        {
        $data['status'] = 1;
        }
        else 
        {
        $data['status'] = 0; 
        }
        $respond = Comment::create($data);   
    }
?>

<h4 class="text-dark mb-4">Přidat komentář</h4>
<form method="post">
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">

  <div class="col">
      <div class="form-outline">
      <label class="form-label">User</label>
        <select name="user_id" class="form-select" aria-label="Default select example">
            <option value="00" selected>Vyber Uživatele</option>
            <?php foreach (User::getAll() as $cat){?>
                <option value="<?php echo $cat->data['id'];?>"><?php echo $cat->data['name'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>

    <div class="col">
      <div class="form-outline">
      <label class="form-label">Post</label>
        <select name="post_id" class="form-select" aria-label="Default select example">
            <option selected>Vyber Příspěvek</option>
            <?php foreach (Post::getAll() as $cat){?>
                <option value="<?php echo $cat->data['id'];?>"><?php echo $cat->data['title'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>

  </div>

  <!-- Message input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example7">Text</label>
    <textarea name="text" class="form-control" id="form6Example7" rows="4"></textarea>
  </div>

  <div class="form-check form-switch">
    <input name="blocked" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Zablokováno</label>
  </div>  

  <hr>

  <!-- Submit button -->
  <input value="Přidat" name="create" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="comment.php" class="btn btn-warning">zrušit</a>
</form>