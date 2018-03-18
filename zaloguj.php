<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('Location: Szybkie-tworzenie-darmowych-wydarzen');
    exit();
}

header('Content-Type: text/html; charset=utf-8');
require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_error;
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $loginC = htmlentities($login, ENT_QUOTES, "UTF-8");  //przeciwko SQLinjection
    $hasloC = htmlentities($haslo, ENT_QUOTES, "UTF-8"); //przeciwko SQLinjection


    if ($rezultat = @$polaczenie->query(
                    sprintf("SELECT * FROM users WHERE login='%s' ", mysqli_real_escape_string($polaczenie, $loginC)
            ))) {
        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow > 0) {
            $wiersz = $rezultat->fetch_assoc();
            
             if(password_verify($hasloC, $wiersz['haslo'])) 
             {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['login'] = $wiersz['login'];
                    

                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                
                    header('Location: Nadchodzace-wydarzenia');
             }else {
                 
                 header("location:Logowanie?msg=failed");
             }
        } else {

            header("location:Logowanie?msg=failed");
        }
    }

    $polaczenie->close();
}

?>