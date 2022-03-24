<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<?php
  $page = $_GET['p'];
  if(!$page){
    $page = "home";
  }
  $User = new User($Conn);
  if($_POST) {
    if($_POST['login']) {
      if(!$_POST['email']){
        $error = "Email not set";
      }else if(!$_POST['password']) {
        $error = "Password not set";
      }else if (strlen($_POST['password']) < 8) {
        $error = "Password must be at least 8 characters in length";
      }
      if($error) {
      ?>>
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
        $user_data = $User->loginUser($_POST);
        if($user_data) {
            // Credentials correct
            $_SESSION['is_loggedin'] = true;
            $_SESSION['user_data'] = $user_data;
            ?>
              <script>
                $(document).ready(function(){
                    Swal.fire({
                    title: 'Success!',
                    text: "You have successfully logged in, welcome <?php echo ucfirst($_SESSION['user_data']['first_name']); ?> <?php echo ucfirst($_SESSION['user_data']['last_name']); ?>!",
                    icon: 'success',
                    confirmButtonText: 'Thanks!'
                  });
                });
              </script>
            <?php  
         
        }else{
            // Credentials incorrect
            ?>
              <script>
                $(document).ready(function(){
                  Swal.fire({
                    title: 'Error!',
                    text: "Login credentials are incorrect.",
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script type = "text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/d068e6a7ba.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>Active Gym Group - <?php echo ucfirst($page);?></title>
  <link rel="shortcut icon" type="image/jpg" href="./favicon.ico"/>
</head>
<header>
  <div class="page-header-top container text-center text-md-star">
    <a href="index.php?p=home"><img src="./images/logo.png" alt="Active Gym Group Logo" /></a>
  </div>
  <nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
      <!-- AGG Title -->
      <a class="navbar-brand" href="index.php?p=home">AGG</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbar">

      <!-- Left Navbar -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?p=categories">Sports Centres</a>
        </li>
      </ul>

      <!-- Right Navbar -->
      <ul class="navbar-nav navbar-btn mb-2 mb-lg-0 ">
        <!-- Search -->
        <li class="nav-item">
          <form method="post" class="d-flex" action="index.php?p=search">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-dark ms-2 btn-nav" type="submit">Search</button>
          </form>
        </li>
        <!-- Account -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-fw fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg-end">
            <?php if($_SESSION['is_loggedin']) { ?>
                <a class="dropdown-item" href="index.php?p=account"><b><?php echo ucfirst($_SESSION['user_data']['first_name']); ?> <?php echo ucfirst($_SESSION['user_data']['last_name']); ?></b></a>
                <a class="dropdown-item" href="index.php?p=favourites">Favourites</a>
                <a class="dropdown-item" href="index.php?p=logout">Logout</a>
            <?php }else{ ?>
              <form class="px-4 py-3" id="login-form" method="post" action="">
                <h4>Login </h4>  
                <div class="form-group">
                  <input type="email" class="form-control mt-4" id="login_email" name="email" placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control mt-4" id="login_password" name="password" placeholder="Password">
                </div>
                <input type="submit" name="login" value="Login" class="btn btn-primary mt-3"/>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?p=register">New around here? Sign up</a>
              </form>          
            <?php } ?>
          </div>
      </li>
    </ul>
    </div>
  </nav>
  </header>
  <body id="page-<?php echo $page; ?>">
  