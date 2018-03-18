<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Ference - udane wydarzenia.</title>
        <meta charset="UTF-8">
        <meta name="description" content="Organizacja wydarzeń, konferencji oraz spotkań w jednym miejscu!"/>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Comaptible" content="IE=edge, chrome=1"/>

        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato&amp;subset=latin-ext" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body >

        <!-- NAWIGACJA POCZĄTEK-->
              <nav role='navigation'>
                    <div id="logo" class="tilelinkhtml5">Ference</div>
                    <ul>
                        <li><a href="Szybkie-tworzenie-darmowych-wydarzen">Strona główna</a></li>
                        <li><a href="Logowanie">Zaloguj się</a></li>
                        <li><a href="Rejestracja">Rejestracja</a></li>
                    </ul>
                </nav>
        <!-- NAWIGACJA KONIEC-->
        <br/>
        <br/>
         <!-- KONTENER POCZĄTEK-->
        <div id="container">
             <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logo" class="tilelinkhtml5">Wprowadź dane do rejestracji:</div> 
                  <div style="clear: both;"></div>
            </div>

        <!-- SQUARE POCZĄTEK-->
            <div class="square">
                <!-- FORMULARZ POCZĄTEK-->
                <form action="zarejestruj.php" method="post">
                    <input type="text" class="username" name="login" placeholder="Nazwa uzytkownika"  />
              
                    <input type="text" class="username" name="imie" placeholder="Imię"  />
                    <input type="text" class="username" name="nazwisko" placeholder="Nazwisko"  />
                    <input type="password" class="password" name="haslo1" placeholder="Haslo"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Musi zawierać przynajmniej jedną liczbę, jedną wielką literę, jedną małą literę, a długość nie może być krótsza niż 8 znaków." />
                    <input type="password" class="password" name="haslo2" placeholder="Potwierdź hasło"  />
                    <input type="email" class="username" name="email" placeholder="Podaj swój e-mail" />
                    <div align="center" class="g-recaptcha" data-sitekey="6LdCQUUUAAAAAIQzKzQIXVm_nMQOxU1JCu3W7xPu"></div>
                     <?php
                if (isset($_SESSION['e_bot'])){
                echo '<div style="text-align: center; color:red; padding:5px;">'.$_SESSION['e_bot'].' </div>';
                unset($_SESSION['e_bot']);
                } ?> 
                    <input type="submit" style="width:500px;"   value="ZAREJESTRUJ SIĘ" />
                </form>
                <!-- FORMULARZ KONIEC-->
                
                <!-- PHP WYŚWIETLAJĄCY BŁĘDY REJESTRACJI-->
                <?php
                if (isset($_GET["msg1"]) && $_GET["msg1"] == 'failed'){
                echo '<div style="text-align: center; color:red; padding:5px;"> Rejestracja nieudana, użytkownik o takim loginie lub adresie e-mail istnieje juz w bazie.</div>';
                } ?>   
                <?php
                if (isset($_GET["msg2"]) && $_GET["msg2"] == 'failed') {
                    echo '<div style="text-align: center; color:red;  padding:5px;"> Rejestracja nieudana, hasła różnią się od siebie. </div>';
                } ?>
                <?php
                if (isset($_GET["msg3"]) && $_GET["msg3"] == 'failed') {
                    echo '<div style="text-align: center; color:red;  padding:5px;"> Potwierdź, że nie jesteś botem!</div>';
                } ?>
                <!-- KONIEC - PHP WYŚWIETLAJĄCY BŁĘDY REJESTRACJI-->
                <br><br>
            </div>
        <!-- SQUARE KONIEC-->
        
        <!-- STOPKA-->    
        <div class="rectangle">2018 &copy; Dominik Urban -  Ference </div>
        <!-- KONIEC STOPKI-->
        </div>
        <!-- CONTAINER KONIEC-->
    </body>
</html>
