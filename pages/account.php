<?php 
    $User = new User($Conn);
    if($_POST) {
      if($_POST['reg']) {
        if(!$_POST['email']){
          $error = "Email not set";
        }else if(!$_POST['first_name']) {
          $error = "First name not set";
        }else if(!$_POST['last_name']) {
          $error = "Last name not set";
        }else if(!$_POST['password']) {
          $error = "Password not set";
        }else if(!$_POST['password_confirm']) {
            $error = "Confirm password not set";
        }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $error = "Email address is not valid";
        }else if ($_POST['password'] !== $_POST['password_confirm']) {
          $error = "Password and Confirm Password do not match";
        }else if (strlen($_POST['password']) < 8) {
          $error = "Password must be at least 8 characters in length";
        }else if (strlen($_POST['password']) > 255) {
          $error = "Password must be shorter than 255 characters in length";
        }
        if($error) {
          ?>
          <!-- Error message from variable -->
          <script>
            $(document).ready(function(){
              Swal.fire({
                title: 'Error!',
                text: "<?php echo $error; ?>",
                icon: 'error',
                confirmButtonText: 'Thanks!'
              });
            });
          </script>
          <?php
          }else{
            $attempt = $User->updateUser($_POST, $_SESSION['user_data']);
            if($attempt) {
                $_SESSION['user_data'] = $attempt;
                ?>
                <script>
                  $(document).ready(function(){
                      Swal.fire({
                      title: 'Success!',
                      text: "User account updated!",
                      icon: 'success',
                      confirmButtonText: 'Thanks!'
                    }).then(function() {
                        window.location = "index.php?p=home";
                    });
                  });
                </script>
                <?php
            }else{
                ?>
                <script>
                  $(document).ready(function(){
                    Swal.fire({
                      title: 'Error!',
                      text: "An error occurred, please try again later.",
                      icon: 'error',
                      confirmButtonText: 'Thanks!'
                    });
                  });
                </script>
                <?php
            }             
          }
        }
    }
?>
<div class="container">
    <h1 class="mb-4 pb-2">My Account</h1>
    <p>Welcome to your account. From here you can edit your account details.</p>
    <div class="row">
      <div class="col-md-12">
        <form id="registration-form" method="post" action="">
          <div class="form-group">
              <label for="reg_first_name">First name</label>
              <input type="text" class="form-control" id="reg_first_name" name="first_name" value="<?php echo $_SESSION['user_data']['first_name']; ?>">
          </div>
          <div class="form-group">
              <label for="reg_last_name">Last name</label>
              <input type="text" class="form-control" id="reg_last_name" name="last_name"  value="<?php echo $_SESSION['user_data']['last_name']; ?>">
          </div>
          <div class="form-group">
              <label for="reg_email">Email address</label>
              <input type="email" class="form-control" id="reg_email" name="email" value="<?php echo $_SESSION['user_data']['user_email']; ?>">
          </div>
          <div class="form-group">
              <label for="reg_password">Password</label>
              <input type="password" class="form-control" id="reg_password" name="password">
          </div>
          <div class="form-group" class="pb-2">
              <label for="reg_password_confirm">Confirm Password</label>
              <input type="password" class="form-control" id="reg_password_confirm" name="password_confirm">
          </div>
          <button type="submit" name="reg" value="1" class="btn btn-primary">Update</button>
        </form>        
      </div>
  </div>
</div>
