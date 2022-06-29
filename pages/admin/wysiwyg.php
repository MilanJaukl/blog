<?php include 'includes/header.php'; ?>
<?php 
  $data['user_id'] = 22;
  $data['title'] = "wdwdwd";
  
  $query = "SELECT * FROM post WHERE user_id = ".$data['user_id']." AND title = '".$data['title']."'";
  print_r(mysqli_fetch_assoc(Database::get_result_from_query($query)));
  $post =  new Post(mysqli_fetch_assoc(Database::get_result_from_query($query)));
  echo $post->data['id'];

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
?>