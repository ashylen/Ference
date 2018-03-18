<?php
session_start();

if ((!isset($_SESSION['zalogowany']) ) && ($_SESSION['zalogowany'] == false)) {
    header('Location: index.php');
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
            <div id="logo"><a href="index.php" class="tilelinkhtml5">Ference</a></div>
            <ul>
                <li class="dropdown">
                    <a href="Nadchodzace-wydarzenia" class="dropdown-toggle" data-toggle="dropdown">Wydarzenia<b class="caret"></b></a>
                    <ul class="dropdown-menu animated fadeInUp">
                        <li><a href="Nadchodzace-wydarzenia">Nadchodzące</a></li>
                        <li><a href="Wyszukaj-wydarzenie">Wyszukaj</a></li>
                        <li><a href="Organizacja-wydarzen">Organizuj</a></li>
                        <li><a href="Zakonczone-wydarzenia">Zakończone</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="Twoje-konto" class="dropdown-toggle" data-toggle="dropdown">Mój profil<b class="caret"></b></a>
                    <ul class="dropdown-menu animated fadeInUp">
                        <li><a href="Twoje-konto">Edytuj profil</a></li>
                        <li><a href="Moje-wydarzenia">Moje wydarzenia</a></li>
                        <li><a href="Jestem-uczestnikiem">Jestem uczestnikiem</a></li>
                    </ul>
                </li>

                <li><a href="wyloguj.php">Wyloguj się (<?php
                    echo $_SESSION['login'];
                    ?>)</a></li>
            </ul>
        </nav>
 <!-- NAWIGACJA KONIEC-->
        <br/>
        <br/>
        <!-- KONTENER POCZĄTEK-->
        <div id="container">
            <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logobezfloata" class="tilelinkhtml5" style="padding-right: 100px;">Edycja profilu</div>
                <div style="clear: both"></div>
            </div>
<!-- SQUARE POCZĄTEK-->
            <div class="square">
                <!-- FORMULARZ POCZĄTEK-->
                <form action="edytujkonto.php" method="post">
                    <?php
                    header('Content-Type: text/html; charset=utf-8');
                    require_once "connect.php";
                    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

                    if ($polaczenie->connect_errno != 0) {
                        echo "Error: " . $polaczenie->connect_error;
                    } else {

                        $seslogin = $_SESSION['login'];

                        $sql = "SELECT *  FROM users WHERE login = '$seslogin'";
                        $dane = $polaczenie->query($sql)
                                or die("Query failed"); //pobranie wynik�w zapytania
                        // tutaj ma byc TH


                        while ($wiersz = $dane->fetch_array()) {
                            echo '<table class="tg" style="undefined;table-layout: fixed; width: 500px;  margin:auto;">
                            <colgroup>
                            <col style="width: 150px">
                            <col style="width: 350px">
                            </colgroup>
                    <tr>
                              <td class="tg-baqh"  style="font-size: 22px;">Login:</th>
                                    <td class="tg-baqh" style="font-size: 22px;">' . $wiersz["login"] . '</th>
                     </tr>
                  
                     <tr>
                    <td class="tg-baqh"  style="font-size: 22px;">Imię</td>
                      <td class="tg-baqh"  style="font-size: 22px;">' . $wiersz["imie"] . '</td>
                     </tr>
                     <tr>
                    <td class="tg-baqh"  style="font-size: 22px;">Nazwisko</td>
                      <td class="tg-baqh"  style="font-size: 22px;">' . $wiersz["nazwisko"] . '</td>
                     </tr>
                        <tr>
                    <td class="tg-baqh"  style="font-size: 22px;">E-mail</td>
                      <td class="tg-baqh"  style="font-size: 22px;">' . $wiersz["email"] . '</td>
                     </tr>

                                 </table>';
                        }
                    }
                    $polaczenie->close();
                    ?>
                    <br>
                    <input type="password" class="password" name="edhaslo1" placeholder="Zmień Haslo"  />
                    <input type="password" class="password" name="edhaslo2" placeholder="Potwierdź hasło"  />
                    <input type="text" class="username" name="edemail" placeholder="Zmień swój e-mail" />
                    <input type="submit"  style="width:500px;" value="Zaakceptuj zmiany" />
                </form>
<!-- FORMULARZ KONIEC-->
<br> 
<!-- PHP - POWIADOMIENIE-  POCZĄTEK-->
                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                    echo '<div class="karuzela"   style="text-align: center; color:green; "> Hasło zostało zmienione.</div>';
                }
                ?>
                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'success2') {
                    echo '<div class="karuzela"   style="text-align: center; color:green; "> E-mail został zmieniony.</div>';
                }
                ?>

                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                    echo '<div class="karuzelared" style="text-align: center; "> Błąd! Hasła różnią się od siebie!</div>';
                }
                ?>
                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed2') {
                    echo '<div class="karuzelared" style="text-align: center; "> Błąd! Wprowadź hasło.</div>';
                }
                ?>
                <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed3') {
                    echo '<div class="karuzelared" style="text-align: center; ">Błędny format adresu e-mail.';
                }
                ?>

<!-- PHP - POWIADOMIENIE-  KONIEC-->

            </div>
<!-- SQUARE KONIEC-->

            <div style="clear: both;"></div>
            <div class="rectangle">2018 &copy; Dominik Urban - Ference</div>
        </div>
    </body>
</html>
