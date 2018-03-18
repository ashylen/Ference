<?php
session_start();

if ((isset($_SESSION['zalogowany']) ) && ($_SESSION['zalogowany'] == true)) {
    header('Location: zalogowany.php');
    exit();
}
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
    </head>
    <body>
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
        <br><br>
       <!-- KONTENER POCZĄTEK-->
        <div id="container">
            <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logo" class="tilelinkhtml5">Wprowadź dane logowania:</div>
                <div style="clear: both"></div>
            </div>
            <!-- RECTANGLE KONIEC-->

           <!-- SQUARE POCZĄTEK-->
            <div class="square">
                <!-- FORMULARZ POCZĄTEK-->
                <form action="zaloguj.php" method="post">
                    <input type="text" class="username" name="login" placeholder="Nazwa uzytkownika" />
                    <input type="password" class="password" name="haslo" placeholder="Haslo" />
                    <input type="submit" style="width:500px"   value="ZALOGUJ SIĘ" />
                </form>
                <!-- FORMULARZ KONIEC-->
                <!-- PHP WYŚWIETLAJĄCY BŁĘDY LOGOWANIA-->
                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                    echo '<div style="text-align: center; color:red;  padding:5px;">Wprowadzone dane sa nieprawidłowe.</div>';
                }
                ?>
                 <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed2') {
                    echo '<div style="text-align: center; color:red;  padding:5px;">Dobry login, złe hasło.</div>';
                }
                ?>
                <!--KONIEC - PHP WYŚWIETLAJĄCY BŁĘDY LOGOWANIA-->
            </div> <br>
            <!-- SQUARE KONIEC-->
            <div class="rectangle">2018 &copy; Dominik Urban -  Ference </div>
        </div>
        <!-- KONTENER KONIEC-->
       </body>
</html>
