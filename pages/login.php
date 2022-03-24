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
            $attempt = $User->createUser($_POST);
            if($attempt) {
                ?>
                <script>
                  $(document).ready(function(){
                      Swal.fire({
                      title: 'Success!',
                      text: "User created, please login!",
                      icon: 'success',
                      confirmButtonText: 'Thanks!'
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
    <h1 class="mb-4 pb-2">Login or Register</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet eros nec lectus lacinia interdum nec vitae velit. Vestibulum condimentum diam in mauris facilisis, et pretium nisl viverra. Pellentesque tempus elit sed suscipit ultricies. Maecenas erat lectus, convallis sit amet mauris ut, fringilla faucibus enim</p>
    <div class="row">
      <div class="col-md-12">
        <form id="registration-form" method="post" action="">
          <div class="form-group">
              <label for="reg_first_name">First name</label>
              <input type="text" class="form-control" id="reg_first_name" name="first_name">
          </div>
          <div class="form-group">
              <label for="reg_last_name">Last name</label>
              <input type="text" class="form-control" id="reg_last_name" name="last_name">
          </div>
          <div class="form-group">
              <label for="reg_email">Email address</label>
              <input type="email" class="form-control" id="reg_email" name="email">
          </div>
          <div class="form-group">
              <label for="reg_password">Password</label>
              <input type="password" class="form-control" id="reg_password" name="password">
          </div>
          <div class="form-group">
              <label for="reg_password_confirm">Confirm Password</label>
              <input type="password" class="form-control" id="reg_password_confirm" name="password_confirm">
          </div>
          <button type="submit" name="reg" value="1" class="btn btn-primary">Register</button>
        </form>        
      </div>
  </div>
</div>