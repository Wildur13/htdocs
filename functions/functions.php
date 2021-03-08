<?php

use PHPMailer\PHPMailer\PHPMailer;

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

function insert_into_database(PDO $pdo): void{
    $vorname= $_POST["vorname"];
    $name= $_POST["name"];
    $username= $_POST["username"];
    $email= $_POST["e-mail"];
    $password= password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $pdo-> exec('TRUNCATE TABLE users1');
    $pdo-> exec('TRUNCATE TABLE users_login');
	$pdo -> exec("INSERT INTO users1 SET vorname='$vorname', name='$name', email='$email', password='$password'");
	$pdo -> exec("INSERT INTO users_login SET username='$username', email='$email', password='$password'");
};


function user_already_exists(PDO $pdo, string $str): bool{
    if (count($_POST) == 0){
        return false;
    }
    else if($_POST["e-mail"] == $str){
        $sql = $pdo->query("SELECT id FROM users1 WHERE email= '$str'");
            if($sql-> rowCount()>0) return true;
        }
    else if($_POST["username"] == $str) {
        $sql = $pdo->query("SELECT id FROM users_login WHERE username= '$str'");
            if($sql-> rowCount()>0) return true;
        }
    return false;
};

function sendEmail(PHPMailer $mail,string $vorname, string $name, string $email, string $token): bool{
    $mail-> setFrom('williamswakam09@gmail.com');
    $mail-> addAddress($email, $vorname. '' . $name);
    $mail-> Subject = 'Please verify your E-mail';
    $mail->isHTML(true);
    $mail->Body = "
        Please click on the link below: <br><br>

        <a href='http://localhost:8090/login_or_sign-up/verify.php?email='$email'&token='$token'>
            Verify now
        </a>
    ";
    if($mail->send()){
        return true;
    }
    return false;
}