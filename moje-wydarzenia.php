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
          
<!-- SQUARE POCZĄTEK-->
            <div class="square" style="margin-top:10px;">
       
            <?php
                header('Content-Type: text/html; charset=utf-8');
                require_once "connect.php";

                $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                if ($polaczenie->connect_errno != 0) {
                    echo "Error: " . $polaczenie->connect_error;
                } else {
                     $polaczenie->query("SET NAMES utf8");
                    
                    $login = $_SESSION['login'];
                      $sql = "select * from wydarzenia  WHERE login like '$login' ORDER BY data_rozp";
                 // Potrzeba wyswietlic wszystko z tabeli wydarzenia tam gdzie email jest rowny emailowi
                  
                        $result = mysqli_query($polaczenie, $sql);

                    $row_cnt = mysqli_num_rows($result);
                    echo '<div id="logobezfloata"  style="padding-right: 100px; font-size:50px;"> Liczba wydarzeń, których jesteś autorem:  ' . $row_cnt . ' </div>';
                    echo "<br>";
                    
                    $dane = $polaczenie->query($sql)
                            or die("Query failed"); 
                    echo '<table class = "tg" style="undefined;table-layout: fixed; width: 1045px; margin:auto;">
                        <colgroup>
                          <col style="width: 35px">
                        <col style="width: 110px">
                        <col style="width: 130px">
                        <col style="width: 130px">
                        <col style="width: 100px">
                        <col style="width: 80px">
                        <col style="width: 100px">
                        <col style="width: 100px">
                        <col style="width: 150px">
                        <col style="width: 100px">
                         <col style="width: 60px">
                        </colgroup>
                    <TR>
                    <th class = "tg-223e">Id</th>
                    <th class = "tg-223e">Nazwa</th>
                    <th class = "tg-223e">Data rozpoczęcia</th>
                    <th class = "tg-223e">Data zakończenia</th>
                    <th class = "tg-223e">Godzina rozpoczęcia</th>
                    <th class = "tg-223e">Miasto</th>
                    <th class = "tg-223e">Ulica</th>
                    <th class = "tg-223e">Miejsce</th>
                    <th class = "tg-223e">Opis</th>
                    <th class = "tg-223e">Tematyka</th>
                    </TR>
                    </table>';

                    while ($wiersz = $dane->fetch_array()) {
                        echo '
 <a href="Szczegoly-konferencji?id=' . $wiersz["id_kon"] . '  " >
<table class = "tg"  style="table-layout: fixed; width: 1045px">
   <colgroup>
                                    <col style="width: 35px">
                        <col style="width: 110px">
                        <col style="width: 130px">
                        <col style="width: 130px">
                        <col style="width: 100px">
                        <col style="width: 80px">
                        <col style="width: 100px">
                        <col style="width: 100px">
                        <col style="width: 150px">
                        <col style="width: 100px">
                         <col style="width: 60px">
                        </colgroup>
                    <TR>
                    <TD class="tg-baqh">' . $wiersz["id_kon"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["nazwa_kon"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["data_rozp"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["data_zak"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["godzina_rozp"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["miasto"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["ulica"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["miejsce_kon"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["opis"] . ' </TD>
                    <TD class="tg-baqh">' . $wiersz["tematyka"] . ' </TD>

                    </TR>

                    </table> </a>
                    ';
                        
                    }
                }
                $polaczenie->close();
                ?>
                 
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
