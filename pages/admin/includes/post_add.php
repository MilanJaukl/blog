<?php 
    if (isset($_POST['create'])) 
    {
        $data = Form::clearPost($_POST, 'create');
        $data['user_id'] = 22;
        //img
        $data['image'] = $_FILES['image']['name'];

        move_uploaded_file($_FILES['image']['tmp_name'], "../../images/".$data['image']);
          if (isset($data['published'])) 
          {
            $data['published'] = 1;
            $data['date_published'] = date('Y-m-d H:i:s');
            $respond = Post::create($data);
          }
          else 
          {
            $data['published'] = 0;
            $data['date_published'] = 0;
            $respond = Post::create($data);    
          }

          if (!$respond) 
          {
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img class="rounded me-2" alt="...">
              <strong class="me-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              CHYBA!
            </div>
          </div>
        </div>';
         echo "<script> new bootstrap.Toast(document.getElementById('liveToast')).show();</script>";
            die("QUERY FAILED".mysqli_error(Database::get_connection()));
          }
          else
          {
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img class="rounded me-2" alt="...">
              <strong class="me-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Příspěvek úspěšně vytvořen! 
              <a href= "../post.php?post='.$respond->data['id'].'" target="_blank" rel="noopener noreferrer">qsqsqs</a>
            </div>
          </div>
        </div>';
         echo "<script> new bootstrap.Toast(document.getElementById('liveToast')).show();</script>";
          }
    }
?>
Přidat
<form method="post" enctype="multipart/form-data">
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Nadpis</label>
        <input name="title" type="text" id="form6Example1" class="form-control" />
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
      <label class="form-label">Kategorie</label>
        <select name="category_id" class="form-select" aria-label="Default select example">
            <option selected>Vyber kategorii</option>
            <?php foreach (Category::getAll() as $cat){?>
                <option value="<?php echo $cat->data['id'];?>"><?php echo $cat->data['name'];?></option>    
                
            <?php } ?>
        </select>
      </div>
    </div>
  </div>

  <!-- File input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example3">Obrázek</label>
    <input name="image" type="file" id="form6Example3" class="form-control" />
  </div>


  <!-- Message input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="summernote">Additional information</label>
    <textarea name="text" class="form-control" id="summernote" rows="4"></textarea>
  </div>

  <div class="form-check form-switch">
    <input name="published" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Publikovat</label>
  </div>  

  <hr>

  <!-- Submit button -->
  <input value="Přidat" name="create" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="post.php" class="btn btn-warning">zrušit</a>
</form>