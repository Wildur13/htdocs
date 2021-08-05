<?php
    $title = "Login";
    $wrongEmail = null;
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/header.php';
    if (sizeof($_POST)>0){
        $database = new PDO('mysql: host=localhost; dbname=candidate','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $email = $_POST['username'];
        $pass = $_POST['pass'];
        if (userExist($database, $email, $pass)){
            redirect("/login_success/home_login.php");
        }
        else
            $wrongEmail= "Please enter a registered E-mail and password";
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="POST">
                    <?php if($wrongEmail) {echo "<div class='alert alert-danger text-center'> $wrongEmail </div>";}?>
					<span class="login100-form-title p-b-32">
						Account Login
					</span>

					<span class="txt1 p-b-11">E-mail </span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="username" required placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" required placeholder="password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt3">
								Forgot Password?
							</a>
						</div>
						<div>
							<a href="/login_or_sign-up/sign_up.php"class="txt3">
								Create an account yet
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<?php 
						require_once dirname(__DIR__). DIRECTORY_SEPARATOR. './elements/social.php';
					?>
				</form>
				
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/daterangepicker/moment.min.js"></script>
	<script src="/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>


<?php
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/footer.php'
?>