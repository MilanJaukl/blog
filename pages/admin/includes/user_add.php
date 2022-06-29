<?php 
    if (isset($_POST['create'])) 
    {
        $data = Form::clearPost($_POST, 'create');
        $data = Form::clearPost($data, "password_again");

        $data['image'] = $_FILES['image']['name'];
        $data['password'] = Database::password_encrypt($data['password']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../../images/userProfiles/".$data['image']);
        $respond = User::create($data);
        
        echo "<script> new bootstrap.Toast(document.getElementById('liveToast')).show();</script>";  
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
              Uživatel úspěšně přidán
              <a href="">Zobrazit</a>
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
        <label class="form-label" for="form6Example1">Jmeno</label>
        <input name="first_name" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Prijmeni</label>
        <input name="second_name" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Uzivatelske jmeno</label>
        <input name="username" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
  </div>

  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example3">Email</label>
    <input name="email" type="email" id="form6Example3" class="form-control" />
  </div>

  <!-- hesla -->
  <div class="row">
    <div class="col">
        <label class="form-label" for="form6Example3">Heslo</label>
        <input name="password" type="text" id="form6Example3" class="form-control" />
    </div>

    <div class="col">
        <label class="form-label" for="form6Example3">Heslo znovu</label>
        <input name="password_again" type="text" id="form6Example3" class="form-control" />
    </div>
  </div>

  <!-- File input -->
  <div class="mt-4 form-outline mb-4">
    <label class="form-label" for="form6Example3">Profilový Obrázek</label>
    <input name="image" type="file" id="form6Example3" class="form-control" />
  </div>

  <div class="mt-4 row">
    <select class="form-select" name="role" id="">
        <option value="0">Vyberte roli</option>
        <option value="0">Uživatel</option>
        <option value="1">Autor</option>
        <option value="2">Admin</option>
    </select>
  </div>

  <hr>

  <!-- Submit button -->
  <input value="Přidat" name="create" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="user.php" class="btn btn-warning">zrušit</a>
</form>



