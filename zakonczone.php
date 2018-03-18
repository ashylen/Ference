<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: twojekonto.php');
    exit();
}
?>
<!DOCTYPE html>

<html lang="pl-PL">
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
    <body >
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
        <br/><br/>
   <!-- KONTENER POCZĄTEK-->
        <div id="container">
            <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logobezfloata" class="tilelinkhtml5">Zakończone wydarzenia</div>
                <br>
                <!-- TABELA POCZĄTEK-->

                <div class="Tabela">
                    <?php
                    header('Content-Type: text/html; charset=utf-8');
                    require_once "connect.php";
                    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
                    if ($polaczenie->connect_errno != 0) {
                        echo "Error: " . $polaczenie->connect_error;
                    } else {

                        $polaczenie->query("SET NAMES utf8");
                        $sql = 'Select * from wydarzenia where data_rozp < curdate()  ORDER BY data_rozp  ';
                        $dane = $polaczenie->query($sql)
                                or die("Query failed");
  
                        echo '<table class = "tg" style="undefined;table-layout: fixed; width: 1045px">
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
                    <th class = "tg-223e">Ilość miejsc:</th>
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
                    <TD class="tg-baqh">' . $wiersz["ilosc_miejsc"] . ' </TD>
                    </TR>

                    </table>   </a>
                      ';
                        }
                    }
                    $polaczenie->close();
                    ?>
                </div>
                <!-- TABELA KONIEC-->
                <div style="clear: both"></div>    <!--   CLEAR   -->
            </div>
        <!-- RECTANGLE KONIEC-->
            </div>
      <!-- KONTENER KONIEC-->

            <div style="clear: both;"></div>
            <br /><br />

            <div class="rectangle">2017 &copy; Dominik Urban</div>
        </div>
       </body>
</html>
