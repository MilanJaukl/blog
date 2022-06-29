<?php $user = User::getById($id)?>

<?php 
    if (isset($_POST['update'])) 
    {
        $data = Form::clearPost($_POST, 'update');
        $data = Form::clearPost($data, "password_again");

        // if set imagine 
        if (!empty($_FILES['image']['name'])) 
        {
            $data['image'] = $_FILES['image']['name'];
            if ($user->data['image'] != "default_avatar.svg") 
            {
                unlink("../../images/userProfiles/".$user->data['image']);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], "../../images/userProfiles/".$data['image']);
        
        }
        
        // if set password
        if (!empty($data['password'])) 
        {
            $data['password'] = Database::password_encrypt($data['password']);
        }
        else 
        {
            unset($data['password']);
        }
        print_r($data);
        User::updateById ($user->data['id'], $data);   
        header("Location: user.php?update={$user->data['id']}");
    }
?>
Přidat
<form method="post" enctype="multipart/form-data">
  <!-- 2 column grid layout with text inputs for the first and last names -->
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Jmeno</label>
        <input value="<?php echo $user->data['first_name'] ?>" name="first_name" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Prijmeni</label>
        <input value="<?php echo $user->data['second_name'] ?>" name="second_name" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label" for="form6Example1">Uzivatelske jmeno</label>
        <input value="<?php echo $user->data['username'] ?>" name="username" type="text" id="form6Example1" class="form-control" />
      </div> 
    </div>
  </div>

  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example3">Email</label>
    <input value="<?php echo $user->data['email'] ?>" name="email" type="email" id="form6Example3" class="form-control" />
  </div>

  <!-- hesla -->
  <div class="row">
    <div class="col">
        <label class="form-label" for="form6Example3">Heslo</label>
        <input autocomplete="off" name="password" type="password" id="form6Example3" class="form-control" />
    </div>

    <div class="col">
        <label class="form-label" for="form6Example3">Heslo znovu</label>
        <input autocomplete="off" name="password_again" type="password" id="form6Example3" class="form-control" />
    </div>
  </div>

  <!-- File input -->
  <div class="mt-4 form-outline mb-4">
    <img src="../../images/userProfiles/<?php echo $user->data['image']?>" alt="">
    <label class="form-label" for="form6Example3">Profilový Obrázek</label>
    <input name="image" type="file" id="form6Example3" class="form-control" />
  </div>

  <div class="mt-4 row">
    <select class="form-select" name="role" id="">
        <option value="-1">Vyberte roli</option>
        <option value="0" <?php if ($user->data['role'] == 0) { echo "selected";}?>>Uživatel</option>
        <option value="1" <?php if ($user->data['role'] == 1) { echo "selected";}?>>Autor</option>
        <option value="2" <?php if ($user->data['role'] == 2) { echo "selected";}?>>Admin</option>
    </select>
  </div>

  <hr>

  <!-- Submit button -->
  <input value="Uložit" name="update" type="submit" class="btn btn-primary btn-block mb-4">
  <a href="user.php" class="btn btn-warning">zrušit</a>
</form>