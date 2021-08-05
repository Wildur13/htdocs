<?php
use PHPMailer\PHPMailer\PHPMailer;
require dirname(__DIR__). '/vendor/autoload.php';

function redirect(string $address): void{
    header("Location: $address");
    exit();
}

function address(): string{
    if($_SERVER["SCRIPT_NAME"] === '/login_or_sign-up/sign_up_complete.php'){
        return "/login_or_sign-up/sign_up_complete.php";
    }
    return "/login_or_sign-up/sign_up.php";
};

function correct_password(): bool{
    if ($_POST["pass"] === $_POST["confirm"]) return true;
    return false;
};

function insert_into_database(PDO $pdo, string $token): void{
    $vorname= $_POST["vorname"];
    $name= $_POST["name"];
    $username= $_POST["username"];
    $email= $_POST["e-mail"];
    $password= password_hash($_POST["pass"], PASSWORD_DEFAULT);
	$pdo -> exec("INSERT INTO users1 SET vorname='$vorname', name='$name', email='$email',   
                            password='$password', isEmailVerified='0', token='$token', username='$username'");
};


function user_already_exists(PDO $pdo, string $str): bool{
    if (count($_POST) == 0){
        return false;
    }
    else if($_POST["e-mail"] === $str){
        $sql = $pdo->query("SELECT id FROM users1 WHERE email= '$str'");
            if($sql-> rowCount()>0) return true;
        }
    else if($_POST["username"] === $str) {
        $sql = $pdo->query("SELECT id FROM users1 WHERE username= '$str'");
            if($sql-> rowCount()>0) return true;
        }
    return false;
};

function sendEmail(PHPMailer $mail, string $vorname, string $name, string $email, string $token): bool{

    // mail infos
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.googlemail.com";
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // sender infos
    $mail->setFrom('kouamwilliam09@gmail.com', 'Willy Wakam');
    $mail->Username = "kouamwilliam09@gmail.com";
    $mail->Password = "Premiere#1234";


    // receiver infos
    $mail-> Subject = 'Please verify your E-mail';
    $mail-> addAddress($email, $vorname. '' . $name);
    $mail->msgHTML( "
        Please click on the link below:<br><br>

        <a href='http://localhost:8090/login_or_sign-up/verify.php?email=$email&token=$token'>
            Verify now
        </a>");
    if(!$mail->send()){
        return false;
    }
    else{
        return true;
    }
}

function userExist(PDO $pdo, string $email, string $pass): bool{
    $sql = $pdo ->query("SELECT id, password, isEmailVerified FROM users1 WHERE email='$email'");
    if ($sql-> rowCount() > 0 ) {
        $data = $sql->fetch();
        if (password_verify($pass, $data['password'])){
            if($data['isEmailVerified'] == 1) {
                return true;
            }
            else return false;
        }
        else return false;
    }
    else return false;
}
