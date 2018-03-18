<?php

header('Content-Type: text/html; charset=utf-8');
require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_error;
} else {
        $login = $_POST['login'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $haslo1 = $_POST['haslo1'];
        $haslo1_hash = password_hash($haslo1, PASSWORD_DEFAULT);
        $haslo2 = $_POST['haslo2'];
        $email = $_POST['email'];

        $sekret = "6LdCQUUUAAAAAF8yOB-MRYzwFn66KQ4fMVJXlUya";
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $sekret . '&response=' . $_POST['g-recaptcha-response']);
        $odpowiedz = json_decode($sprawdz);


        if ($odpowiedz->success==false) 
            {
            header("location: Rejestracja?msg3=failed");
            }else 
                {
            
                $sql = "SELECT login  FROM users WHERE login = '$login' and email = '$email' OR login = '$login' or email = '$email'";
                $result = $polaczenie->query($sql)
                        or die("Coś poszło nie tak.");
                
                if ($result->num_rows < 1) 
                    {
                            if ($haslo1 == $haslo2) 
                                                               {
                                                                $polaczenie->query("INSERT INTO users ( `login`, `haslo`, `email`, `imie`, `nazwisko`) VALUES ('$login', '$haslo1_hash', '$email', '$imie' , '$nazwisko'); ");
                                                                header('Location: Szybkie-tworzenie-darmowych-wydarzen?msg1=success');
                                                               } else {
                                                                         header("location: Rejestracja?msg2=failed");
                                                                         }
                    } else {
                              header("location: Rejestracja?msg1=failed");
                              }
              }
      
    }

$polaczenie->close();
?>


