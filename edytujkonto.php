<?php

header('Content-Type: text/html; charset=utf-8');
require_once "connect.php";

session_start();

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_error;
} else {

    $edhaslo1 = $_POST['edhaslo1'];
    $edhaslo2 = $_POST['edhaslo2'];
    $edemail = $_POST['edemail'];
    $seslogin = $_SESSION['login'];

    $haslo = htmlentities($edhaslo1, ENT_QUOTES, "UTF-8"); //Anti-SQLinjection
    $email = htmlentities($edemail, ENT_QUOTES, "UTF-8"); //Anti-SQLinjection

    if ($edhaslo1 == "" && $edhaslo2 == "") {
        if ($edemail == "") {
            header("location: Twoje-konto?msg=failed3");
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "UPDATE users SET email='$email' WHERE login like '$seslogin' ";
                $dane = $polaczenie->query($sql)
                        or die("Zmiana adresu e-mail nie powiodła się. Skontaktuj się z administratorem strony");
                header('location: Twoje-konto?msg=success2');
            } else {
                header("location: Twoje-konto?msg=failed3");
            }
        }
    } else {
        if ($edhaslo1 <> $edhaslo2) {
            header("location: Twoje-konto?msg=failed");
        } else if ($edhaslo1 == "") {
            header("location: Twoje-konto?msg=failed2");
        } else {
            $sql = "UPDATE users SET haslo='$haslo' WHERE login like '$seslogin' ";
            $dane = $polaczenie->query($sql)
                    or die("Query failed");
            header('location: Twoje-konto?msg=success');
        }
    }
}



$polaczenie->close();
?>


