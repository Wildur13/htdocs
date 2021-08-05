<?php
    $title = "Sign up";
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/header.php';

/*function redirect(): void{
    header('Location: sign_up.php');
    exit();
}*/

if (!isset($_GET['email']) || !isset($_GET['token'])){
    header('Location: sign_up.php');
    exit();
    //redirect();
}
    else{
        $database = new PDO('mysql: host=localhost; dbname=candidate','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $email= $_GET['email'];
        $token= $_GET['token'];

        $sql = $database->query("SELECT id FROM users1 WHERE email='$email' AND token='$token' AND isEmailVerified='0'");

        if ($sql-> rowCount() > 0){
            $database -> exec("UPDATE users1 SET isEmailVerified='1', token=''");
            //redirect();
        }
    }
?>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
					<span class="login100-form-title p-b-32 text-center">
                        Sign up complete
					</span>
                <?php 
    echo "<div class='alert alert-success text-center'> Sign up complete</div>";?>
                    <p>
                    Your registration is yet complete.
                <div>
                    <a href="/login_or_sign-up/login.php"class="txt3">
                        To login click here.
                    </a>
                </div>
                    </p>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>


<?php
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/footer.php'
?>