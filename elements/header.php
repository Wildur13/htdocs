<?php 
    declare(strict_types=1);
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '/functions/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
<!--===============================================================================================-->


    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/slide.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
                integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" 
                    integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" 
                    integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <title><?php if (isset($title)) : {echo "$title";} else :{echo "My Site";} ?><?php endif?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if($_SERVER["SCRIPT_NAME"] == '/index.php' || $_SERVER["SCRIPT_NAME"] == '/login_success/home_login.php'):?> text-danger <?php endif?>" aria-current="page" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link 
          <?php if($_SERVER["SCRIPT_NAME"] == '/login_or_sign-up/sign_up.php'): {echo 'text-danger';} 
                elseif ($_SERVER["SCRIPT_NAME"] == '/login_or_sign-up/sign_up_complete.php'): {echo 'text-danger';} ?>
                <?php endif?>" 
            aria-current="page" href="<?php echo address()?> "> 
            <?php if(address() === '/login_or_sign-up/sign_up_complete.php'): {echo 'Sign up complete';} elseif ($_SERVER["SCRIPT_NAME"] == '/login_success/home_login.php'): {echo '';}
            else:{echo "Sign up";}?><?php endif?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SERVER["SCRIPT_NAME"] == '/login_or_sign-up/login.php'):{echo 'text-danger';}?> <?php endif?>" href="/login_or_sign-up/login.php">
              <?php if($_SERVER["SCRIPT_NAME"] == '/login_success/home_login.php') {echo '';} else {echo 'Login';}?></a>
        </li>
    </div>
      <div class="d-flex">
                  <a class="nav-link <?php if($_SERVER["SCRIPT_NAME"] == '/login_or_sign-up/login.php'):{echo 'text-danger';}?> <?php endif?>" href="/login_or_sign-up/login.php">
                      <?php if($_SERVER["SCRIPT_NAME"] == '/login_success/home_login.php') {echo '<i class="fa fa-sign-out" aria-hidden="true"></i>';} else {echo '';}?></a>
      </div>
  </div>
</nav>