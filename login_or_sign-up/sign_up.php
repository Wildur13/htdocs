<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once dirname(__DIR__) . '/PHPmailer/Exception.php';
require_once dirname(__DIR__) . '/PHPmailer/PHPMailer.php';
require_once dirname(__DIR__) . '/PHPmailer/SMTP.php';

    $title = "Sign up";
	$error= null;
	$wrongEmail=null;
	$wrongUsername=null;
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/header.php';

    if(sizeof($_POST) === 0){}
    else if(correct_password()) {
				$vorname = $_POST['vorname'];
				$name = $_POST['name'];
				$email= $_POST["e-mail"];
				$username = $_POST["username"];
				$database = new PDO('mysql: host=localhost; dbname=candidate','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$r1 = user_already_exists($database, $email);
				$r2 = user_already_exists($database, $username);
			if($r1){
				$wrongEmail .= "This E-mail already exists in the Database.";
			}
			elseif ($r2){
				$wrongUsername .= "Please change your username, because it already exists.";
			}
			else{
				$token = 'qwertzuiopQWERTZUIOP1234567890asdfghjkyxcvbn';
				$token = substr(str_shuffle($token), 0, 10);
				include_once dirname(__DIR__).DIRECTORY_SEPARATOR. '/PHPmailer/PHPMailer.php';
				$sendMail = new PHPMailer(true);
				$sendMail-> isMail();
				if(sendEmail($sendMail,$vorname,$name,$email,$token)){
                    insert_into_database($database,$token);
					header('Location: sign_up_complete.php');
					exit();
				}
				else{
					$wrongEmail .= "Something wrong happened with the E-mail. Please try again";
				}

			}
		}
    else {
		$error="<div class='alert alert-danger text-center'> Sign up incomplete. Please check your password </div>";
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="POST">
	
					<span class="login100-form-title p-b-32 text-center">
						Sign Up
					</span>				

					<?php if($error) {echo "<div class='alert alert-danger text-center'>$error</div>";} 
							elseif($wrongEmail) {echo "<div class='alert alert-danger text-center'> $wrongEmail </div>";}
							elseif($wrongUsername) {echo "<div class='alert alert-danger text-center'>	$wrongUsername </div>";}?>
				
					<?php for($i=1; $i<=6; $i++):?>
					<span class="txt1 p-b-11">
						<?php   if ($i == 1) {echo "Vorname";} 
								elseif ($i == 2) {echo "Name";}
								elseif ($i == 3) {echo "Username";}
								elseif ($i == 4) {echo "E-mail<span text-danger>*</span>";}
								elseif ($i == 5) {echo "password<span text-danger>*</span>";}
								else {echo "Confirm password<span text-danger>*</span>";} ?>
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Vorname is required">
						<input class="input100" type=<?php if($i == 1 || $i == 2 || $i == 3) {echo "text";} 
															elseif ($i == 5 || $i == 6) {echo "password";}
															else {echo "email";}?> 
												name=
															<?php   if ($i == 1) {echo "vorname";} 
																	elseif ($i == 2) {echo "name";}
																	elseif ($i == 3) {echo "username";}
																	elseif ($i == 4) {echo "e-mail";}
																	elseif ($i == 5) {echo "pass";}
																	else {echo "confirm ";} ?> 
												required 
												placeholder=
															<?php   if ($i == 1) {echo "Vorname";} 
																	elseif ($i == 2) {echo "Name";}
																	elseif ($i == 3) {echo "Username";}
																	elseif ($i == 4) {echo "E-mail";}
																	elseif ($i == 5) {echo "Password";}
																	else {echo "Confirm Password";} ?> 
												value= "">
						<span class="focus-input100"></span>
					</div>
					<?php endfor?>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<a href="/login_or_sign-up/login.php" class="txt3">
								Already an account?
							</a>
						</div>

						<div>
							<a href="#" class="txt3">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign up
						</button>
					</div>
					<?php 
						require_once dirname(__DIR__). DIRECTORY_SEPARATOR. './elements/social.php';
					?>
				</form>
			</div>
		</div>
</div>



<?php
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/footer.php'
?>