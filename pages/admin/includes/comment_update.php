
<?php 
    $comment = Comment::getById($id);

    if (isset($_POST['update'])) 
    {
        $data = Form::clearPost($_POST, "update");

        if (isset($_POST['status']))
        {
            $data['status'] = Comment::STATUS_BANNED;
        }
        else 
        {
            $data['status'] = Comment::STATUS_ONLINE;
        }

        Comment::updateById($comment->data['id'], $data);
        header("Location: comment.php?update=".$comment->data['id']);
    }
?>


<h4 class="text-dark mb-4">Upravit Komentář</h4>
<form method="post">
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">

  <div class="col">
      <div class="form-outline">
      <label class="form-label">User</label>
        <select name="user_id" class="form-select" aria-label="Default select example">
            <option value="00" selected>Vyber Uživatele</option>
            <?php foreach (User::getAll() as $cat){?>
                <option <?php if ($cat->data['id'] == $comment->data['user_id']) { echo "selected";} ?> value="<?php echo $cat->data['id'];?>"><?php echo $cat->data['name'];?></option>   
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
                <option <?php if ($cat->data['id'] == $comment->data['post_id']) { echo "selected";} ?> value="<?php echo $cat->data['id'];?>"><?php echo $cat->data['title'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>

  </div>

  <!-- Message input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example7">Text</label>
    <textarea name="text" class="form-control" id="form6Example7" rows="4"> <?php echo $comment->data['text'] ?></textarea>
  </div>

  <div class="form-check form-switch">
    <input name="status" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php if ($comment->isBanned()) {echo "checked";}?> >
    <label class="form-check-label" for="flexSwitchCheckDefault">Zablokováno</label>
  </div>  
  <hr>

  <!-- Submit button -->
  <input value="Uložit" name="update" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="comment.php" class="btn btn-warning">zrušit</a>
</form>