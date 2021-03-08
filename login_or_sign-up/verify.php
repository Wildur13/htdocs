<?php
    $title = "Sign up";
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/header.php';
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
                    Your registration is almost complete. Now you have to confirm your registration through the link that was sent to your email address.
                    </p>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>


<?php
    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR. 'elements/footer.php'
?>